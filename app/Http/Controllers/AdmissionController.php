<?php

namespace App\Http\Controllers;

use App\Models\Admission;
use Illuminate\Http\Request;

class AdmissionController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_bn_first' => 'required|string',
            'name_bn_last'  => 'nullable|string',
            'name_en_first' => 'required|string',
            'name_en_last'  => 'nullable|string',
            'birth_date'    => 'required|date',
            'birth_reg_no'  => 'nullable|string',
            'gender'        => 'required|string',
            'nationality'   => 'nullable|string',
            'student_photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'father_bn' => 'required|string',
            'father_en' => 'required|string',

            'mother_bn' => 'required|string',
            'mother_en' => 'required|string',

            'guardian_name'  => 'nullable|string',
            'guardian_phone' => 'nullable|string',

            'perm_village' => 'required|string',
            'perm_post'    => 'required|string',
            'perm_union'   => 'required|string',
            'perm_upazila' => 'required|string',
            'perm_district'=> 'required|string',

            'curr_village' => 'nullable|string',
            'curr_post'    => 'nullable|string',
            'curr_union'   => 'nullable|string',
            'curr_upazila' => 'nullable|string',
            'curr_district'=> 'nullable|string',

            'admit_class'         => 'required|string',
            'previous_class'      => 'nullable|string',
            'previous_institute'  => 'nullable|string',
            'leave_certificate_no'=> 'nullable|string',
            'leave_certificate_date' => 'nullable|date',
        ]);

            do {
            $formNo = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
            } while (\App\Models\Admission::where('form_no', $formNo)->exists());

            $validated['form_no'] = $formNo;

        // Photo upload
        if ($request->hasFile('student_photo')) {
            $photo = $request->file('student_photo');
            $name  = time() . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('uploads/students/'), $name);

            $validated['student_photo'] = 'uploads/students/' . $name;
        }

        // Save record
        $admission = Admission::create($validated);

        return redirect()->route('print_form',['form_no'=>$formNo])->with('success', 'Admission form submitted successfully!');
    }
}
