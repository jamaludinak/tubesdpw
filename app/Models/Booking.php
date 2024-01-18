<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'bkg_id',
        'name',
        'room',
        'total_numbers',
        'rent',
        'date',
        'time',
        'arrival_date',
        'depature_date',
        'message',
    ];
}
