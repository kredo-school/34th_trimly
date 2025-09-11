<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalonCode extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'salon_code',
        'petowner_id',
    ];

    /**
     * Get the salon associated with this salon code
     * Links to Salon model using salon_code as the foreign key
     */
    public function salon()
    {
        return $this->belongsTo(\App\Models\Salon::class, 'salon_code', 'salon_code');
    }

    /**
     * Get the pet owner associated with this salon code
     */
    public function petOwner()
    {
        return $this->belongsTo(\App\Models\PetOwner::class, 'petowner_id');
    }
}
// // 追加：文字キー salon_code で Salon に紐づく
//     public function salon()
//     {
//         return $this->belongsTo(\App\Models\Salon::class, 'salon_code', 'salon_code');
//     }

// }
