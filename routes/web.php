<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//This is test to check the view file by Yumiko
Route::get('/login-petowner', function () {
    return view('pet_owner.login');
});

Route::get('/register-petowner', function () {
    return view('pet_owner.register.register');
});

Route::get('/login', function () {
    return view('salon_owner/login');
});
