<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Appointment::create(['vet_id' => User::where('is_staff', true)->first()->id, 'pet_id' => Pet::orderBy('id')->first()->id, 'date' => date('y-m-d H:i', strtotime('+1 days'))]);
        Appointment::create(['vet_id' => User::where('is_staff', true)->first()->id, 'pet_id' => Pet::latest('id')->first()->id, 'date' => date('y-m-d H:i', strtotime('+2 days'))]);
    }
}
