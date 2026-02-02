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

        public function printCards(Request $request)
{
     $query = Student::with('currentAcademic');

    // সার্চ ফিল্টারসমূহ
    if ($request->filled('uid')) {
        $query->where('uid', $request->uid);
    }

        if ($request->filled('gender')) {
        $query->where('gender', $request->gender);
    }
    
    if ($request->filled('name')) {
        $name = $request->name;
        $query->where(function($q) use ($name) {
            $q->where('name_bn_first', 'LIKE', "%{$name}%")
              ->orWhere('name_bn_last', 'LIKE', "%{$name}%")
              ->orWhere('name_en_first', 'LIKE', "%{$name}%")
              ->orWhere('name_en_last', 'LIKE', "%{$name}%");
        });
    }
    if ($request->filled('class') || $request->filled('roll')) {
        $query->whereHas('currentAcademic', function ($q) use ($request) {
            if ($request->filled('class')) $q->where('class', $request->class);
            if ($request->filled('roll')) $q->where('roll', $request->roll);
        });
    }

    // যদি কোনো সার্চ ইনপুট থাকে, তবে সব ডাটা একসাথে দেখাবে (No Pagination)
    if ($request->anyFilled(['uid', 'name', 'class', 'roll'])) {
       $students = $query->join('student_academics', 'students.id', '=', 'student_academics.student_id')
                          ->orderBy('student_academics.class', 'asc')
                          ->orderBy('student_academics.roll', 'asc')
                          ->select('students.*')
                          ->get();
    } else {
        // নরমাল অবস্থায় আপনি চাইলে ৫০টা করে দেখাতে পারেন অথবা এখানেও get() দিতে পারেন
        $students = $query->latest()->paginate(50); 
    }

    return view('pages.admin.students.print-cards', compact('students'));
}

}
