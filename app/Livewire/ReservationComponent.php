<?php

namespace App\Livewire;

use App\Models\Absence;
use App\Models\Appointment;
use App\Models\Category;
use App\Models\EmployeeSchedule;
use App\Models\SalonSetting;
use App\Models\User;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use DateTimeZone;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google_Service_Calendar_EventDateTime;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use App\Models\Prestation;
use App\Models\Employee;

class ReservationComponent extends Component
{

    public $email;
    public $prestations;
    public $employees;

    public $backgroundColor;
    public $openDays;
    public $selectedPrestations = [];
    public $selectedEmployee;
    public $availableSlots = [];
    public $showAddPrestationDiv = true;

    public $showResumePrestationDiv = true;

    public $selectedSlot = null;

    public $slotDuration;
    public $slotDurationInMinutes;
    public $slotDurationInSecondes;

    public $categories;
    public $selectedSlotDetails = null;
    public $selectedPrestationsDetails = [];

    public function mount()
    {
        $slotDurationInMinutes = SalonSetting::first()->slot_duration;
        $slotDuration = gmdate("H:i", $slotDurationInMinutes * $slotDurationInMinutes);
        $slotDurationInSec = $slotDurationInMinutes * $slotDurationInMinutes;
        $this->categories = Category::with('prestations')->get();
        $this->slotDuration = $slotDuration;
        $this->slotDurationInMinutes = $slotDurationInMinutes;
        $this->slotDurationInSecondes = $slotDurationInSec;
        $this->prestations = Prestation::all();
        $this->employees = Employee::all();
        $this->setting = SalonSetting::first();
        $this->openDays = json_decode($this->setting->open_days, true);
        $this->backgroundColor = $this->setting->background_color;
    }

    public function showConfirmationModal($date, $start)
    {
        // Récupérer les prestations sélectionnées
        $this->selectedPrestationsDetails = $this->getSelectedPrestations();

        // Calculer l'heure de fin en additionnant les durées de toutes les prestations
        $totalDuration = 0;
        foreach ($this->selectedPrestationsDetails as $prestation) {
            $totalDuration += $prestation['temps'];
        }

        // Convertir l'heure de début en objet DateTime
        $startDatetime = new DateTime($date . ' ' . $start);

        // Calculer l'heure de fin en ajoutant la durée totale des prestations à l'heure de début
        $endDatetime = clone $startDatetime;
        $endDatetime->add(new DateInterval('PT' . $totalDuration . 'M'));

        // Mettre à jour les détails du créneau sélectionné
        $this->selectedSlotDetails = [
            'date' => $date,
            'start' => $start,
            'end' => $endDatetime->format('H:i')
        ];

        // Dispatch de l'événement avec les détails nécessaires
        $this->dispatch('show-swal-confirmation', detail: [
            'prestations' => $this->selectedPrestationsDetails,
            'slot' => $this->selectedSlotDetails,
            'employeeId' => $this->selectedEmployee
        ]);
    }

    private function isSlotAvailable($startTime, $endTime, $employeeId)
    {
        $requestedSlot = [
            'start' => Carbon::parse($startTime),
            'end' => Carbon::parse($endTime),
        ];

        $existingAppointments = Appointment::where('employee_id', $employeeId)->get();

        // Retrieve the absences of the employee
        $absences = Absence::where('employee_id', $employeeId)->get();

        foreach ($existingAppointments as $appointment) {
            $existingSlot = [
                'start' => Carbon::parse($appointment->start_time),
                'end' => Carbon::parse($appointment->end_time),
            ];

            if ($this->doSlotsOverlap($requestedSlot, $existingSlot)) {
                return false;
            }
        }

        // Check the absences
        foreach ($absences as $absence) {
            $absenceSlot = [
                'start' => Carbon::parse($absence->start_time),
                'end' => Carbon::parse($absence->end_time),
            ];

            if ($this->doSlotsOverlap($requestedSlot, $absenceSlot)) {
                return false;
            }
        }

        return true;
    }
    private function doSlotsOverlap($slot1, $slot2)
    {
        return $slot1['start']->lt($slot2['end']) && $slot1['end']->gt($slot2['start']);
    }

    public function updatedSelectedPrestations()
    {
        $this->getAvailableSlots();
    }

    public function updatedSelectedEmployee()
    {
        $this->getAvailableSlots();
    }

