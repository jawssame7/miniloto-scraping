<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MinilotoForecast extends Model
{
    use HasFactory;

    protected $table = 'miniloto_forecasts';

    protected $fillable = [
        'times',
        'event_date',
        'per_numbers'
    ];
}
