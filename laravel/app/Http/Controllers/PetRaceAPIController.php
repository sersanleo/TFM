<?php

namespace App\Http\Controllers;

use App\Models\PetRace;

class PetRaceAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PetRace::all();
    }
}
