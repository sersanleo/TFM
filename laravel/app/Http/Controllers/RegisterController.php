<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function get()
    {
        return view('register');
    }

    public function post(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:users|max:255',
            'password' => ['required', 'confirmed', 'max:10', Password::min(8)->uncompromised()],
            'name' => 'required|max:10',
            'surname' => 'required|max:10',
            'address' => 'required|max:10',
            'birthday' => 'required|date|before:today',
        ]);
        return view('register');
    }
}
