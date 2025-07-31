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

//add Yoshi
Route::get('/login', function () {
    return view('salon_owner/login');
});

