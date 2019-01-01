<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReplenishPays extends Model
{
    public $table = "replenish_pays";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'order_id',
        'pay',
        'status',
    ];
}
