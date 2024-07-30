<?php

use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SalonController;
use App\Models\Review;
use App\Models\SalonSetting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SlotController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PrestationController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PhotoPresController;
use App\Http\Controllers\EmployeeScheduleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
use Illuminate\Http\Request;  // Importez la bonne classe Request

Route::get('/debug-session', function (Request $request) {
    return response()->json([
        'session' => $request->session()->all()
    ]);
});

Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

// Route pour la redirection vers Google
Route::get('auth/google', [LoginController::class, 'redirectToGoogle'])->name('auth.google');

// Route pour le callback de Google
Route::get('auth/google/callback', [LoginController::class, 'handleGoogleCallback'])->name('auth.google.callback');

Route::get('/navbar', function () {
    $backgroundColor = SalonSetting::first()->background_color;
    return view('navbar', ['backgroundColor' => $backgroundColor]);
});

Route::resource('/dashboard', DashboardController::class);

Route::get('/confidentiality', function () {
    return view('confidentiality');
})->name('confidentiality');

Route::get('/reviews/list', [ReviewController::class, 'list'])->name('reviews.list');


Route::middleware(['jwt', 'role:user,admin'])->group(function () {
    Route::post('/confirm-reservation', [ReservationController::class, 'confirmReservation'])->name('confirmReservation');
    Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::delete('/appointments/{appointment}', [AppointmentController::class, 'cancel'])->name('appointments.cancel');


});

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::post('/users/{id}/update-role', [UsersController::class, 'updateRole']);
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/{role}', [RoleController::class, 'show'])->name('roles.show');
    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');
    Route::get('/employee-slots/{employeeId}', 'EmployeeController@getSlotsForEmployee');
    Route::resource('/prestations', PrestationController::class);
    Route::resource('/employees', EmployeeController::class);
    Route::resource('/users', UsersController::class);
    Route::get('/employees/{employee}/slots', [SlotController::class, 'index'])->name('employees.slots.index');
    Route::get('/salon/settings', [SalonController::class, 'edit'])->name('salon.edit');
    Route::put('/salon/settings', [SalonController::class, 'update'])->name('salon.update');

    Route::get('/calendar', [CalendarController::class, 'index']);
    Route::get('/calendar/availability', [CalendarController::class, 'getAvailability']);
    Route::get('/calendar/slots', [CalendarController::class, 'getSlots']);
    Route::post('/calendar/book', [CalendarController::class, 'bookAppointment'])->name('calendar.book');
    Route::get('/calendar/employee-availability', [CalendarController::class, 'getEmployeeAvailability'])->name('calendar.employee-availability');
    Route::get('/calendar/initial-availability', [CalendarController::class, 'getInitialAvailability'])->name('calendar.initial-availability');


    Route::get('/employees/{employee}/schedule', [EmployeeScheduleController::class, 'edit'])->name('employees.schedule.edit');
    Route::post('/employees/{employee}/schedule', [EmployeeScheduleController::class, 'store'])->name('employees.schedule.store');
    Route::post('/calendar', [CalendarController::class, 'assign'])->name('calendar.assign');
    Route::post('/calendar/delete', [CalendarController::class, 'delete']);
    Route::resource('/absences',AbsenceController::class);
    Route::resource('/reviews', ReviewController::class);
    Route::resource('/photos', PhotoPresController::class);
});

require __DIR__.'/auth.php';
