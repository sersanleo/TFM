<?php

namespace App\Providers;

use App\Models\Appointment;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('create-pet', fn (User $user) => $user->is_staff);
        Gate::define('view-pet', fn (User $user, Pet $pet) => Pet::visibleBy($user)->where('id', $pet->id)->exists());
        Gate::define('update-pet', fn (User $user, Pet $pet) => $user->is_staff);
        Gate::define('delete-pet', fn (User $user, Pet $pet) => $user->is_staff);

        Gate::define('create-appointment', fn (User $user) => true);
        Gate::define('view-appointment', fn (User $user, Appointment $appointment) =>  Appointment::visibleBy($user)->where('id', $appointment->id)->exists());
        Gate::define('update-appointment', fn (User $user, Appointment $appointment) =>  Appointment::visibleBy($user)->where('id', $appointment->id)->exists());
        Gate::define('delete-appointment', fn (User $user, Appointment $appointment) =>  Appointment::visibleBy($user)->where('id', $appointment->id)->exists());
    }
}