    public function getAvailableSlots()
    {
        if ($this->selectedPrestations && $this->selectedEmployee) {
            $employee = Employee::find($this->selectedEmployee);
            $employeeSchedules = EmployeeSchedule::where('employee_id', $employee->id)->get();

            $this->availableSlots = [];

            // Calculer la durée totale des prestations sélectionnées
            $totalDuration = 0;
            foreach ($this->selectedPrestations as $prestationId) {
                $prestation = Prestation::find($prestationId);
                $totalDuration += $prestation->temps;
            }

            // Déterminer la date de début (aujourd'hui) et la date de fin (dans un mois)
            $startDate = now();
            $endDate = now()->addMonth();

            while ($startDate <= $endDate) {
                $dayOfWeek = $startDate->format('w'); // 0 (dimanche) à 6 (samedi)

                // Vérifier si le jour est ouvert pour l'employé
                foreach ($employeeSchedules as $schedule) {
                    if ($schedule->day_of_week == $dayOfWeek) {
                        $openHours = $this->openDays[strtolower($startDate->format('l'))];
                        $scheduleStart = strtotime($schedule->start_time);
                        $scheduleEnd = strtotime($schedule->end_time);
                        $scheduleBreakStart = strtotime($schedule->break_start);
                        $scheduleBreakEnd = strtotime($schedule->break_end);
                        $shopBreakStart = strtotime($openHours['break_start']);
                        $shopBreakEnd = strtotime($openHours['break_end']);

                        $currentTime = max($scheduleStart, strtotime($openHours['open']));
                        while ($currentTime + $totalDuration * $this->slotDurationInMinutes <= min($scheduleEnd, strtotime($openHours['close']))) {
                            // Vérifier si le créneau n'est pas pendant la pause de l'employé
                            if ($currentTime + $totalDuration * $this->slotDurationInMinutes <= $scheduleBreakStart || $currentTime >= $scheduleBreakEnd) {
                                // Vérifier si le créneau n'est pas pendant la pause du salon
                                if ($currentTime + $totalDuration * $this->slotDurationInMinutes <= $shopBreakStart || $currentTime >= $shopBreakEnd) {
                                    $startDatetime = new DateTime($startDate->format('Y-m-d') . ' ' . date('H:i', $currentTime));
                                    $endDatetime = clone $startDatetime;
                                    $endDatetime->add(new DateInterval('PT' . $totalDuration . 'M'));

                                    // Vérifier si le créneau est disponible
                                    if ($this->isSlotAvailable($startDatetime, $endDatetime, $this->selectedEmployee)) {
                                        $slotStart = date('H:i', $currentTime);
                                        $slotEnd = date('H:i', $currentTime + $totalDuration * $this->slotDurationInMinutes);
                                        $this->availableSlots[] = [
                                            'start' => $slotStart,
                                            'end' => $slotEnd,
                                            'date' => $startDate->format('Y-m-d'),
                                        ];
                                    }
                                }
                            }
                            $currentTime += ($this->slotDurationInMinutes * 60);
                        }
                    }
                }

                $startDate->addDay(); // Passer au jour suivant
            }
        }
    }
    public function deletePrestation($index)
    {
        unset($this->selectedPrestations[$index]);
        $this->selectedPrestations = array_values($this->selectedPrestations);
        $this->getAvailableSlots();
    }

    public function toggleAddPrestationDiv()
    {
        $this->showAddPrestationDiv = !$this->showAddPrestationDiv;
    }

    public function getSelectedPrestations()
    {
        $selectedPrestations = [];
        foreach ($this->selectedPrestations as $prestationId) {
            $nameCategorie = Category::find(Prestation::find($prestationId)->category_id)->name;
            $prestation = Prestation::find($prestationId);
            $selectedPrestations[] = [
                'id' => $prestation->id,
                'name' => $prestation->nom,
                'temps' => $prestation->temps,
                'prix' => $prestation->prix,
                'categorie' => $nameCategorie,
            ];
        }
        return $selectedPrestations;
    }

    public function togglePrestation($prestationId)
    {
        if (in_array($prestationId, $this->selectedPrestations)) {
            $key = array_search($prestationId, $this->selectedPrestations);
            unset($this->selectedPrestations[$key]);
            $this->selectedPrestations = array_values($this->selectedPrestations);
        } else {
            $this->selectedPrestations[] = $prestationId;
        }
        $this->getAvailableSlots();
        $this->toggleAddPrestationDiv();
        $this->dispatch('prestationSelected');
    }

    public function selectEmployee($employeeId)
    {
        $this->selectedEmployee = $employeeId;

        $this->dispatch('employeeSelected');
    }

    public function render()
    {
        return view('livewire.reservation-component');
    }
}
