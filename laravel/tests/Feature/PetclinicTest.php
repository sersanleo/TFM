<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_register_successfully()
    {
        $email = 'test@test.com';
        $response = $this->post(route('register'), [
            'email' => $email,
            'password' => 'SafePassword123.',
            'password_confirmation' => 'SafePassword123.',
            'first_name' => 'Test',
            'last_name' => 'Test',
            'address' => 'Test',
            'birthday' => '2000-01-01'
        ]);

        $response->assertValid();
        $response->assertRedirect(route('login'));
        $this->assertDatabaseHas('users', [
            'email' => $email
        ]);
    }

    public function test_register_error()
    {
        $email = 'test@test.com';
        $response = $this->post(route('register'), [
            'email' => $email,
            'password' => 'SafePassword123.',
            'password_confirmation' => 'unmatched',
            'first_name' => 'Test',
            'last_name' => 'Test',
            'address' => 'Test',
            'birthday' => date('y-m-d', strtotime('+2 days'))
        ]);

        $response->assertInvalid(['password', 'birthday']);
        $this->assertDatabaseMissing('users', [
            'email' => $email
        ]);
    }

    public function test_login_successful()
    {
        $user = User::factory()->create();

        $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $this->assertAuthenticatedAs($user);
    }
}
