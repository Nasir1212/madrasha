<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{
    public function create() {
        return view('pages.admin.staffs.create');
    }

    // public function store(Request $request)
    // {
    //     // ১. ভ্যালিডেশন (প্রয়োজনীয় ফিল্ডগুলো চেক করা)
    //     $validatedData = $request->validate([
    //         'name_bn'           => 'required|string|max:255',
    //         'name_en'           => 'required|string|max:255',
    //         'designation'       => 'required|string|max:255',
    //         'mobile_no'         => 'nullable|string|max:20',
    //         'bank_account_no'   => 'nullable|string|unique:staff,bank_account_no',
    //         'nid_no'            => 'nullable|string|unique:staff,nid_no',
    //         'photo'             => 'nullable|image|mimes:jpeg,png,jpg', // সর্বোচ্চ ২ মেগাবাইট
    //     ]);

    //     // ২. সব ডাটা রিকোয়েস্ট থেকে নেওয়া
    //     $input = $request->all();

    //     // ৩. ছবি আপলোড হ্যান্ডেল করা
    //     if ($request->hasFile('photo')) {
    //         // 'public/staff_photos' ফোল্ডারে ছবি সেভ হবে
    //         $path = $request->file('photo')->store('staff_photos', 'public');
    //         $input['photo'] = $path;
    //     }

    //     // ৪. ডাটাবেসে ডাটা ইনসার্ট করা
    //     try {
    //         Staff::create($input);
    //         return redirect()->back()->with('success', 'অভিনন্দন! শিক্ষক/কর্মচারীর তথ্য সফলভাবে সংরক্ষিত হয়েছে।');
    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('error', 'দুঃখিত! তথ্য সংরক্ষণে সমস্যা হয়েছে। এরর: ' . $e->getMessage());
    //     }
    // }

    public function store(Request $request)
{
    
    $validated = $request->validate([
        'name_bn'           => 'required|string|max:255',
        'name_en'           => 'required|string|max:255',
        'designation'       => 'required|string|max:255',
        'mobile_no'         => 'nullable|string|max:20',
        'bank_account_no'   => 'nullable|string|unique:staffs,bank_account_no',
        'nid_no'            => 'nullable|string|unique:staffs,nid_no',
        'photo'             => 'nullable|image|mimes:jpeg,png,jpg',
    ]);

   
    $data = $request->all();
    if ($request->hasFile('photo')) {
        $image_obj = $request->file('photo');
        $filename = \Illuminate\Support\Str::random(40) . '.' . $image_obj->getClientOriginalExtension();
        $relative_path = 'uploads/staff/' . $filename;
        Storage::disk('img_disk')->putFileAs('uploads/staff', $image_obj, $filename);
        $data['photo'] = $relative_path;
    }

        Staff::create($data);

    return back()->with('success', 'শিক্ষক/কর্মচারীর তথ্য এবং ছবি সফলভাবে আপলোড হয়েছে!');
}
  
    public function index()
    {
        $allStaff = Staff::latest()->get();
        return view('pages.admin.staffs.index', compact('allStaff'));
    }
}
