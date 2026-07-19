<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admission;
use App\Models\Staff;
use App\Models\GalleryImage;

class HomeController extends Controller
{
    public function index(){
        return view('pages.user.home');
    }

    public function print_form($form_no){
 $admission = Admission::where('form_no',$form_no)->first();
        return view('pages.user.print_form',['admission'=>$admission]);
    }

    public function admission_form(){
        return view('pages.user.admission_form');
    }
    public function employees(){
        $staffs = Staff::all();
        return view('pages.user.employees',compact('staffs'));
    }

    public function gallery(){
        $images = GalleryImage::latest()->paginate(4);
        return view('pages.user.gallery',compact('images'));
    }

}
