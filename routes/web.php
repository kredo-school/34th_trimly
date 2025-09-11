<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PetOwner\LoginController;
use App\Http\Controllers\PetOwner\RegisterController;
use App\Http\Controllers\PetOwner\Mypage\PetController;
use App\Http\Controllers\PetOwner\Mypage\SalonController;
use App\Http\Controllers\PetOwner\Mypage\ProfileController; 
use App\Http\Controllers\PetOwner\Mypage\ReservationController as MypageReservationController;
/* =====================================================
   Salon Owner side  
   ===================================================== */
//Register//
use App\Http\Controllers\salon_owner\SalonOwnerLoginController;
//Login//
use App\Http\Controllers\salon_owner\SalonOwnerServiceController;
//Dashborard - service//   
use App\Http\Controllers\salon_owner\SalonOwnerRegisterController;
//Dashborard - setting// 
use App\Http\Controllers\salon_owner\SalonOwnerSettingsController;
//Dashborard - customer// 
use App\Http\Controllers\salon_owner\SalonOwnerCustomerController;
//Dashborard - calendar// 
use App\Http\Controllers\SalonOwner\CalendarController;

Route::get('/', function () {
    return view('welcome');
});

// Compatibility aliases for default Laravel auth route names
Route::get('/login', function () {
    return redirect()->route('pet_owner.login');
})->name('login');
Route::get('/register', function () {
    return redirect()->route('pet_owner.register.saloncode');
})->name('register');

//add Juri
Route::get('/mypage/reservation/new', [ReservationController::class, 'selectSalon'])->name('reservation.select-salon');
Route::get('/mypage/reservation/new/service', [ReservationController::class, 'selectService'])->name('reservation.select-service');
Route::get('/mypage/reservation/new/pet', [ReservationController::class, 'selectPet'])->name('reservation.select-pet');
Route::get('/mypage/reservation/new/schedule', [ReservationController::class, 'selectSchedule'])->name('reservation.select-schedule');
Route::get('/mypage/reservation/new/confirm', [ReservationController::class, 'confirm'])->name('reservation.confirm');
Route::post('/mypage/reservation/new/complete', [ReservationController::class, 'complete'])->name('reservation.complete');

/* =====================================================
   Pet Owner side  - Login
   ===================================================== */
Route::prefix('petowner')->name('pet_owner.')->group(function () {
    Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});
/* =====================================================
   Pet Owner side  - Logout
   ===================================================== */
Route::post('/petowner/logout', [LoginController::class, 'logout'])->name('pet_owner.logout');

/* =====================================================
   Pet Owner side  - Register
   ===================================================== */
Route::prefix('petowner/register')->name('pet_owner.register.')->group(function () {
    Route::get('/saloncode', [RegisterController::class, 'showSalonCode'])->name('saloncode');
    Route::post('/saloncode', [RegisterController::class, 'postSalonCode'])->name('saloncode.post');
    Route::get('/petowner', [RegisterController::class, 'showPetOwner'])->name('petowner');
    Route::post('/petowner', [RegisterController::class, 'postPetOwner'])->name('petowner.post');
    Route::get('/pet', [RegisterController::class, 'showPet'])->name('pet');
    Route::post('/pet', [RegisterController::class, 'postPet'])->name('pet.post');
    Route::get('/confirm', [RegisterController::class, 'showConfirm'])->name('confirm');
    Route::post('/confirm', [RegisterController::class, 'postConfirm'])->name('confirm.post');
    Route::get('/complete', [RegisterController::class, 'showComplete'])->name('complete');
});

/* =====================================================
   Pet Owner side  - MyPage
   ===================================================== */
Route::middleware('auth:petowner')->group(function () {
    /*Profile*/
    Route::get('/mypage/profile', [ProfileController::class, 'showProfile'])->name('mypage.profile');
    Route::post('/mypage/profile/password', [ProfileController::class, 'updatePassword'])->name('mypage.password.update');
    Route::get('/mypage/profile/edit', [ProfileController::class, 'editProfile'])->name('mypage.profile.edit');
    Route::patch('/mypage/profile', [ProfileController::class, 'updateProfile'])->name('mypage.profile.update');
});
    /*Pets*/
Route::middleware(['auth:petowner'])->group(function () {
    Route::get('/mypage/pets', [PetController::class, 'index'])->name('mypage.pets.index');
    Route::get('/mypage/pets/create', [PetController::class, 'create'])->name('mypage.pets.create');
    Route::post('/mypage/pets', [PetController::class, 'store'])->name('mypage.pets.store');
    Route::get('/mypage/pets/{pet}/edit', [PetController::class, 'edit'])->name('mypage.pets.edit');
    Route::patch('/mypage/pets/{pet}', [PetController::class, 'update'])->name('mypage.pets.update');
    Route::delete('/mypage/pets/{pet}', [PetController::class, 'destroy'])->name('mypage.pets.destroy');
});
    /*Salons*/
Route::middleware(['auth:petowner'])->group(function () {
    Route::get('/mypage/salon', [SalonController::class, 'index'])->name('mypage.salon');
    Route::post('/mypage/salon', [SalonController::class, 'store'])->name('mypage.salon.store');
    Route::delete('/mypage/salon/{salonCode}', [SalonController::class, 'destroy'])->name('mypage.salon.destroy');
});
    /*Reservations*/
