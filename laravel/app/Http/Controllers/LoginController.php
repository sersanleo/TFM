<?php

namespace App\Http\Controllers;

use App\Models\PetSpecies;

class LoginController extends Controller
{
    public function __invoke()
    {
        foreach (PetSpecies::all() as $species) {
            echo $species->races;
            echo 'prueba';
        }
        return view('login');
    }
}
