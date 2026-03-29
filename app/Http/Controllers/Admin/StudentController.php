<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\StudentAcademic;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str; 
use App\Models\Admission;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
{
    $query = Student::with('currentAcademic');

    // সার্চ ফিল্টারসমূহ
    if ($request->filled('uid')) {
        $query->where('uid', $request->uid);
    }

     if ($request->filled('gender')) {
        $query->where('gender', $request->gender);
    }

    if ($request->filled('name')) {
        $name = $request->name;
        $query->where(function($q) use ($name) {
            $q->where('name_bn_first', 'LIKE', "%{$name}%")
              ->orWhere('name_bn_last', 'LIKE', "%{$name}%")
              ->orWhere('name_en_first', 'LIKE', "%{$name}%")
              ->orWhere('name_en_last', 'LIKE', "%{$name}%");
        });
    }
    if ($request->filled('class') || $request->filled('roll')  || $request->filled('session')) {
        $query->whereHas('currentAcademic', function ($q) use ($request) {
            if ($request->filled('class')) $q->where('class', $request->class);
            if ($request->filled('roll')) $q->where('roll', $request->roll);
            if ($request->filled('session')) $q->where('session', $request->session);
        });
    }

    // যদি কোনো সার্চ ইনপুট থাকে, তবে সব ডাটা একসাথে দেখাবে (No Pagination)
    if ($request->anyFilled(['uid', 'name', 'class', 'roll'])) {
       $students = $query->join('student_academics', 'students.id', '=', 'student_academics.student_id')
                          ->orderBy('student_academics.class', 'asc')
                          ->orderBy('student_academics.roll', 'asc')
                          ->select('students.*')
                          ->get();
    } else {
        // নরমাল অবস্থায় আপনি চাইলে ৫০টা করে দেখাতে পারেন অথবা এখানেও get() দিতে পারেন
        $students = $query->latest()->paginate(50); 
    }

    return view('pages.admin.students.index', compact('students'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return  view('pages.admin.students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
       // Student
            'name_bn_first'   => 'required|string|max:100',
            'name_bn_last'    => 'required|string|max:100',
            'name_en_first'   => 'nullable|string|max:100',
            'name_en_last'    => 'nullable|string|max:100',
            'birth_date'      => 'nullable|date',
            'birth_reg_no'    => 'nullable|string|max:20',
            'gender'          => 'required|in:male,female,others',
            'nationality'     => 'nullable|string|max:50',
            'blood_group'     => 'nullable|string|max:5',
            'religion'        => 'nullable|string|max:20',
            'student_photo'   => 'nullable|image|max:2048',

            // Father
            'father_bn'            => 'nullable|string|max:150',
            'father_en'            => 'nullable|string|max:150',
            'father_nid'           => 'nullable|string|max:30',
            'father_birth_reg'     => 'nullable|string|max:30',
            'father_birth_date'    => 'nullable|date',

            // Mother
            'mother_bn'            => 'nullable|string|max:150',
            'mother_en'            => 'nullable|string|max:150',
            'mother_nid'           => 'nullable|string|max:30',
            'mother_birth_reg'     => 'nullable|string|max:30',
            'mother_birth_date'    => 'nullable|date',

            // Guardian
            'guardian_name'        => 'nullable|string|max:150',
            'guardian_occupation' => 'nullable|string|max:100',
            'guardian_phone'      => 'nullable|string|max:255',

            // Address
            'perm_village'  => 'nullable|string|max:150',
            'perm_post'     => 'nullable|string|max:150',
            'perm_union'    => 'nullable|string|max:150',
            'perm_upazila'  => 'nullable|string|max:150',
            'perm_district' => 'nullable|string|max:150',

            'curr_village'  => 'nullable|string|max:150',
            'curr_post'     => 'nullable|string|max:150',
            'curr_union'    => 'nullable|string|max:150',
            'curr_upazila'  => 'nullable|string|max:150',
            'curr_district' => 'nullable|string|max:150',

            // Academic
            'class'   => 'required|integer|min:0|max:10',
            'roll'    => 'nullable|string|max:20',
            'session' => 'required|string|max:10',
        ]);

        
    $isDuplicate = StudentAcademic::where('class', $request->class)
        ->where('roll', $request->roll)
        ->where('session', $request->session)
        ->exists();

    if ($isDuplicate) {
        return redirect()->back()->with('error', 'এই সেশনে এবং এই ক্লাসে এই রোল নম্বরটি ইতিমধ্যে বরাদ্দ করা হয়েছে।');
    }

        do {
            // First digit: 1–9 (never 0)
            $uid = rand(1, 9);

            // Remaining 5 digits: 0–9
            for ($i = 0; $i < 5; $i++) {
                $uid .= rand(0, 9);
            }
        } while (\App\Models\Student::where('uid', $uid)->exists());
        $validated['uid'] = $uid;

        // ✅ Image upload
        if ($request->hasFile('student_photo')) {
            $image_obj = $request->file('student_photo');
            $filename = Str::random(40) . '.' . $image_obj->getClientOriginalExtension();
            $relative_path = 'uploads/students/' . $filename;
            Storage::disk('img_disk')->putFileAs('uploads/students', $image_obj, $filename);
            $validated['student_photo'] =  $relative_path;

            
        }


    // Save student personal info
    $student = Student::create($validated);

    // Save first academic record if class or roll exists
    if(!empty($validated['class']) || !empty($validated['roll']) || !empty($validated['session'])){
        StudentAcademic::create([
            'student_id' => $student->id,
            'class' => $validated['class'] ?? null,
            'roll' => $validated['roll'] ?? null,
            'session' => $validated['session'] ?? null,
            'status' => 'active',
        ]);
    }

     return redirect()
            ->back()
            ->with('success', 'শিক্ষার্থীর তথ্য সফলভাবে সংরক্ষণ করা হয়েছে');

    // return redirect()->route('admin.students.index')->with('success','Student added successfully!');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $student = Student::with('currentAcademic')->findOrFail($id);

    // Return the view and pass the student data
    return view('pages.admin.students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
          $student = Student::with('currentAcademic')->findOrFail($id);

    // Return the view and pass the student data
    return view('pages.admin.students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
  public function update(Request $request, Student $student)
{
    // Validation
    $validated = $request->validate([
        // Student
        'name_bn_first'   => 'required|string|max:100',
        'name_bn_last'    => 'required|string|max:100',
        'name_en_first'   => 'nullable|string|max:100',
        'name_en_last'    => 'nullable|string|max:100',
        'birth_date'      => 'nullable|date',
        'birth_reg_no'    => 'nullable|string|max:20',
        'gender'          => 'required|in:male,female,others',
        'nationality'     => 'nullable|string|max:50',
        'blood_group'     => 'nullable|string|max:5',
        'religion'        => 'nullable|string|max:20',
        'student_photo'   => 'nullable|image|max:2048',

        // Father
        'father_bn'            => 'nullable|string|max:150',
        'father_en'            => 'nullable|string|max:150',
        'father_nid'           => 'nullable|string|max:30',
        'father_birth_reg'     => 'nullable|string|max:30',
        'father_birth_date'    => 'nullable|date',

        // Mother
        'mother_bn'            => 'nullable|string|max:150',
        'mother_en'            => 'nullable|string|max:150',
        'mother_nid'           => 'nullable|string|max:30',
        'mother_birth_reg'     => 'nullable|string|max:30',
        'mother_birth_date'    => 'nullable|date',

        // Guardian
        'guardian_name'        => 'nullable|string|max:150',
        'guardian_occupation'  => 'nullable|string|max:100',
        'guardian_phone'       => 'nullable|string|max:255',

        // Address
        'perm_village'  => 'nullable|string|max:150',
        'perm_post'     => 'nullable|string|max:150',
        'perm_union'    => 'nullable|string|max:150',
        'perm_upazila'  => 'nullable|string|max:150',
        'perm_district' => 'nullable|string|max:150',

        'curr_village'  => 'nullable|string|max:150',
        'curr_post'     => 'nullable|string|max:150',
        'curr_union'    => 'nullable|string|max:150',
        'curr_upazila'  => 'nullable|string|max:150',
        'curr_district' => 'nullable|string|max:150',

        // Academic
        'class'   => 'required|integer|min:0|max:10',
        'roll'    => 'nullable|string|max:20',
        'session' => 'required|string|max:10',
    ]);

    
$isDuplicate = StudentAcademic::where('class', $request->class)
    ->where('roll', $request->roll)
    ->where('session', $request->session)
    ->where('student_id', '!=', $student->id) 
    ->exists();

if ($isDuplicate) {
    return redirect()->back()->with('error', 'এই সেশনে এবং এই ক্লাসে এই রোল নম্বরটি ইতিমধ্যে অন্য একজন শিক্ষার্থীর জন্য বরাদ্দ করা হয়েছে।');
}
    
    if ($request->hasFile('student_photo')) {
        // Delete old photo if exists
        if ($student->student_photo && Storage::disk('img_disk')->exists($student->student_photo)) {
            Storage::disk('img_disk')->delete($student->student_photo);
        }

        $image_obj = $request->file('student_photo');
        $filename = Str::random(40) . '.' . $image_obj->getClientOriginalExtension();
        $relative_path = 'uploads/students/' . $filename;
        Storage::disk('img_disk')->putFileAs('uploads/students', $image_obj, $filename);
        $validated['student_photo'] = $relative_path;
    }

    // Update Student personal info
    $student->update($validated);

    // Update or create academic info
    if($student->currentAcademic){
        $student->currentAcademic->update([
            'class' => $validated['class'] ?? $student->currentAcademic->class,
            'roll'  => $validated['roll'] ?? $student->currentAcademic->roll,
            'session' => $validated['session'] ?? $student->currentAcademic->session,
           
        ]);
    } else {
        StudentAcademic::create([
            'student_id' => $student->id,
            'class' => $validated['class'] ?? null,
            'roll'  => $validated['roll'] ?? null,
            'session' => $validated['session'] ?? null,
            'status' => 'active',
        ]);
    }

    return redirect()
        ->back()
        ->with('success', 'শিক্ষার্থীর তথ্য সফলভাবে আপডেট করা হয়েছে');
}


    /**
     * Remove the specified resource from storage.
     */
 public function destroy(string $id)
{
    // ১. শিক্ষার্থী খুঁজে বের করা
    $student = Student::findOrFail($id);

    try {
        // ২. শিক্ষার্থীর ছবি থাকলে সার্ভার থেকে ডিলিট করা
        if ($student->student_photo && Storage::disk('img_disk')->exists($student->student_photo)) {
            Storage::disk('img_disk')->delete($student->student_photo);
        }

        // ৩. শিক্ষার্থীর একাডেমিক রেকর্ড ডিলিট করা (যদি Database এ cascade delete না থাকে)
        $student->academics()->delete(); 

        // ৪. শিক্ষার্থী ডিলিট করা
        $student->delete();

        return redirect()->route('admin.students.index')
                         ->with('success', 'শিক্ষার্থীর সকল তথ্য সফলভাবে মুছে ফেলা হয়েছে।');

    } catch (\Exception $e) {
        return redirect()->back()
                         ->with('error', 'মুছে ফেলতে সমস্যা হয়েছে: ' . $e->getMessage());
    }
}

   public function add_student(Request $request, $id)
{
   
    $admission = Admission::findOrFail($id);
    $request->validate([
        'class'   => 'required',
        'roll'    => 'required',
        'session' => 'required',
    ]);

    
    $isDuplicate = StudentAcademic::where('class', $request->class)
        ->where('roll', $request->roll)
        ->where('session', $request->session)
        ->exists();

    if ($isDuplicate) {
        return redirect()->back()->with('error', 'এই সেশনে এবং এই ক্লাসে এই রোল নম্বরটি ইতিমধ্যে বরাদ্দ করা হয়েছে।');
    }

    \Illuminate\Support\Facades\DB::beginTransaction();

    try {
        
        do {
            $uid = rand(1, 9);
            for ($i = 0; $i < 5; $i++) {
                $uid .= rand(0, 9);
            }
        } while (Student::where('uid', $uid)->exists());

      
        $studentData = $admission->toArray();
        unset($studentData['id'], $studentData['status'], $studentData['created_at'], $studentData['updated_at']);
        
        $studentData['uid'] = $uid; 
        $studentData['status'] = 'active'; 
      
        $student = Student::create($studentData);
        StudentAcademic::create([
            'student_id' => $student->id,
            'class'      => $request->class,
            'roll'       => $request->roll,
            'session'    => $request->session,
            'status'     => 'active',
        ]);

        // ৭. অ্যাডমিশন স্ট্যাটাস আপডেট করা (Approved)
        $admission->update(['status' => '3']);

        \Illuminate\Support\Facades\DB::commit();
        
        return redirect()->back()->with('success', 'শিক্ষার্থীর তথ্য সফলভাবে Student তালিকায় যুক্ত করা হয়েছে। UID: ' . $uid);

    } catch (\Exception $e) {
        \Illuminate\Support\Facades\DB::rollBack();
        return redirect()->back()->with('error', 'কিছু ভুল হয়েছে: ' . $e->getMessage());
    }
}

public function bulkSerialPhotoUpload(Request $request)
{
    $request->validate([
        'student_ids' => 'required|array',
        'photos'      => 'required|array',
        'photos.*'    => 'image|mimes:jpg,jpeg,png|max:2048'
    ]);

    $studentIds = $request->student_ids; // সিলেক্ট করা আইডিগুলো
    $photos = $request->file('photos');    // আপলোড করা ছবিগুলো
 usort($photos, function($a, $b) {
        return strnatcasecmp($a->getClientOriginalName(), $b->getClientOriginalName());
    });
    
    // চেক করা হচ্ছে আইডি এবং ছবির সংখ্যা সমান কিনা
    if (count($studentIds) !== count($photos)) {
        return redirect()->back()->with('error', 'সিলেক্ট করা ছাত্রের সংখ্যা (' . count($studentIds) . ') এবং ছবির সংখ্যা (' . count($photos) . ') সমান নয়!');
    }

    $successCount = 0;

    foreach ($studentIds as $index => $id) {
        $student = Student::find($id);
        
        if ($student && isset($photos[$index])) {
            $image_obj = $photos[$index];

            // পুরাতন ছবি ডিলিট করা
            if ($student->student_photo && Storage::disk('img_disk')->exists($student->student_photo)) {
                Storage::disk('img_disk')->delete($student->student_photo);
            }

            // নতুন নাম জেনারেট করে সেভ করা
            $filename = Str::random(40) . '.' . $image_obj->getClientOriginalExtension();
            $relative_path = 'uploads/students/' . $filename;
            
            Storage::disk('img_disk')->putFileAs('uploads/students', $image_obj, $filename);

            // ডাটাবেস আপডেট
            $student->update(['student_photo' => $relative_path]);
            $successCount++;
        }
    }

    return redirect()->back()->with('success', "$successCount জন শিক্ষার্থীর ছবি সিরিয়াল অনুযায়ী আপডেট করা হয়েছে।");
}



public function downloadDoc(Request $request)
    {
       
       // ইউজারের সিলেক্ট করা সিরিয়াল অনুযায়ী কলামগুলো পাওয়া যাবে
    $columnString = $request->input('ordered_columns');
    
    if (empty($columnString)) {
        return back()->with('error', 'অনুগ্রহ করে অন্তত একটি কলাম সিলেক্ট করুন।');
    }

    $selectedColumns = explode(',', $columnString);

        // ১. ফিল্টার অনুযায়ী ডাটা কোয়েরি করা (আপনার ইনডেক্স পেজের ফিল্টার লজিক)
        $query = Student::query();

        if ($request->uid) {
            $query->where('uid', 'like', '%' . $request->uid . '%');
        }
        if ($request->name) {
            $query->where(function($q) use ($request) {
                $q->where('name_bn_first', 'like', '%' . $request->name . '%')
                  ->orWhere('name_en_first', 'like', '%' . $request->name . '%');
            });
        }
        if ($request->gender) {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('class') || $request->filled('roll') || $request->filled('session')) {
        $query->whereHas('currentAcademic', function($q) use ($request) {
            if ($request->filled('class')) {
                $q->where('class', $request->class);
            }
            if ($request->filled('roll')) {
                $q->where('roll', $request->roll);
            }
            if ($request->filled('session')) {
                $q->where('session', $request->session);
            }
        });
    }
        

  $students = $query->with('currentAcademic')->get()->sort(function($a, $b) {
    // প্রথমে ক্লাস তুলনা করা হচ্ছে
    $classA = $a->currentAcademic->class ?? 0;
    $classB = $b->currentAcademic->class ?? 0;

    if ($classA != $classB) {
        return $classA <=> $classB; // ক্লাস ছোট থেকে বড়
    }

    // ক্লাস যদি একই হয়, তবে রোল তুলনা করা হচ্ছে
    $rollA = (int)($a->currentAcademic->roll ?? 999999);
    $rollB = (int)($b->currentAcademic->roll ?? 999999);

    return $rollA <=> $rollB; // রোল ছোট থেকে বড়
});
        

        // ২. Word ফাইল কনফিগারেশন
        $phpWord = new PhpWord();
        $section = $phpWord->addSection([
            'orientation' => 'portrait', // কলাম বেশি হলে ল্যান্ডস্কেপ মোড ভালো
            'marginTop' => 600, 'marginBottom' => 600, 'marginLeft' => 600, 'marginRight' => 600,
        ]);

        $table = $section->addTable([
            'borderSize' => 6, 
            'borderColor' => '000000', 
            'cellMargin' => 50
        ]);

        // ৩. ডাইনামিক টেবিল হেডার তৈরি
        $table->addRow();
        foreach ($selectedColumns as $column) {
            // হেডারের নাম সুন্দর করার জন্য আন্ডারস্কোর সরানো
            $headerName = str_replace(['_', 'bn', 'en'], [' ', '(বাংলা)', '(EN)'], $column);
            $table->addCell(2000)->addText(ucwords($headerName), ['bold' => true, 'size' => 10]);
        }

        // ৪. ডাটা লুপ করে টেবিলে বসানো
        foreach ($students as $student) {
            $table->addRow();
            foreach ($selectedColumns as $column) {
                $cell = $table->addCell(2000);

                if ($column == 'full_name_bn') {
                    $cell->addText($student->name_bn_first . ' ' . $student->name_bn_last);
                } 
                elseif ($column == 'full_name_en') {
                    $cell->addText($student->name_en_first . ' ' . $student->name_en_last);
                    }
                    elseif($column == 'class'){
                        $cell->addText($student->currentAcademic->class);
                        
                }elseif($column == 'roll'){
                        $cell->addText($student->currentAcademic->roll);
                        
                } 
                elseif($column == 'session'){
                        $cell->addText($student->currentAcademic->session);
                        
                } 
                elseif ($column == 'student_photo') {
                    if ($student->student_photo) {
                        // আপনার ইমেজ হোস্ট ইউআরএল
                        $imageUrl = "https://img.fbasm.edu.bd/" . $student->student_photo;
                        try {
                            $cell->addImage($imageUrl, ['width' => 35, 'height' => 35]);
                        } catch (\Exception $e) {
                            $cell->addText('No Photo');
                        }
                    } else {
                        $cell->addText('N/A');
                    }
                } 
                else {
                    // ডাটাবেজের সরাসরি কলামের ভ্যালু
                    $cell->addText($student->$column ?? 'N/A');
                }
            }
        }

        // ৫. ফাইল জেনারেট এবং ডাউনলোড
        $fileName = 'Student_Report_' . date('d_m_Y_Hi') . '.docx';
        $tempFile = tempnam(sys_get_temp_dir(), $fileName);
        
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($tempFile);

        return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
    }

    public function downloadDoc2(Request $request)
{
    // selected_data তে ইউজারের সিলেক্ট করা তথ্যগুলো আছে
    $selectedData = $request->input('columns'); 
    $headers = $request->input('headers');

    if (!$selectedData) {
        return back()->with('error', 'অনুগ্রহ করে অন্তত একটি কলাম এবং তথ্য সিলেক্ট করুন।');
    }

    $students = Student::with('currentAcademic')->get(); // আপনার ফিল্টার অনুযায়ী

    $phpWord = new \PhpOffice\PhpWord\PhpWord();
    $section = $phpWord->addSection(['orientation' => 'landscape']); // কলাম বেশি হলে ল্যান্ডস্কেপ ভালো
    $table = $section->addTable(['borderSize' => 6, 'cellMargin' => 50]);

    // ১. হেডার তৈরি (ইউজারের দেওয়া নাম অনুযায়ী)
    $table->addRow();
    foreach ($headers as $headerText) {
        $table->addCell(3000)->addText($headerText, ['bold' => true, 'alignment' => 'center']);
    }

    // ২. স্টুডেন্ট ডাটা বসানো
    foreach ($students as $student) {
        $table->addRow();
        
        // প্রতিটি কলামের জন্য লুপ
        foreach ($selectedData as $fields) {
            $cell = $table->addCell(3000);
            
            // একই সেলের ভেতর একাধিক ডাটা লুপ
            foreach ($fields as $field) {
                $text = match($field) {
                    'full_name_bn' => ($student->name_bn_first ?? '') . ' ' . ($student->name_bn_last ?? ''),
                    'roll'         => "রোল: " . ($student->currentAcademic->roll ?? 'N/A'),
                    'class'        => "শ্রেণি: " . ($student->currentAcademic->class ?? 'N/A'),
                    'father_bn'    => "পিতা: " . ($student->father_bn ?? 'N/A'),
                    'mother_bn'    => "মাতা: " . ($student->mother_bn ?? 'N/A'),
                    'guardian_phone' => "মোবাইল: " . ($student->guardian_phone ?? 'N/A'),
                    default        => $student->$field ?? 'N/A',
                };
                
                $cell->addText($text, ['size' => 10]);
            }
        }
    }

    // ফাইল জেনারেট এবং ডাউনলোড
    $fileName = 'Custom_Student_List_' . time() . '.docx';
    $tempFile = tempnam(sys_get_temp_dir(), $fileName);
    $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
    $objWriter->save($tempFile);

    return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
}

}
