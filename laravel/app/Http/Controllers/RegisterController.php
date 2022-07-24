<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function get()
    {
        return view('register')->with('prueba', 'o');
    }

    public function post(Request $request)
    {
        $userInfo = $request->validate([
            'email' => 'required|email|unique:users',
            'password' => ['required', 'confirmed', 'max:10', Password::min(8)->uncompromised()],
            'first_name' => 'required|max:150',
            'last_name' => 'required|max:150',
            'address' => 'required|max:300',
            'birthday' => 'required|date|before:today',
        ]);

        User::create(['password' => Hash::make($userInfo['password'])] + $userInfo);
        return redirect()->route('login');
    }
}
