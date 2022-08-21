<?php

namespace Tests\Feature;

use App\Models\Pet;
use App\Models\PetRace;
use App\Models\User;
use Database\Seeders\PetRaceSeeder;
use Database\Seeders\PetSeeder;
use Database\Seeders\PetSpeciesSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PetTest extends TestCase
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
        $vet = User::where('is_staff', true)->first();
        $pet = Pet::first();

        $this->actingAs($vet)->post(route('pet.delete'), [
            'pet' => $pet->id
        ]);

        $this->assertDatabaseMissing('pets', [
            'id' => $pet->id
        ]);
    }

    public function test_delete_unsuccessfully()
    {
        $customer = User::where('is_staff', false)->first();
        $pet = Pet::first();

        $this->actingAs($customer)->post(route('pet.delete'), [
            'pet' => $pet->id
        ]);

        $this->assertDatabaseHas('pets', [
            'id' => $pet->id
        ]);
    }

    public function test_edit_successfully()
    {
        $vet = User::where('is_staff', true)->first();
        $pet = Pet::first();
        $newName = $pet->name . ' test';

        $response = $this->actingAs($vet)->post(route('pet.edit', $pet->id), [
            'owner_id' => $pet->owner_id,
            'race_id' =>  $pet->race_id,
            'name' => $newName
        ]);

        $response->assertValid();
        $this->assertDatabaseHas('pets', [
            'id' => $pet->id,
            'name' => $newName
        ]);
    }

    public function test_edit_unsuccessfully()
    {
        $vet = User::where('is_staff', true)->first();
        $pet = Pet::first();

        $response = $this->actingAs($vet)->post(route('pet.edit', $pet->id), [
            'owner_id' => $pet->owner_id,
            'race_id' =>  $pet->race_id,
            'name' => $pet->name,
            'birthday' => date('y-m-d', strtotime('+1 days'))
        ]);

        $response->assertInvalid();
        $this->assertDatabaseHas('pets', [
            'id' => $pet->id,
            'birthday' => $pet->birthday
        ]);
    }

    public function test_create_successfully()
    {
        $vet = User::where('is_staff', true)->first();
        $customer = User::where('is_staff', false)->first();

        $this->actingAs($vet)->post(route('pet.create'), [
            'owner_id' => $customer->id,
            'name' => 'Test',
            'race_id' => PetRace::first()->id
        ]);

        $this->assertDatabaseHas('pets', [
            'name' => 'Test'
        ]);
    }
}
