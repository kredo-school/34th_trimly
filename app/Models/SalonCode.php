<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalonCode extends Model
{
    protected $fillable = [
    'salon_code',
    'petowner_id',
];

}
