<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TollFee extends Model
{
    use HasFactory;
    protected $table = 'toll_fees';
    protected $fillable = [
        'toll_fee',

    ];
}
