<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('pages.user.home');
    }

    public function print_form(){
        return view('pages.user.print_form');
    }
}
