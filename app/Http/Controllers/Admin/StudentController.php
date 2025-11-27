<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\StudentAcademic;
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
        // Personal Info
        'first_name_bn' => 'nullable|string|max:255',
        'last_name_bn' => 'nullable|string|max:255',
        'first_name_en' => 'nullable|string|max:255',
        'last_name_en' => 'nullable|string|max:255',
        'blood_type' => 'nullable|string|max:10',
        'gender' => 'nullable|string|max:10',
        'religion' => 'nullable|string|max:50',
        'birth_date' => 'nullable|date',
        'birth_reg_no' => 'nullable|string|max:50',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

        // Parents Info
        'father_name_bn' => 'nullable|string|max:255',
        'mother_name_bn' => 'nullable|string|max:255',
        'father_name_en' => 'nullable|string|max:255',
        'mother_name_en' => 'nullable|string|max:255',
        'parents_contact' => 'nullable|string|max:20',

        // Address Info
        'full_address' => 'nullable|string',
        'zip_code' => 'nullable|string|max:10',
        'police_station' => 'nullable|string|max:100',
        'nationality' => 'nullable|string|max:50',

        // Academic Info
        'class' => 'nullable|string|max:50',
        'roll' => 'nullable|integer',
        'session' => 'nullable|string|max:20',
    ]);

    // Handle photo upload
    if($request->hasFile('photo')){
        $validated['photo'] = $request->file('photo')->store('students', 'public');
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

    return redirect()->route('admin.students.index')->with('success','Student added successfully!');
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
    $validated = $request->validate([
        'first_name_bn' => 'nullable|string',
        'last_name_bn' => 'nullable|string',
        'first_name_en' => 'nullable|string',
        'last_name_en' => 'nullable|string',
        'blood_type' => 'nullable|string',
        'gender' => 'nullable|string',
        'religion' => 'nullable|string',
        'birth_date' => 'nullable|date',
        'birth_reg_no' => 'nullable|string',
        'father_name_bn' => 'nullable|string',
        'mother_name_bn' => 'nullable|string',
        'father_name_en' => 'nullable|string',
        'mother_name_en' => 'nullable|string',
        'parents_contact' => 'nullable|string',
        'full_address' => 'nullable|string',
        'zip_code' => 'nullable|string',
        'police_station' => 'nullable|string',
        'nationality' => 'nullable|string',
        'class' => 'nullable|string',
        'roll' => 'nullable|integer',
        'session' => 'nullable|string',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Photo upload
    if($request->hasFile('photo')){
        if($student->photo && file_exists(storage_path('app/public/'.$student->photo))){
            unlink(storage_path('app/public/'.$student->photo));
        }
        $validated['photo'] = $request->file('photo')->store('students', 'public');
    }

    // Update personal info
    $student->update($validated);

    // Update academic info
    if($student->currentAcademic){
        $student->currentAcademic->update([
            'class' => $validated['class'] ?? $student->currentAcademic->class,
            'roll' => $validated['roll'] ?? $student->currentAcademic->roll,
            'session' => $validated['session'] ?? $student->currentAcademic->session,
        ]);
    } else {
        $student->academics()->create([
            'class' => $validated['class'] ?? null,
            'roll' => $validated['roll'] ?? null,
            'session' => $validated['session'] ?? null,
            'status' => 'active',
        ]);
    }

    return redirect()->route('admin.students.index')->with('success','Student updated successfully!');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
