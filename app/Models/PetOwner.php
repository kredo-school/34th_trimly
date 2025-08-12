<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PetOwner extends Model
{
    #PetOwner=Pet
    #PetOwner has many pets

    public function pets()
    {
        return $this->hasMany(Pet::class);
    }

    #PetOwner=Appointment
    #PetOwner has many appointments through pets

    public function appointments()
    {
        return $this->hasManyThrough(Appointment::class, Pet::class);
    }

    #PetOwner=Salon
    #PetOwner has many salons via salon_code

    public function salons()
    {
        return $this->belongsToMany(Salon::class, 'salon_code', 'petowner_id', 'salon_id');
    }
}
