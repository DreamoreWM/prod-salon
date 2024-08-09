<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\TemporaryUser;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\SalonSetting;
use App\Models\Employee;
use App\Models\EmployeeSchedule;
use App\Models\Prestation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class CalendarController extends Controller
{
    public function index()
    {
        $categories = Category::with('prestations')->get();
        $employees = Employee::all();
        $users = User::all();
        $temporaryUsers = TemporaryUser::all(); // Récupérer les utilisateurs temporaires
        return view('calendar', compact('categories', 'employees', 'users', 'temporaryUsers'));
    }

    public function getAppointmentsByDate(Request $request)
    {
        $date = Carbon::parse($request->input('date'))->format('Y-m-d');
        $appointments = Appointment::whereDate('start_time', $date)->with('employee', 'prestations', 'bookable')->get();
        return response()->json($appointments);
    }


    public function getAvailability(Request $request)
    {
        $year = $request->query('year');
        $month = $request->query('month');

        $startDate = Carbon::createFromDate($year, $month, 1);
        $endDate = $startDate->copy()->endOfMonth();

        $appointments = Appointment::whereBetween('start_time', [$startDate, $endDate])->get();
        $availability = [];

        foreach (range(1, $endDate->day) as $day) {
            $date = Carbon::createFromDate($year, $month, $day)->format('Y-m-d');
            $dayAppointments = $appointments->filter(function($appointment) use ($date) {
                return Carbon::parse($appointment->start_time)->format('Y-m-d') == $date;
            });

            $availability[$day] = $dayAppointments->isEmpty();
        }

        return response()->json($availability);
    }

    public function getSlots(Request $request)
    {
        try {
            $date = $request->query('date');
            $employeeIds = explode(',', $request->query('employees'));
            $prestationIds = explode(',', $request->query('prestations'));

            if (empty($employeeIds)) {
                return response()->json([]);
            }

            $salonSetting = SalonSetting::first();
            $slotDuration = $salonSetting->slot_duration;
            $openDays = json_decode($salonSetting->open_days, true);

            $dayOfWeek = Carbon::parse($date)->format('l');
            if (!isset($openDays[strtolower($dayOfWeek)])) {
                return response()->json([]);
            }

            $salonDaySchedule = $openDays[strtolower($dayOfWeek)];

            $salonOpenTime = Carbon::parse($date . ' ' . $salonDaySchedule['open']);
            $salonBreakStart = Carbon::parse($date . ' ' . $salonDaySchedule['break_start']);
            $salonBreakEnd = Carbon::parse($date . ' ' . $salonDaySchedule['break_end']);
            $salonCloseTime = Carbon::parse($date . ' ' . $salonDaySchedule['close']);

            $totalDuration = empty($prestationIds) ? 0 : array_sum(Prestation::whereIn('id', $prestationIds)->pluck('temps')->toArray());

            $allSlots = [];

            $currentTime = $salonOpenTime->copy();
            while ($currentTime->lt($salonCloseTime)) {
                $slotEndTime = $currentTime->copy()->addMinutes($totalDuration > 0 ? $totalDuration : $slotDuration);
                if ($slotEndTime->gt($salonBreakStart) && $currentTime->lt($salonBreakEnd)) {
                    $currentTime = $salonBreakEnd;
                    continue;
                }

                if ($slotEndTime->gt($salonCloseTime)) {
                    break;
                }

                foreach ($employeeIds as $employeeId) {
                    $employee = Employee::find($employeeId);
                    $employeeSchedule = EmployeeSchedule::where('employee_id', $employeeId)
                        ->where('day_of_week', Carbon::parse($date)->dayOfWeek)
                        ->first();

                    if (!$employeeSchedule) {
                        continue;
                    }

                    $employeeOpenTime = Carbon::parse($date . ' ' . $employeeSchedule->start_time);
                    $employeeCloseTime = Carbon::parse($date . ' ' . $employeeSchedule->end_time);

                    if ($currentTime->lt($employeeOpenTime) || $slotEndTime->gt($employeeCloseTime)) {
                        continue;
                    }

                    $appointments = Appointment::where('employee_id', $employeeId)
                        ->whereDate('start_time', $date)
                        ->with('bookable')
                        ->get();

                    $isAvailable = true;
                    foreach ($appointments as $appointment) {
                        $appointmentStart = Carbon::parse($appointment->start_time);
                        $appointmentEnd = Carbon::parse($appointment->end_time);

                        if (($currentTime->gte($appointmentStart) && $currentTime->lt($appointmentEnd)) ||
                            ($slotEndTime->gt($appointmentStart) && $slotEndTime->lte($appointmentEnd)) ||
                            ($currentTime->lt($appointmentStart) && $slotEndTime->gt($appointmentEnd))) {
                            $isAvailable = false;
                            break;
                        }
                    }

                    if ($isAvailable) {
                        $slotKey = $currentTime->format('H:i') . '-' . $employee->name;
                        $allSlots[$slotKey] = [
                            'time' => $currentTime->format('H:i'),
                            'employee' => $employee->name,
                            'employee_id' => $employee->id,
                        ];
                    }
                }

                $currentTime->addMinutes($slotDuration);
            }

            return response()->json(array_values($allSlots));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }


    public function bookAppointment(Request $request)
    {
        try {
            Log::info('Booking appointment started.');

            $date = $request->input('date');
            $time = $request->input('time');
            $userId = $request->input('user');
            $employeeIds = $request->input('employees');
            $prestationIds = $request->input('prestations');
            $bookableType = $request->input('type');

            $start_time = Carbon::parse("$date $time");
            $totalDuration = array_sum(Prestation::whereIn('id', $prestationIds)->pluck('temps')->toArray());
            $end_time = $start_time->copy()->addMinutes($totalDuration);

            Log::info('Calculated times:', compact('start_time', 'end_time'));

            foreach ($employeeIds as $employeeId) {
                // Vérification des conflits de créneaux horaires
                $existingAppointment = Appointment::where('employee_id', $employeeId)
                    ->where(function ($query) use ($start_time, $end_time) {
                        $query->where(function ($query) use ($start_time, $end_time) {
                            $query->where('start_time', '<', $end_time)
                                ->where('end_time', '>', $start_time);
                        });
                    })->first();

                if ($existingAppointment) {
                    Log::warning('Conflict found for employee', ['employee_id' => $employeeId, 'start_time' => $start_time, 'end_time' => $end_time]);
                    return response()->json(['error' => 'Un créneau horaire est déjà réservé pour cet employé dans cette plage horaire.'], 400);
                }

                // Création du rendez-vous si aucun conflit
                $appointment = new Appointment([
                    'employee_id' => $employeeId,
                    'start_time' => $start_time,
                    'end_time' => $end_time,
                    'bookable_id' => $userId,
                    'bookable_type' => 'App\Models\\'.$bookableType
                ]);
                $appointment->save();
                $appointment->prestations()->attach($prestationIds);

                Log::info('Appointment created:', $appointment->toArray());
            }

            $user = ($bookableType === 'TemporaryUser') ? TemporaryUser::find($userId) : User::find($userId);
            $prestations = $appointment->prestations()->get();
            \Mail::to($user->email)->send(new \App\Mail\ReservationConfirmed($user, $appointment, $prestations));

            $employee = Employee::where('id',  $employeeIds)->first();
            \Mail::to($employee->email)->send(new \App\Mail\SlotBookedForEmployee($user, $appointment, $prestations));

            return response()->json(['message' => 'Appointment booked successfully!'], 200);
        } catch (\Exception $e) {
            Log::error('Booking Error', ['exception' => $e]);
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function getPrestationsByAppointment($id)
    {
        try {
            $appointment = Appointment::with('prestations')->findOrFail($id);
            return response()->json($appointment->prestations);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la récupération des prestations.'], 500);
        }
    }


    public function getEmployeeAvailability(Request $request)
    {
        $year = $request->query('year');
        $month = $request->query('month');
        $employeeIds = explode(',', $request->query('employees'));

        $startDate = Carbon::createFromDate($year, $month, 1);
        $endDate = $startDate->copy()->endOfMonth();

        $availability = [];

        foreach (range(1, $endDate->day) as $day) {
            $date = Carbon::createFromDate($year, $month, $day);
            $dayOfWeek = $date->dayOfWeek;
            $dateString = $date->format('Y-m-d');

            $employeesAvailable = EmployeeSchedule::whereIn('employee_id', $employeeIds)
                ->where('day_of_week', $dayOfWeek)
                ->exists();

            if ($employeesAvailable) {
                $availableSlots = [];

                foreach ($employeeIds as $employeeId) {
                    $employeeSchedule = EmployeeSchedule::where('employee_id', $employeeId)
                        ->where('day_of_week', $dayOfWeek)
                        ->first();

                    if ($employeeSchedule) {
                        $salonSetting = SalonSetting::first();
                        $slotDuration = $salonSetting->slot_duration;
                        $openDays = json_decode($salonSetting->open_days, true);
                        $salonDaySchedule = $openDays[strtolower($date->format('l'))];

                        $salonOpenTime = Carbon::parse($dateString . ' ' . $salonDaySchedule['open']);
                        $salonBreakStart = Carbon::parse($dateString . ' ' . $salonDaySchedule['break_start']);
                        $salonBreakEnd = Carbon::parse($dateString . ' ' . $salonDaySchedule['break_end']);
                        $salonCloseTime = Carbon::parse($dateString . ' ' . $salonDaySchedule['close']);

                        $employeeOpenTime = Carbon::parse($dateString . ' ' . $employeeSchedule->start_time);
                        $employeeCloseTime = Carbon::parse($dateString . ' ' . $employeeSchedule->end_time);

                        $currentTime = max($salonOpenTime, $employeeOpenTime);
                        while ($currentTime->lt(min($salonCloseTime, $employeeCloseTime))) {
                            $slotEndTime = $currentTime->copy()->addMinutes($slotDuration);
                            if ($slotEndTime->gt($salonBreakStart) && $currentTime->lt($salonBreakEnd)) {
                                $currentTime = $salonBreakEnd;
                                continue;
                            }

                            if ($slotEndTime->gt(min($salonCloseTime, $employeeCloseTime))) {
                                break;
                            }

                            $appointments = Appointment::where('employee_id', $employeeId)
                                ->whereDate('start_time', $dateString)
                                ->get();

                            $isAvailable = true;
                            foreach ($appointments as $appointment) {
                                $appointmentStart = Carbon::parse($appointment->start_time);
                                $appointmentEnd = Carbon::parse($appointment->end_time);

                                if (($currentTime->gte($appointmentStart) && $currentTime->lt($appointmentEnd)) ||
                                    ($slotEndTime->gt($appointmentStart) && $slotEndTime->lte($appointmentEnd)) ||
                                    ($currentTime->lt($appointmentStart) && $slotEndTime->gt($appointmentEnd))) {
                                    $isAvailable = false;
                                    break;
                                }
                            }

                            if ($isAvailable) {
                                $availableSlots[] = $currentTime->format('H:i');
                            }

                            $currentTime->addMinutes($slotDuration);
                        }
                    }
                }

                $availability[$day] = !empty($availableSlots);
            } else {
                $availability[$day] = false;
            }
        }

        return response()->json($availability);
    }

    public function getInitialAvailability(Request $request)
    {
        $year = $request->query('year');
        $month = $request->query('month');

        $startDate = Carbon::createFromDate($year, $month, 1);
        $endDate = $startDate->copy()->endOfMonth();

        $employeeIds = Employee::pluck('id')->toArray();

        $availability = [];

        foreach (range(1, $endDate->day) as $day) {
            $date = Carbon::createFromDate($year, $month, $day);
            $dayOfWeek = $date->dayOfWeek;
            $dateString = $date->format('Y-m-d');

            $employeesAvailable = EmployeeSchedule::whereIn('employee_id', $employeeIds)
                ->where('day_of_week', $dayOfWeek)
                ->exists();

            if ($employeesAvailable) {
                $availableSlots = [];

                foreach ($employeeIds as $employeeId) {
                    $employeeSchedule = EmployeeSchedule::where('employee_id', $employeeId)
                        ->where('day_of_week', $dayOfWeek)
                        ->first();

                    if ($employeeSchedule) {
                        $salonSetting = SalonSetting::first();
                        $slotDuration = $salonSetting->slot_duration;
                        $openDays = json_decode($salonSetting->open_days, true);
                        $salonDaySchedule = $openDays[strtolower($date->format('l'))];

                        $salonOpenTime = Carbon::parse($dateString . ' ' . $salonDaySchedule['open']);
                        $salonBreakStart = Carbon::parse($dateString . ' ' . $salonDaySchedule['break_start']);
                        $salonBreakEnd = Carbon::parse($dateString . ' ' . $salonDaySchedule['break_end']);
                        $salonCloseTime = Carbon::parse($dateString . ' ' . $salonDaySchedule['close']);

                        $employeeOpenTime = Carbon::parse($dateString . ' ' . $employeeSchedule->start_time);
                        $employeeCloseTime = Carbon::parse($dateString . ' ' . $employeeSchedule->end_time);

                        $currentTime = max($salonOpenTime, $employeeOpenTime);
                        while ($currentTime->lt(min($salonCloseTime, $employeeCloseTime))) {
                            $slotEndTime = $currentTime->copy()->addMinutes($slotDuration);
                            if ($slotEndTime->gt($salonBreakStart) && $currentTime->lt($salonBreakEnd)) {
                                $currentTime = $salonBreakEnd;
                                continue;
                            }

                            if ($slotEndTime->gt(min($salonCloseTime, $employeeCloseTime))) {
                                break;
                            }

                            $appointments = Appointment::where('employee_id', $employeeId)
                                ->whereDate('start_time', $dateString)
                                ->with('bookable')
                                ->get();

                            $isAvailable = true;
                            foreach ($appointments as $appointment) {
                                $appointmentStart = Carbon::parse($appointment->start_time);
                                $appointmentEnd = Carbon::parse($appointment->end_time);

                                if (($currentTime->gte($appointmentStart) && $currentTime->lt($appointmentEnd)) ||
                                    ($slotEndTime->gt($appointmentStart) && $slotEndTime->lte($appointmentEnd)) ||
                                    ($currentTime->lt($appointmentStart) && $slotEndTime->gt($appointmentEnd))) {
                                    $isAvailable = false;
                                    break;
                                }
                            }

                            if ($isAvailable) {
                                $availableSlots[] = $currentTime->format('H:i');
                            }

                            $currentTime->addMinutes($slotDuration);
                        }
                    }
                }

                $availability[$day] = !empty($availableSlots);
            } else {
                $availability[$day] = false;
            }
        }

        return response()->json($availability);
    }

    public function destroy($id)
    {
        try {
            $appointment = Appointment::findOrFail($id);
            $employee = Employee::find($appointment->employee_id);
            $user = User::find($appointment->bookable_id);
            $appointment->delete();
            \Mail::to($employee->email)->send(new \App\Mail\AppointmentCancelledEmployee($appointment, $user, $employee));
            return response()->json(['message' => 'Prestation supprimée avec succès!'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la suppression de la prestation.'], 500);
        }
    }


}

