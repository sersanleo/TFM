<?php

namespace Database\Seeders;

use App\Models\Pet;
use App\Models\PetRace;
use App\Models\User;
use Illuminate\Database\Seeder;

class PetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pet::create(['owner_id' => User::where('is_staff', false)->orderBy('id')->first()->id, 'race_id' => PetRace::where('race', 'Chihuahua')->first()->id, 'name' => 'Firulais']);
        Pet::create(['owner_id' =>  User::where('is_staff', false)->latest('id')->first()->id, 'race_id' => PetRace::where('race', 'Siamés')->first()->id, 'name' => 'Bob']);
    }
}
