<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{

    protected $fillable = [
        'appointment_date',
        'appointment_time_start',
        'appointment_time_end',
        'service_item_id',
        'status',
        'confirmation_number',
        'salon_code',
        'pet_id',
    ];

    protected $casts = [
        'appointment_date' => 'datetime',
    ];


    use SoftDeletes;

    #Appointment=Salon
    #Appointment belongs to salon

    public function salon()
    {
        return $this->belongsTo(Salon::class, 'salon_code', 'salon_code');
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
