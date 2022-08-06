<?php

namespace App\Http\Controllers;

use App\Models\User;

class VetAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::where('is_staff', true)->get()->map(fn ($user) => [
            'id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name
        ]);
    }
}
