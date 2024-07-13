<?php

namespace App\Mail;

use App\Models\Appointment;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AppointmentCancelledEmployee extends Mailable
{
    use Queueable, SerializesModels;

    public $appointment;
    public $user;
    public $employee;

    public function __construct(Appointment $appointment, User $user, Employee $employee)
    {
        $this->appointment = $appointment;
        $this->user = $user;
        $this->employee = $employee;
    }

    public function build()
    {
        return $this->subject('Rendez-vous annulé')
            ->view('emails.appointment_cancelled');
    }
}
