<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PetController extends Controller
{
    private function validatePet(Request $request)
    {
        return ['deceased' => $request->input('deceased') ? true : false] + $request->validate([
            'owner_id' => 'required|exists:users,id',
            'name' => 'required|max:30',
            'race_id' => 'nullable|exists:pet_races,id',
            'sex' => ['nullable', Rule::in(['M', 'F'])],
            'birthday' => 'nullable|date|before:today',
            'annotations' => 'nullable'
        ]);
    }

    public function list()
    {
        $pets = Pet::visibleBy(Auth::user())->orderBy('id', 'desc')->paginate(10);
        return view('pet.list')->with('pets', $pets);
    }

    public function create_get()
    {
        return view('pet.edit')->with('pet', null);
    }

    public function create_post(Request $request)
    {
        Pet::create(PetController::validatePet($request));
        return redirect()->route('pet.list');
    }

    public function edit_get(Pet $pet)
    {
        if (Pet::visibleBy(Auth::user())->where('id', $pet->id)->exists())
            return view('pet.edit')->with('pet', $pet);
        abort(404);
    }

    public function edit_post(Request $request, Pet $pet)
    {
        if (Pet::visibleBy(Auth::user())->where('id', $pet->id)->exists()) {
            $pet->update(PetController::validatePet($request));
            return redirect()->route('pet.list');
        }
        abort(404);
    }

    public function delete(Request $request)
    {
        $petId = $request->validate([
            'pet' => 'required|exists:pets,id'
        ])['pet'];

        if (Pet::visibleBy(Auth::user())->where('id', $petId)->exists()) {
            Pet::find($petId)->delete();
            return redirect()->route('pet.list');
        }
        abort(404);
    }
}
