<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AppointmentController extends Controller
{
    private function validateAppointment(Request $request)
    {
        return $request->validate([
            'pet_id' => ['required',  Rule::exists(Pet::class, 'id')->where(function ($query) {
                return Pet::visibleBy(Auth::user());
            })],
            'vet_id' => ['required', Rule::exists(User::class, 'id')->where(function ($query) {
                return $query->where('is_staff', true);
            })],
            'date' => 'required|date|after:today',
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
        return view('appointment.edit');
    }

    public function create_post(Request $request)
    {
        Appointment::create(AppointmentController::validateAppointment($request));
        return redirect()->route('appointment.list');
    }

    public function edit_get(Appointment $appointment)
    {
        if (Appointment::visibleBy(Auth::user())->where('id', $appointment->id)->exists())
            return view('appointment.edit')->with('appointment', $appointment);
        abort(404);
    }

    public function edit_post(Request $request, Appointment $appointment)
    {
        if (Appointment::visibleBy(Auth::user())->where('id', $appointment->id)->exists()) {
            $appointment->update(AppointmentController::validateAppointment($request));
            return redirect()->route('appointment.list');
        }
        abort(404);
    }

    public function delete(Request $request)
    {
        $appointmentId = $request->validate([
            'appointment' => 'required|exists:appointments,id'
        ])['appointment'];

        if (Appointment::visibleBy(Auth::user())->where('id', $appointmentId)->exists()) {
            Appointment::find($appointmentId)->delete();
            return redirect()->route('appointment.list');
        }
        abort(404);
    }
}
