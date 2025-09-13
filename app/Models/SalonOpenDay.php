<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalonOpenDay extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'salon_id',
        'day_of_week'
    ];
    
    public function salon()
    {
        return $this->belongsTo(Salon::class);
    }
}
