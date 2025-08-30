<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PetOwner\RegisterController;
use App\Http\Controllers\PetOwner\LoginController;

use App\Http\Controllers\PetOwner\Mypage\PetController;

use App\Http\Controllers\PetOwner\Mypage\ProfileController;


/* =====================================================
   Salon Owner side  
   ===================================================== */
//Register//
use App\Http\Controllers\salon_owner\SalonOwnerRegisterController;
//Login//
use App\Http\Controllers\salon_owner\SalonOwnerLoginController;
//Dashborard - service//   
use App\Http\Controllers\salon_owner\SalonOwnerServiceController;


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

/* =====================================================
   Pet Owner side  - Login
   ===================================================== */
Route::prefix('petowner')->name('pet_owner.')->group(function () {
    Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

/* =====================================================
   Pet Owner side  - Register
   ===================================================== */
Route::prefix('petowner/register')->name('pet_owner.register.')->group(function () {
    // Step 1: display salon_code page
    Route::get('/saloncode', [RegisterController::class, 'showSalonCode'])->name('saloncode');
    // Step 1: validate salon_code & keep session
    Route::post('/saloncode', [RegisterController::class, 'postSalonCode'])->name('saloncode.post');
    // Step 2: display pet_owner page
    Route::get('/petowner', [RegisterController::class, 'showPetOwner'])->name('petowner');
    // Step 2: validate pet_owner info & keep session
    Route::post('/petowner', [RegisterController::class, 'postPetOwner'])->name('petowner.post');
    // Step 3: display pet page
    Route::get('/pet', [RegisterController::class, 'showPet'])->name('pet');
    // Step 3: display pet pagevalidate pet info & keep session
    Route::post('/pet', [RegisterController::class, 'postPet'])->name('pet.post');
    // Step 4: display confrim page
    Route::get('/confirm', [RegisterController::class, 'showConfirm'])->name('confirm');
    // Step 4: validate&store
    Route::post('/confirm', [RegisterController::class, 'postConfirm'])->name('confirm.post');
    // Step 5: display complete page
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
    // show manage page
    Route::get('/mypage/pets', [PetController::class, 'index'])->name('mypage.pets.index');
    // show add page
    Route::get('/mypage/pets/create', [PetController::class, 'create'])->name('mypage.pets.create');
    // save new pet
    Route::post('/mypage/pets', [PetController::class, 'store'])->name('mypage.pets.store');
    // edit
    Route::get('/mypage/pets/{pet}/edit', [PetController::class, 'edit'])->name('mypage.pets.edit');
    // update
    Route::patch('/mypage/pets/{pet}', [PetController::class, 'update'])->name('mypage.pets.update');
    // delete
    Route::delete('/mypage/pets/{pet}', [PetController::class, 'destroy'])->name('mypage.pets.destroy');

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

// Owner Login Page (View)
Route::get('/login-salonowner', function () {
    return view('salon_owner/login');
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
// services
Route::get('dashboard-salonowner/services', function () {
    return view('salon_owner/dashboard/services');
});
// API routes for services (Ajax calls)
Route::prefix('api/salon-owner')->middleware(['web'])->group(function () {
    Route::prefix('dashboard-salonowner')->group(function () {
        Route::get('/services', [SalonOwnerServiceController::class, 'index']);
        Route::get('/services/features', [SalonOwnerServiceController::class, 'features']); // この行を追加
        Route::get('/services/{id}', [SalonOwnerServiceController::class, 'show']);
        Route::post('/services', [SalonOwnerServiceController::class, 'store']);
        Route::put('/services/{id}', [SalonOwnerServiceController::class, 'update']);
        Route::delete('/services/{id}', [SalonOwnerServiceController::class, 'destroy']);
    });
});
