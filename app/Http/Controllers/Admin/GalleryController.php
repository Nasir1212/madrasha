<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GalleryImage;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class GalleryController extends Controller
{
    public function adminIndex()
    {
        $images = GalleryImage::latest()->get();
        return view('pages.admin.gallery.index', compact('images'));
    }

   // এডমিন ইমেজ আপলোড স্টোর (আপনার দেওয়া ফরম্যাট অনুযায়ী)
public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // সর্বোচ্চ ২ এমবি
    ]);

    if ($request->hasFile('image')) {
        $image_obj = $request->file('image');
        
        // ৪৪ অক্ষরের র‍্যান্ডম নাম তৈরি করবে এক্সটেনশন সহ
        $filename = Str::random(40) . '.' . $image_obj->getClientOriginalExtension();
        
        // ডাটাবেজে সেভ করার জন্য রিলেটিভ পাথ
        $relative_path = 'uploads/gallery/' . $filename;
        
        // আপনার কাস্টম 'img_disk' ডিস্ক ব্যবহার করে নির্দিষ্ট ফোল্ডারে পুশ করা
        Storage::disk('img_disk')->putFileAs('uploads/gallery', $image_obj, $filename);

        // ডাটাবেজে এন্ট্রি
        GalleryImage::create([
            'title' => $request->title,
            'image_path' => $relative_path,
        ]);
    }

    return redirect()->back()->with('success', 'ছবি সফলভাবে গ্যালারিতে যুক্ত হয়েছে!');
}

// ৫. এডমিন এডিট ভিউ (অপশনাল, যদি আলাদা পেজে নিতে চান, তবে আমরা এখানে বুটস্ট্র্যাপ মডাল দিয়ে এক পেজেই দেখাবো)
public function edit($id)
{
    $image = GalleryImage::findOrFail($id);
    return response()->json($image); // মডালে ডাটা দেখানোর জন্য জেটি উপযোগী
}

// ৬. এডমিন ইমেজ আপডেট
public function update(Request $request, $id)
{
    $image = GalleryImage::findOrFail($id);

    $request->validate([
        'title' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // ছবি পরিবর্তন করা ঐচ্ছিক
    ]);

    $data['title'] = $request->title;

    if ($request->hasFile('image')) {
        // আগের ছবিটি ডিস্ক থেকে ডিলিট করা
        if (Storage::disk('img_disk')->exists($image->image_path)) {
            Storage::disk('img_disk')->delete($image->image_path);
        }

        $image_obj = $request->file('image');
        $filename = Str::random(40) . '.' . $image_obj->getClientOriginalExtension();
        $relative_path = 'uploads/gallery/' . $filename;
        
        Storage::disk('img_disk')->putFileAs('uploads/gallery', $image_obj, $filename);
        $data['image_path'] = $relative_path;
    }

    $image->update($data);

    return redirect()->back()->with('success', 'গ্যালারির তথ্য সফলভাবে আপডেট করা হয়েছে!');
}

// এডমিন ইমেজ ডিলিট (ডিস্ক থেকে ফাইল ডিলিট করার লজিক সহ)
public function destroy($id)
{
    $image = GalleryImage::findOrFail($id);
    
    // আপনার কাস্টম 'img_disk' থেকে ফাইলটি ডিলিট করা
    if (Storage::disk('img_disk')->exists($image->image_path)) {
        Storage::disk('img_disk')->delete($image->image_path);
    }

    $image->delete();
    return redirect()->back()->with('success', 'ছবিটি গ্যালারি থেকে মুছে ফেলা হয়েছে!');
}
}
