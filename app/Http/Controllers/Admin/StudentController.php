<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\StudentAcademic;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str; 

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $students = Student::with('currentAcademic')->paginate(10);

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
            'birth_date'      => 'required|date',
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
            'guardian_phone'      => 'nullable|string|max:20',

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
        'birth_date'      => 'required|date',
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
        'guardian_phone'       => 'nullable|string|max:20',

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

    // ✅ Photo update
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
        //
    }

}
