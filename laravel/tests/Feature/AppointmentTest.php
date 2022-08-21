<?php

namespace Tests\Feature;

use App\Models\Appointment;
use App\Models\Pet;
use App\Models\User;
use Carbon\Carbon;
use Database\Seeders\AppointmentSeeder;
use Database\Seeders\PetRaceSeeder;
use Database\Seeders\PetSeeder;
use Database\Seeders\PetSpeciesSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AppointmentTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed([
            UserSeeder::class,
            PetSpeciesSeeder::class,
            PetRaceSeeder::class,
            PetSeeder::class
        ]);
    }

    public function test_delete_successfully()
    {
        $this->seed(AppointmentSeeder::class);

        $vet = User::where('is_staff', true)->first();
        $appointment = Appointment::first();

        $this->actingAs($vet)->post(route('appointment.delete'), [
            'appointment' => $appointment->id
        ]);

        $this->assertDatabaseMissing('appointments', [
            'id' => $appointment->id
        ]);
    }

    public function test_delete_unsuccessfully()
    {
        $this->seed(AppointmentSeeder::class);

        $appointment = Appointment::first();
        $customer = User::where([['is_staff', false], ['id', '!=', $appointment->pet->owner_id]])->first();

        $this->actingAs($customer)->post(route('appointment.delete'), [
            'appointment' => $appointment->id
        ]);

        $this->assertDatabaseHas('appointments', [
            'id' => $appointment->id
        ]);
    }

    public function test_edit_successfully()
    {
        $this->seed(AppointmentSeeder::class);

        $appointment = Appointment::first();
        $newDate = date('Y-m-d H:i', strtotime($appointment->date . ' + 7 days'));
        $vet = User::where('is_staff', true)->first();

        $response = $this->actingAs($vet)->post(route('appointment.edit', $appointment->id), [
            'pet_id' => $appointment->pet_id,
            'vet_id' => $appointment->vet_id,
            'date' => $newDate
        ]);

        $response->assertValid();
        $this->assertDatabaseHas('appointments', [
            'id' => $appointment->id,
            'date' => $newDate
        ]);
    }

    public function test_edit_unsuccessfully()
    {
        $this->seed(AppointmentSeeder::class);

        $appointment = Appointment::orderBy('id')->first();
        $otherAppointment = Appointment::latest('id')->first();
        $vet = User::where('is_staff', true)->first();

        $response = $this->actingAs($vet)->post(route('appointment.edit', $appointment->id), [
            'pet_id' => $appointment->pet_id,
            'vet_id' => $otherAppointment->vet_id,
            'date' => $otherAppointment->date
        ]);


        $response->assertInvalid();
        $this->assertDatabaseMissing('appointments', [
            'id' => $appointment->id,
            'date' => $otherAppointment->date
        ]);
    }

    public function test_create_successfully()
    {
        $pet = Pet::first();
        $vet = User::where('is_staff', true)->first();
        $date = Carbon::now()->next('Monday')->format('y-m-d H:i');

        $response = $this->actingAs($pet->owner)->post(route('appointment.create'), [
            'pet_id' => $pet->id,
            'vet_id' => $vet->id,
            'date' => $date
        ]);

        $response->assertValid();
        $this->assertDatabaseHas('appointments', [
            'pet_id' => $pet->id,
            'vet_id' => $vet->id,
            'date' => $date
        ]);
    }
}
