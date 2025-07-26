<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/mypage/reservation/new', [ReservationController::class, 'selectSalon'])->name('reservation.select-salon');
