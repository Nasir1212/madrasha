<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
    'uid','status',
    'name_bn_first','name_bn_last','name_en_first','name_en_last',
    'birth_date','birth_reg_no','gender','nationality','blood_group','religion',
    'student_photo',

    'father_bn','father_en','father_nid','father_birth_reg','father_birth_date',
    'mother_bn','mother_en','mother_nid','mother_birth_reg','mother_birth_date',

    'guardian_name','guardian_occupation','guardian_phone',

    'perm_village','perm_post','perm_union','perm_upazila','perm_district',
    'curr_village','curr_post','curr_union','curr_upazila','curr_district',
    

];


// Academic relationship (if you are tracking separate academic table)
public function academics()
{
return $this->hasMany(StudentAcademic::class);
}


public function currentAcademic()
{
return $this->hasOne(StudentAcademic::class)->latestOfMany();
}
}