Route::middleware(['auth:petowner'])->group(function () {
    Route::get('/mypage/reservation', [MypageReservationController::class, 'index'])->name('mypage.reservation.index');
    Route::patch('/mypage/reservation/{appointment}', [MypageReservationController::class, 'update'])->name('mypage.reservation.update');
    Route::delete('/mypage/reservation/{appointment}', [MypageReservationController::class, 'destroy'])->name('mypage.reservation.destroy');
    Route::post('/mypage/reservation/{appointment}/rebook', [MypageReservationController::class, 'rebook'])->name('mypage.reservation.rebook');
});




/* =====================================================
   Salon Owner side  - Login
   ===================================================== */

// Owner Login Page (View)
Route::get('/login-salonowner', function () {
    return view('salon_owner/login');
})->name('salonowner.login');

// Backward compatibility: GET /salon-owner/login -> login page (301)
Route::get('/salon-owner/login', function () {
    return redirect()->route('salonowner.login', [], 301);
});

// Owner Login API Routes
Route::post('/salon-owner/login', [SalonOwnerLoginController::class, 'login']);
Route::post('/salon-owner/logout', [SalonOwnerLoginController::class, 'logout']);
Route::get('/salon-owner/profile', [SalonOwnerLoginController::class, 'profile']);
Route::get('/salon-owner/check', [SalonOwnerLoginController::class, 'check']);

/* =====================================================
   Salon Owner side  -Register 
   ===================================================== */

// //Owner Register - confirm //
// Route::get('/register-salonowner/confirm', function () {
//     return view('salon_owner/register/confirm');
// });

// //Owner Register -saloninfo //
// Route::get('/register-salonowner/salon-info', function () {
//     return view('salon_owner/register/salon-info');
// });
// //Owner Register -saloncode //
// Route::get('/register-salonowner/salon-code', function () {
//     return view('salon_owner/register/salon-code');
// });
// //Owner Register -complete //
// Route::get('/register-salonowner/complete', function () {
//     return view('salon_owner/register/complete');
// });

Route::prefix('register-salonowner')->name('salon.register.')->group(function () {
    Route::get('/', [SalonOwnerRegisterController::class, 'create'])->name('create');
    Route::post('/confirm', [SalonOwnerRegisterController::class, 'confirm'])->name('confirm');
    Route::post('/store', [SalonOwnerRegisterController::class, 'store'])->name('store');
    Route::get('/complete', [SalonOwnerRegisterController::class, 'complete'])->name('complete');
});

//Owner Appointments Calendar //
// Juri - 2025-08-30 - Implemented salon owner calendar backend to fetch and display appointments from DB
Route::get('/salon-owner/calendar', [CalendarController::class, 'index'])->name('salon-owner.calendar');
Route::post('/salon-owner/appointments/{id}/cancel', [CalendarController::class, 'cancelAppointment'])->name('salon-owner.appointments.cancel');
/* =====================================================
   Salon Owner side  - Dashborard   
   ===================================================== */
//Appointments//
Route::get('dashboard-salonowner/appointments', function () {
    return view('salon_owner/dashboard/appointments');
});
// customers// Customer page
Route::get('dashboard-salonowner/customers', [SalonOwnerCustomerController::class, 'index'])
->name('salonowner.customers');

// API routes for customers
Route::prefix('api/salon-owner')->middleware(['web'])->group(function () {
Route::get('/customers', [SalonOwnerCustomerController::class, 'getCustomers']);
Route::get('/customers/{id}', [SalonOwnerCustomerController::class, 'show']);
Route::delete('/customers/{id}', [SalonOwnerCustomerController::class, 'destroy']);
});
// // settings
// Route::get('dashboard-salonowner/settings', function () {
//     return view('salon_owner/dashboard/settings');
// });

// Settings page route
Route::get('dashboard-salonowner/settings', [SalonOwnerSettingsController::class, 'showSettingsPage'])
    ->name('salon-owner.settings');

// API routes for settings
Route::prefix('api/salon-owner')->middleware(['web'])->group(function () {
    Route::get('/settings', [SalonOwnerSettingsController::class, 'index']);
    Route::put('/settings', [SalonOwnerSettingsController::class, 'update']);
});
// services
// Route::get('dashboard-salonowner/services', function () {
//     return view('salon_owner/dashboard/services');
    // services - Changed to pass feature data
Route::get('dashboard-salonowner/services', [SalonOwnerServiceController::class, 'showServicesPage'])->name('salonowner.dashboard.services.get');
    
// API routes for services (Ajax calls)
Route::prefix('api/salon-owner')->middleware(['web'])->group(function () {
    Route::get('/services', [SalonOwnerServiceController::class, 'index']);
    Route::get('/services/features', [SalonOwnerServiceController::class, 'getFeatures']); 
    Route::get('/services/{id}', [SalonOwnerServiceController::class, 'show']);
    Route::post('/services', [SalonOwnerServiceController::class, 'store'])->name('salonowner.services.post');
    Route::put('/services/{id}', [SalonOwnerServiceController::class, 'update']);
    Route::delete('/services/{id}', [SalonOwnerServiceController::class, 'destroy']);

});
