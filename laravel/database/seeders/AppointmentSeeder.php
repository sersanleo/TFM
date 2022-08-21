<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Pet;
use App\Models\User;
use Carbon\Carbon;
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
        $proximoLunes = Carbon::now()->next('Monday');
        Appointment::create(['vet_id' => User::where('is_staff', true)->first()->id, 'pet_id' => Pet::orderBy('id')->first()->id, 'date' => $proximoLunes]);
        Appointment::create(['vet_id' => User::where('is_staff', true)->first()->id, 'pet_id' => Pet::latest('id')->first()->id, 'date' =>  $proximoLunes->add(1, 'day')]);
    }
}
