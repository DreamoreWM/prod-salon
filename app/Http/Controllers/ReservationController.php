<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\TemporaryUser;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
            'email' => 'nullable|email',  // Ajoutez la validation pour l'email
        ]);

        $prestations = json_decode($data['prestations'], true);

        if (auth()->check()) {
            $user = auth()->user();
        } else {
            // Vérifiez si l'utilisateur temporaire existe déjà par email
            $user = User::where('email', $data['email'])->first();

            if (!$user) {
                // Si l'utilisateur n'existe pas, créez un nouvel utilisateur temporaire
                $user = TemporaryUser::create([
                    'email' => $data['email'],
                    'name' => 'Utilisateur Temporaire',  // Vous pouvez demander le nom dans le formulaire ou le générer ici
                ]);
            }
        }

        $employeeId = $request->employee_id;
        $start_time = $data['date'] . ' ' . $data['start'];
        $end_time = $data['date'] . ' ' . $data['end'];

        $existingAppointment = Appointment::where('employee_id', $employeeId)
            ->where(function ($query) use ($start_time, $end_time) {
                $query->where(function ($query) use ($start_time, $end_time) {
                    $query->where('start_time', '<', $end_time)
                        ->where('end_time', '>', $start_time);
                });
            })->first();

        if ($existingAppointment) {
            Log::warning('Conflict found for employee', ['employee_id' => $employeeId, 'start_time' => $start_time, 'end_time' => $end_time]);
            return redirect('/dashboard')->with('error', 'Le créneau a été réservé par une autre personne simultanément. Veuillez réessayer avec un autre créneau.');
        }

        // Créer la nouvelle réservation
        $appointment = Appointment::create([
            'employee_id' => $employeeId,
            'start_time' => $start_time,
            'end_time' => $end_time,
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
        $employee = Employee::find($employeeId);
        Mail::to($employee->email)->send(new \App\Mail\SlotBookedForEmployee($user, $appointment, $prestations));

        return redirect('/dashboard')->with('success', 'Le créneau a été réservé avec succès.');
    }

}
