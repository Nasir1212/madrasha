<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
// Personal Info
'first_name_bn', 'last_name_bn', 'first_name_en', 'last_name_en', 'blood_type', 'gender', 'religion', 'birth_date', 'birth_reg_no', 'photo',


// Parents Info
'father_name_bn', 'mother_name_bn', 'father_name_en', 'mother_name_en', 'parents_contact',


// Address Info
'full_address', 'zip_code', 'police_station', 'nationality',



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
