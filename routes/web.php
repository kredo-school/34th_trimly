<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;

Route::get('/', function () {
    return view('welcome');
});

//add Juri
Route::get('/mypage/reservation/new', [ReservationController::class, 'selectSalon'])->name('reservation.select-salon');
Route::get('/mypage/reservation/new/service', [ReservationController::class, 'selectService'])->name('reservation.select-service');
Route::get('/mypage/reservation/new/pet', [ReservationController::class, 'selectPet'])->name('reservation.select-pet');
Route::get('/mypage/reservation/new/schedule', [ReservationController::class, 'selectSchedule'])->name('reservation.select-schedule');
Route::get('/mypage/reservation/new/confirm', [ReservationController::class, 'confirm'])->name('reservation.confirm');
Route::post('/mypage/reservation/new/complete', [ReservationController::class, 'complete'])->name('reservation.complete');

//add Yumiko
Route::get('/login-petowner', function () {
return view('pet_owner.login');
});

Route::get('/register-petowner/saloncode', function () {
    return view('pet_owner.register.salon_code');
});

Route::get('/register-petowner/petowner', function () {
    return view('pet_owner.register.pet_owner');
});

Route::get('/register-petowner/pet', function () {
    return view('pet_owner.register.pet');
});

Route::get('/register-petowner/confirm', function () {
    return view('pet_owner.register.confirm');
});

Route::get('/register-petowner/complete', function () {
    return view('pet_owner.register.complete');
});

Route::get('/mypage/profile', function () {
    return view('mypage.profile');
});

Route::get('/mypage/profile-edit', function () {
    return view('mypage.profile-edit');
});

Route::get('/mypage/pet', function () {
    return view('mypage.pet');
});

Route::get('/mypage/pet-edit', function () {
    return view('mypage.pet-edit');
});

Route::get('/mypage/add-pet', function () {
    return view('mypage.add-pet');
});

Route::get('/mypage/salon', function () {
    return view('mypage.salon');
});

Route::get('/register-petowner', function () {
    return view('pet_owner.register.register');
});

/* =====================================================
   Salon Owner side  - Login
   ===================================================== */

//Owner Login//
Route::get('/login-salonowner', function () {
    return view('salon_owner/login');
});

/* =====================================================
   Salon Owner side  -Register 
   ===================================================== */

//Owner Register - confirm //
Route::get('/register-salonowner/confirm', function () {
    return view('salon_owner/register/confirm');
});

//Owner Register -saloninfo //
Route::get('/register-salonowner/salon-info', function () {
    return view('salon_owner/register/salon-info');
});
//Owner Register -saloncode //
Route::get('/register-salonowner/salon-code', function () {
    return view('salon_owner/register/salon-code');
});
//Owner Register -complete //
Route::get('/register-salonowner/complete', function () {
    return view('salon_owner/register/complete');
});

/* =====================================================
   Salon Owner side  - Dashborard   
   ===================================================== */
//Appointments//
   Route::get('dashboard-salonowner/appointments', function () {
    return view('salon_owner/dashboard/appointments');
});
// customers
   Route::get('dashboard-salonowner/customers', function () {
    return view('salon_owner/dashboard/customers');
});
// settings
Route::get('dashboard-salonowner/settings', function () {
    return view('salon_owner/dashboard/settings');
});
// settings
Route::get('dashboard-salonowner/services', function () {
    return view('salon_owner/dashboard/services');
});


