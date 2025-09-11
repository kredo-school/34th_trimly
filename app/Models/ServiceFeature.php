<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceFeature extends Model
{
    // Disable timestamps since your table has NULL values
    public $timestamps = false;
    
    // Define the table name explicitly
    protected $table = 'service_features';
}