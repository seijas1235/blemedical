<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;
    protected $table = 'records';
    protected $fillable = [
        'vehicle_registration_type_id',
        'vehicle_license_plates',
        'parking_time',
    ];
}
