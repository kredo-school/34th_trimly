<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceItem extends Model
{
    #Serviceitem=Salon
    #Serviceitem belongs to salon using salon_code

    public function salon()
    {
        return $this->belongsTo(Salon::class);
    }

    #Serviceitem=Appointment
    #Serviceitem has many appointments

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
