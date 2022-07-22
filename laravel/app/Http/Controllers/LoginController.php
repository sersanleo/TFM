<?php

namespace App\Http\Controllers;

class LoginController extends Controller
{
    public function get()
    {
        return view('login');
    }

    public function post(Request $request)
    {
        return view('login');
    }
}
