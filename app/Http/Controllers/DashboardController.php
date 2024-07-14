<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Photospres;
use App\Models\Review;
use App\Models\SalonSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        session()->flash('admin_notification', 'Un compte administrateur de test existe -> e-mail: "admin@admin.admin" mot de passe : "test123!"');

        $photos = Photospres::all();
        $salonSetting = SalonSetting::first(); // Une seule requête pour SalonSetting
        $facebookPageUrl = $salonSetting->facebook_page_url;
        $json = $salonSetting->open_days;
        $address = $salonSetting->address;
        $openDays = json_decode($json, true);
        $categories = Category::with('prestations')->get();
        $reviews = Review::with('appointment.bookable')->with('photo')->get();
        $showNavigation = false;
        $backgroundImage = $salonSetting->background_image;
        $slogan = $salonSetting->slogan;
        $background_color = $salonSetting->background_color;

        $settings = SalonSetting::first();
        $openDays = json_decode($settings->open_days, true);

        if (json_last_error() !== JSON_ERROR_NONE || !is_array($openDays)) {
            return response()->json(['error' => 'Invalid JSON in open_days field'], 500);
        }

        $joursFrancais = [
            'monday' => 'lundi',
            'tuesday' => 'mardi',
            'wednesday' => 'mercredi',
            'thursday' => 'jeudi',
            'friday' => 'vendredi',
            'saturday' => 'samedi',
            'sunday' => 'dimanche'
        ];

        $currentDay = strtolower(Carbon::now()->format('l')); // Obtenir le jour actuel en anglais
        $currentTime = Carbon::now(); // Obtenir l'heure actuelle

        // Récupérer les horaires pour le jour actuel
        $todaySchedule = $openDays[$currentDay] ?? [];

        $isOpen = false;
        $openingTime = null;
        $closingTime = null;
        $breakStart = null;
        $breakEnd = null;

        if (!empty($todaySchedule)) {
            $openingTime = Carbon::parse($todaySchedule['open']);
            $closingTime = Carbon::parse($todaySchedule['close']);
            $breakStart = Carbon::parse($todaySchedule['break_start']);
            $breakEnd = Carbon::parse($todaySchedule['break_end']);

            if ($currentTime->between($openingTime, $breakStart) || $currentTime->between($breakEnd, $closingTime)) {
                $isOpen = true;
            }
        }

        // Trouver la prochaine ouverture
        $nextOpeningTime = null;
        if (!$isOpen) {
            $daysOfWeek = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
            $found = false;
            for ($i = 0; $i < 7; $i++) {
                $dayIndex = (array_search($currentDay, $daysOfWeek) + $i) % 7;
                $day = $daysOfWeek[$dayIndex];
                if (!empty($openDays[$day])) {
                    $nextOpening = Carbon::parse($openDays[$day]['open'])->addDays($i);
                    if ($nextOpening->greaterThan($currentTime)) {
                        $nextOpeningTime = $nextOpening;
                        break;
                    }
                }
            }
        }

        $currentDayFrench = $joursFrancais[$currentDay];
        $nextOpeningDayFrench = $nextOpeningTime ? $joursFrancais[strtolower($nextOpeningTime->format('l'))] : null;


        return view('dashboard', compact('categories', 'reviews', 'facebookPageUrl', 'openDays', 'photos', 'address', 'showNavigation', 'backgroundImage', 'background_color', 'slogan', 'salonSetting', 'isOpen', 'openingTime', 'closingTime', 'breakStart', 'breakEnd', 'nextOpeningTime', 'currentDayFrench', 'nextOpeningDayFrench'));
    }


    public function showDashboard()
    {
        return view('dashboard', ['showNavigation' => false]);
    }
    public function isOpen()
    {
        // 1. Retrieve the open_days JSON from the salon_settings table
        $salonSettings = DB::table('salon_settings')->first();
        $openDays = $salonSettings->open_days;

        // 2. Decode the JSON to a PHP array
        $openDaysArray = json_decode($openDays, true);

        // 3. Get the current day of the week and time
        $currentDay = strtolower(date('l')); // 'l' returns the full name of the day of the week
        $currentTime = date('H:i');

        // 4. Check the opening hours for the current day in the decoded array
        $todayHours = $openDaysArray[$currentDay];

        // 5. Compare the current time with the opening hours and breaks to determine if the salon is open or closed
        if ($currentTime >= $todayHours['open'] && $currentTime < $todayHours['break_start']) {
            return true;
        } elseif ($currentTime > $todayHours['break_end'] && $currentTime < $todayHours['close']) {
            return true;
        } else {
            return false;
        }
    }
}
