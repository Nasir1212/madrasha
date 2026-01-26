<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admission;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str; 
class AdmissionAdminController extends Controller
{
        // List
public function index(Request $request )
{
    $query = Admission::query();

    // নাম দিয়ে সার্চ (First Name অথবা Last Name)
    if ($request->filled('name')) {
        $query->where(function($q) use ($request) {
            $q->where('name_bn_first', 'like', '%' . $request->name . '%')
              ->orWhere('name_bn_last', 'like', '%' . $request->name . '%')
              ->orWhere('name_en_first', 'like', '%' . $request->name . '%')
              ->orWhere('name_en_last', 'like', '%' . $request->name . '%');
        });
    }
     
    // শ্রেণি দিয়ে ফিল্টার
    if ($request->filled('class')) {
        $query->where('admit_class', $request->class);
    }

    // মোবাইল নম্বর দিয়ে সার্চ
    if ($request->filled('phone')) {
        $query->where('guardian_phone', 'like', '%' . $request->phone . '%');
    }

    // ফর্ম নম্বর দিয়ে সার্চ
    if ($request->filled('form_no')) {
        $query->where('form_no', $request->form_no);
    }

    $admissions = $query->latest()->paginate(20)->withQueryString();
    return view('pages.admin.admissions.index', compact('admissions'));
}

// Edit Page
public function edit($id)
{
    $student = Admission::findOrFail($id);
    return view('pages.admin.admissions.edit', compact('student'));
}

// Update
// public function update(Request $request, $id)
// {
//     $admission = Admission::findOrFail($id);
//     $admission->update($request->all());

//     return redirect()->route('admin.admissions.index')
//         ->with('success', 'ডাটা আপডেট হয়েছে');
// }


public function update(Request $request, $id)
{
    $admission = Admission::findOrFail($id);

    $validated = $request->validate([
        'name_bn_first' => 'nullable|string',
        'name_bn_last'  => 'nullable|string',
        'name_en_first' => 'nullable|string',
        'name_en_last'  => 'nullable|string',
        'birth_date'    => 'nullable|date',
        'birth_reg_no'  => 'nullable|string',
        'gender'        => 'nullable|string',
        'nationality'   => 'nullable|string',
        'religion'      => 'nullable|string',
        'blood_group'   => 'nullable|string',
        'student_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

        'father_bn' => 'nullable|string',
        'father_en' => 'nullable|string',
        'father_nid' => 'nullable|string',
        'father_birth_reg' => 'nullable|string',
        'father_birth_date' => 'nullable|date',

        'mother_bn' => 'nullable|string',
        'mother_en' => 'nullable|string',
        'mother_nid' => 'nullable|string',
        'mother_birth_reg' => 'nullable|string',
        'mother_birth_date' => 'nullable|date',

        'guardian_name'  => 'nullable|string',
        'guardian_occupation'  => 'nullable|string',
        'guardian_phone' => 'nullable|string',

        'perm_village' => 'nullable|string',
        'perm_post'    => 'nullable|string',
        'perm_union'   => 'nullable|string',
        'perm_upazila' => 'nullable|string',
        'perm_district'=> 'nullable|string',

        'curr_village' => 'nullable|string',
        'curr_post'    => 'nullable|string',
        'curr_union'   => 'nullable|string',
        'curr_upazila' => 'nullable|string',
        'curr_district'=> 'nullable|string',

        'admit_class'         => 'nullable|string',
        'previous_class'      => 'nullable|string',
        'previous_institute'  => 'nullable|string',
        'leave_certificate_no'=> 'nullable|string',
        'leave_certificate_date' => 'nullable|date',
    ]);

    // Photo update
    if ($request->hasFile('student_photo')) {

        // Old photo delete (optional)
        if ($admission->student_photo) {
            Storage::disk('img_disk')->delete($admission->student_photo);
        }

        $image_obj = $request->file('student_photo');
        $filename = Str::random(40) . '.' . $image_obj->getClientOriginalExtension();
        $relative_path = 'uploads/students/' . $filename;

        Storage::disk('img_disk')->putFileAs('uploads/students', $image_obj, $filename);

        $validated['student_photo'] = $relative_path;
    }

    // Update record
    $admission->update($validated);

    return redirect()
        ->route('admin.admissions.index')
        ->with('success', 'Admission form updated successfully!');
}



// Delete
public function destroy($id)
{
    Admission::findOrFail($id)->delete();
    return back()->with('success', 'ডাটা ডিলিট হয়েছে');
}

// Approve
public function approve($id)
{
    $admission = Admission::findOrFail($id);
    $admission->status = '1';
    $admission->save();

    return back()->with('success', 'ভর্তি অনুমোদিত');
}

// Reject
public function reject($id)
{
    $admission = Admission::findOrFail($id);
    $admission->status = '2';
    $admission->save();

    return back()->with('success', 'ভর্তি বাতিল');
}

function print_receive ($form_no){
    $admission = Admission::where('form_no',$form_no)->first();
    return view('pages.admin.admissions.print_receive', compact('admission'));
}

}
