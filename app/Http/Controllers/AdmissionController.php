<?php

namespace App\Http\Controllers;

use App\Models\Admission;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image; 
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str; 

class AdmissionController extends Controller
{
    public function store(Request $request)
    {
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

            do {
            $formNo = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
            } while (\App\Models\Admission::where('form_no', $formNo)->exists());

            $validated['form_no'] = $formNo;

        // Photo upload
       

if ($request->hasFile('student_photo')) {

            $image_obj = $request->file('student_photo');

            // Generate unique filename
            $filename = Str::random(40) . '.' . $image_obj->getClientOriginalExtension();

            // Path inside img server
            $relative_path = 'uploads/students/' . $filename;

            // Save directly to storage disk
            Storage::disk('img_disk')->putFileAs('uploads/students', $image_obj, $filename);

            // Save full URL in database
            $validated['student_photo'] =  $relative_path;
        }

        // Save record
        $admission = Admission::create($validated);

        return redirect()->route('print_form',['form_no'=>$formNo])->with('success', 'Admission form submitted successfully!');
    }
}
