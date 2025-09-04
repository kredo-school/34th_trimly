<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salon extends Model
{
    protected $fillable = [
        'salon_code',
        'salonname',
        'firstname',
        'lastname',
        'email_address',
        'phone',
        'business_address',  // add
        'city',              //add
        'state',
        'password',
        'website',
        'licencenum',
        'description',
        'open_time',
        'close_time'
    ];


    #Salon=PetOwner
    #Salon has many petowners via salon_code

    public function petOwners()
    {
        return $this->belongsToMany(PetOwner::class, 'salon_code', 'salon_id', 'petowner_id');
    }

    #Salon=Appointment
    #Salon has many appointments using salon_code

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    #Salon=Openday
    #Salon has many open_days 

    public function openDays()
    {
        return $this->hasMany(SalonOpenDay::class);
    }

    #Salon=Serviceitem
    #Salon has many service_items

    public function serviceItems()
    {
        return $this->hasMany(ServiceItem::class, 'salon_code', 'salon_code');
    }
}
