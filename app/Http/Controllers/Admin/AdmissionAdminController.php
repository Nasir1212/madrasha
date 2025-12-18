<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admission;

class AdmissionAdminController extends Controller
{
        // List
public function index()
{
    $admissions = Admission::latest()->paginate(20);
    return view('pages.admin.admissions.index', compact('admissions'));
}

// Edit Page
public function edit($id)
{
    $admission = Admission::findOrFail($id);
    return view('pages.admin.admissions.edit', compact('admission'));
}

// Update
public function update(Request $request, $id)
{
    $admission = Admission::findOrFail($id);
    $admission->update($request->all());

    return redirect()->route('admin.admissions.index')
        ->with('success', 'ডাটা আপডেট হয়েছে');
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
    $admission->status = 'approved';
    $admission->save();

    return back()->with('success', 'ভর্তি অনুমোদিত');
}

// Reject
public function reject($id)
{
    $admission = Admission::findOrFail($id);
    $admission->status = 'rejected';
    $admission->save();

    return back()->with('success', 'ভর্তি বাতিল');
}

function print_receive ($form_no){
    $admission = Admission::where('form_no',$form_no)->first();
    return view('pages.admin.admissions.print_receive', compact('admission'));
}

}
