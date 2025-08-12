<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    #Pet=PetOwner
    #Pet belings to petowner

    public function petOwner()
    {
        return $this->belongsTo(PetOwner::class);
    }

    #Pet=Appointment
    #Pet has many appointments

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
