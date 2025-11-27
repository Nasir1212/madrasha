<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\StudentAcademic;

class dashboardController extends Controller
{
    public function index()
    {
        return view('pages.admin.dashboard');
    }

        public function printCards()
{
    $students = Student::with('currentAcademic')->get();  // All students

    return view('pages.admin.students.print-cards', compact('students'));
}

}
