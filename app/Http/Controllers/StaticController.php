<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticController extends Controller
{
    public function about()
    {
        return view('about');
    }
    public function contact()
    {
        return view('contact');
    }
    public function payment()
    {
        return view('payment');
    }
    public function profile()
    {
        return view('profile');
    }
    public function giohang()
    {
        return view('giohang');
    }
}
