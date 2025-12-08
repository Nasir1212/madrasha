<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
   protected $fillable = [
        'form_no',
        'name_bn_first',
        'name_bn_last',
        'name_en_first',
        'name_en_last',
        'birth_date',
        'birth_reg_no',
        'gender',
        'nationality',
        'student_photo',

        'father_bn',
        'father_en',
        'father_nid',
        'father_birth_reg',
        'father_birth_date',

        'mother_bn',
        'mother_en',
        'mother_nid',
        'mother_birth_reg',
        'mother_birth_date',

        'guardian_name',
        'guardian_occupation',
        'guardian_phone',

        'perm_village',
        'perm_post',
        'perm_union',
        'perm_upazila',
        'perm_district',

        'curr_village',
        'curr_post',
        'curr_union',
        'curr_upazila',
        'curr_district',

        'admit_class',
        'previous_class',
        'previous_institute',
        'leave_certificate_no',
        'leave_certificate_date'
    ];
}
