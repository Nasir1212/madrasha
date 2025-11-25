<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentAcademic extends Model
{
    protected $fillable = [
        // Academic Info

        'student_id','class','roll','session','status'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
