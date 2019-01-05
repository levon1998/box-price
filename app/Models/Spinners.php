<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spinners extends Model
{
    public $table = 'spinner';

    protected $fillable = [
        'level',
        'name',
        'description',
        'price'
    ];
}
