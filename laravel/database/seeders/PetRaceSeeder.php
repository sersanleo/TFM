<?php

namespace Database\Seeders;

use App\Models\PetRace;
use App\Models\PetSpecies;
use Illuminate\Database\Seeder;

class PetRaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PetRace::insert([
            ['race' => 'Chihuahua', 'species_id' => PetSpecies::where('name', 'Perro')->first()->id],
            ['race' => 'Siamés', 'species_id' => PetSpecies::where('name', 'Gato')->first()->id]
        ]);
    }
}
