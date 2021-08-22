<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MinilotoResult extends Model
{
    use HasFactory;

    protected $table = 'miniloto_results';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'times',
        'lottery_date',
        'per_numbers',
        'bonus_number'
    ];

}
