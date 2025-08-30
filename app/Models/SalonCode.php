<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalonCode extends Model
{
    protected $fillable = [
    'salon_code',
    'petowner_id',
];

// 追加：文字キー salon_code で Salon に紐づく
    public function salon()
    {
        return $this->belongsTo(\App\Models\Salon::class, 'salon_code', 'salon_code');
    }

}
