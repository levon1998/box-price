<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CronLog extends Model
{
    public $table = 'cron_log';

    protected $fillable = [
        'cron_type',
        'data',
    ];
}
