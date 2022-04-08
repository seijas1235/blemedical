<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckOut extends Model
{
    use HasFactory;
    protected $table = 'check_outs';
    protected $fillable = [
        'check_out',
        'record_id',
    ];
    public $timestamps = false;
}
