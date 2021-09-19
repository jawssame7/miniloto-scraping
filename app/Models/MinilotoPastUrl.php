<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MinilotoPastUrl extends Model
{
    use HasFactory;

    protected $table = 'miniloto_past_urls';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url',
        'async',
        'already_acquired'
    ];
}
