<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleRegistrationType extends Model
{
    use HasFactory;
    protected $table = 'vehicle_registration_types';
    protected $fillable = [
        'vehicle_registration_type',

    ];

}
