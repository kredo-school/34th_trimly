<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    #Appointment=Salon
    #Appointment belongs to salon

    public function salon()
    {
        return $this->belongsTo(Salon::class);
    }

    #Appointment=Pet
    #Appointment belongs to pet

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    #Appointment=Status
    #Appointment belongs to status

    public function appointmentStatus()
    {
        return $this->belongsTo(AppointmentStatus::class, 'status', 'status_name');
    }

    #Appointment=Serviceitem
    #Appointment belongs to serviceitem

    public function serviceItem()
    {
        return $this->belongsTo(ServiceItem::class);
    }
}
