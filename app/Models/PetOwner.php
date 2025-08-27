<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Illuminate\Foundation\Auth\Userをインポート
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class PetOwner extends Authenticatable
{

    // HasFactoryとSoftDeletes traitを使用
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'firstname',
        'lastname',
        'email_address',
        'phone',
        'city',
        'prefecture',
        'password',
    ];

    // パスワードを隠す設定を追加（セキュリティのため）
    protected $hidden = [
        'password',
    ];




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
