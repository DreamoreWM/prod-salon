<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\TemporaryUser;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReservationController extends Controller
{
    public function confirmReservation(Request $request)
    {
        $data = $request->validate([
            'date' => 'required|date',
            'start' => 'required',
            'end' => 'required',
            'prestations' => 'required|json',
        ]);

        $prestations = json_decode($data['prestations'], true);

        $user = auth()->check() ? auth()->user() : TemporaryUser::firstOrCreate(['email' => $this->temporaryUser->email, 'name' => $this->name ?? ""]);


        // Créer la nouvelle réservation
        $appointment = Appointment::create([
            'employee_id' => $request->employee_id,
            'start_time' => $data['date'] . ' ' . $data['start'],
            'end_time' => $data['date'] . ' ' . $data['end'],
            'bookable_id' => $user->id,
            'bookable_type' => get_class($user),
        ]);

        // Lier les prestations à la réservation
        foreach ($prestations as $prestation) {
            $appointment->prestations()->attach($prestation['id']);
        }

        // Envoyer un email de confirmation
        $prestations = $appointment->prestations()->get();
        Mail::to($user->email)->send(new \App\Mail\ReservationConfirmed($user, $appointment, $prestations));
        $employee = Employee::find($request->employee_id);
        Mail::to($employee->email)->send(new \App\Mail\SlotBookedForEmployee($user, $appointment, $prestations));

        return redirect('/dashboard')->with('success', 'Le créneau a été réservé avec succès.');
    }
}
