<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthenticationController extends Controller
{
    public function get_register()
    {
        return view('register');
    }

    public function post_register(Request $request)
    {
        $userInfo = $request->validate([
            'email' => 'required|email|unique:users',
            'password' => ['required', 'confirmed', Password::min(8)->uncompromised()],
            'first_name' => 'required|max:150',
            'last_name' => 'required|max:150',
            'address' => 'required|max:300',
            'birthday' => 'required|date|before:today',
        ]);

        User::create(['password' => Hash::make($userInfo['password'])] + $userInfo);
        return redirect()->route('login');
    }

    public function get_login()
    {
        return view('login');
    }

    public function post_login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('/');
        }
    }
}
