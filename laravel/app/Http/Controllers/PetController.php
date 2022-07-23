<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\PetRace;
use App\Models\Sexes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class PetController extends Controller
{
    public function list()
    {
        $pets = Pet::paginate(10);
        return view('pet.list')->with('pets', $pets);
    }

    public function create_get()
    {
        return view('pet.edit')->with('races', PetRace::all())->with('users', User::all());
    }

    public function create_post(Request $request)
    {
        $request->validate([
            'name' => 'required|max:30',
            'birthday' => 'nullable|date|before:today',
            'annotations' => 'nullable',
            'sex' => [new Enum(Sexes::class)],
            'race_id' => 'required',
            'user_id' => 'required',
        ]);
        return view('pet.edit');
    }

    public function delete()
    {
        $pets = Pet::paginate(1);
        return view('pet.list')->with('pets', $pets);
    }

    public function edit()
    {
        $pets = Pet::paginate(1);
        return view('pet.list')->with('pets', $pets);
    }
}
