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

//add Yoshi
Route::get('/login-salonowner', function () {
    return view('salon_owner/login');
});

