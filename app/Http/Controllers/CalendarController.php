<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\SalonSetting;
use App\Models\Employee;
use App\Models\EmployeeSchedule;
use App\Models\Prestation;
use App\Models\User;
use Carbon\Carbon;

class CalendarController extends Controller
{
    public function index()
    {
        $categories = Category::with('prestations')->get();
        return view('calendar', compact('categories'));
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

            if (empty($employeeIds) || empty($prestationIds)) {
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

            $totalDuration = array_sum(Prestation::whereIn('id', $prestationIds)->pluck('temps')->toArray());

            $allSlots = [];

            $currentTime = $salonOpenTime->copy();
            while ($currentTime->lt($salonCloseTime)) {
                $slotEndTime = $currentTime->copy()->addMinutes($totalDuration);
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
                            'employee' => $employee->name
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
            $date = $request->input('date');
            $time = $request->input('time');
            $userId = $request->input('user');
            $employeeIds = $request->input('employees');
            $prestationIds = $request->input('prestations');

            $start_time = Carbon::parse("$date $time");
            $totalDuration = array_sum(Prestation::whereIn('id', $prestationIds)->pluck('temps')->toArray());
            $end_time = $start_time->copy()->addMinutes($totalDuration);

            foreach ($employeeIds as $employeeId) {
                $appointment = new Appointment([
                    'employee_id' => $employeeId,
                    'start_time' => $start_time,
                    'end_time' => $end_time,
                    'bookable_id' => $userId,
                    'bookable_type' => User::class
                ]);
                $appointment->save();

                $appointment->prestations()->attach($prestationIds);
            }

            return response()->json(['message' => 'Appointment booked successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}

