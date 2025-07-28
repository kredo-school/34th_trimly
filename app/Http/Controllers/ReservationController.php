<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReservationController extends Controller
{
    public function selectSalon()
    {
        $salons = [
            [
                'id' => 1,
                'name' => 'Puppy Palace Downtown',
                'code' => 'PPD2824',
                'registered_date' => '10/01/2024'
            ],
            [
                'id' => 2,
                'name' => 'Furry Friends Salon',
                'code' => 'FFS2823',
                'registered_date' => '05/12/2023'
            ]
        ];

        return view('mypage.reservation.new.select-salon', compact('salons'));
    }
}