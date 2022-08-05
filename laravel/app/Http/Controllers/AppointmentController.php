<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class AppointmentController extends Controller
{
    public static function validateAppointment(Request $request, $appointmentId = null)
    {
        return $request->validate([
            'pet_id' => ['required',  Rule::exists(Pet::class, 'id')->where(function ($query) {
                return Pet::visibleBy(Auth::user());
            })],
            'vet_id' => ['required', Rule::exists(User::class, 'id')->where(function ($query) {
                return $query->where('is_staff', true);
            })],
            'date' => [
                'required', 'date', 'after:today',
                function ($attribute, $value, $fail) {
                    if (date('N', strtotime($value)) >= 6)
                        $fail('Los fines de semana no se pueden reservar citas.');
                },
                Rule::unique('appointments')->where(fn ($query) => $query->where('vet_id', $request->input('vet_id')))->ignore($appointmentId)
            ],
            'annotations' => 'nullable'
        ]);
    }

    public function list()
    {
        $appointments = Appointment::visibleBy(Auth::user())->orderBy('date', 'desc')->paginate(10);
        return view('appointment.list')->with('appointments', $appointments);
    }

    public function create_get()
    {
        Gate::authorize('create-appointment');
        return view('appointment.edit')->with('appointment', null);
    }

    public function create_post(Request $request)
    {
        Gate::authorize('create-appointment');
        Appointment::create(AppointmentController::validateAppointment($request));
        return redirect()->route('appointment.list');
    }

    public function edit_get(Appointment $appointment)
    {
        Gate::authorize('update-appointment', $appointment);
        return view('appointment.edit')->with('appointment', $appointment);
    }

    public function edit_post(Request $request, Appointment $appointment)
    {
        Gate::authorize('update-appointment', $appointment);
        $appointment->update(AppointmentController::validateAppointment($request, $appointment->id));
        return redirect()->route('appointment.list');
    }

    public function delete(Request $request)
    {
        $appointmentId = $request->validate([
            'appointment' => 'required|exists:appointments,id'
        ])['appointment'];
        $appointment = Appointment::find($appointmentId);

        Gate::authorize('delete-appointment', $appointment);
        $appointment->delete();
        return redirect()->route('appointment.list');
    }
}
