<?php

namespace App\Console\Commands;

use App\Mail\ReviewInvitation;
use App\Models\Appointment;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class CheckAppointments extends Command
{
    protected $signature = 'check:appointments';

    protected $description = 'Check if appointments are completed and send review invitations';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Récupérer tous les rendez-vous qui sont terminés mais pour lesquels l'invitation n'a pas encore été envoyée
        $appointments = Appointment::where('is_completed', true)
            ->where('review_invitation_sent', false)
            ->get();

        foreach ($appointments as $appointment) {
            // Envoyer l'invitation pour un avis
            Mail::to($appointment->bookable->email)->send(new ReviewInvitation($appointment));

            // Marquer que l'invitation a été envoyée
            $appointment->review_invitation_sent = true;
            $appointment->save();
        }
    }
}
