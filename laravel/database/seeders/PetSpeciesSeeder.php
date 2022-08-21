<?php

namespace Database\Seeders;

use App\Models\PetSpecies;
use Illuminate\Database\Seeder;

class PetSpeciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PetSpecies::insert([
            ['name' => 'Perro'],
            ['name' => 'Gato'],
        ]);
    }
}
