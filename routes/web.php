<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;

Route::get('/', function () {
    return view('welcome');
});

//add Juri
Route::get('/mypage/reservation/new', [ReservationController::class, 'selectSalon'])->name('reservation.select-salon');

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




//add Yoshi
Route::get('/login', function () {
    return view('salon_owner/login');
});

