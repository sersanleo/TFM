<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class PetController extends Controller
{
    public static function validatePet(Request $request)
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
        Gate::authorize('create-pet');
        return view('pet.edit')->with('pet', null);
    }

    public function create_post(Request $request)
    {
        Gate::authorize('create-pet');
        Pet::create(PetController::validatePet($request));
        return redirect()->route('pet.list');
    }

    public function edit_get(Pet $pet)
    {
        Gate::authorize('update-pet', $pet);
        return view('pet.edit')->with('pet', $pet);
    }

    public function edit_post(Request $request, Pet $pet)
    {
        Gate::authorize('update-pet', $pet);
        $pet->update(PetController::validatePet($request));
        return redirect()->route('pet.list');
    }

    public function delete(Request $request)
    {
        $petId = $request->validate([
            'pet' => 'required|exists:pets,id'
        ])['pet'];
        $pet = Pet::find($petId);

        Gate::authorize('delete-pet', $pet);
        $pet->delete();
        return redirect()->route('pet.list');
    }
}
