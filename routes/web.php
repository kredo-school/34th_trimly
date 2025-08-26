<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PetOwner\RegisterController;


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


// ペットオーナー登録フローのルートグループ
Route::prefix('petowner/register')->name('pet_owner.register.')->group(function () {
    // Step 1: サロンコード入力フォームを表示 (GET)
    Route::get('/saloncode', [RegisterController::class, 'showSalonCode'])->name('saloncode');
    // Step 1: サロンコードを検証・セッション保存 (POST)
    Route::post('/saloncode', [RegisterController::class, 'postSalonCode'])->name('saloncode.post');
    // Step 2: ペットオーナー情報入力フォームの表示 (GET)
    Route::get('/petowner', [RegisterController::class, 'showPetOwner'])->name('petowner');
    // Step 2: ペットオーナー情報の検証とセッション保存 (POST)
    Route::post('/petowner', [RegisterController::class, 'postPetOwner'])->name('petowner.post');
    // Step 3: ペット情報入力フォームの表示 (GET)
    Route::get('/pet', [RegisterController::class, 'showPet'])->name('pet');
    // Step 4: 確認画面の表示 (GET)
    Route::get('/confirm', [RegisterController::class, 'showConfirm'])->name('confirm');
    // Step 5: 登録完了画面の表示 (GET)
    Route::get('/complete', [RegisterController::class, 'showComplete'])->name('complete');
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

Route::get('/mypage/reserve', function () {
    return view('mypage.reservation');
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

//Owner Appointments Calendar //
Route::get('/salon-owner/calendar', function () {
    return view('salon_owner.calendar');
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


