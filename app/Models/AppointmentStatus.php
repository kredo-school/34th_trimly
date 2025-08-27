<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppointmentStatus extends Model
{

    #Appointmentstatus=appointmenst
    #Appointmentstatus has many appointments

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'status', 'status_name');
    }
}
