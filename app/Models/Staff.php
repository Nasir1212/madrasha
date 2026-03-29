<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staffs';
    protected $fillable = [
        'name_bn', 'name_en', 'designation', 'subject', 'bank_account_no', 
        'nid_no', 'appointment_date', 'index_no', 'mobile_no', 
        'salary_code', 'date_of_birth', 'joining_date', 'mpo_type', 'photo'
    ];
}
