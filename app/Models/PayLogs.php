<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PayLogs extends Model
{
    public $table = 'pays_log';

    protected $fillable = [
        'user_id',
        'payeer',
        'type',
        'type_state',
        'pay',
        'message',
        'created_at',
        'updated_at'
    ];

    /**
     * @param $userId
     * @param $payeer
     * @param $type
     * @param $typeState
     * @param $pay
     * @param $message
     * @return mixed
     */
    public static function store($userId, $payeer, $type, $typeState, $pay, $message)
    {
        return self::create([
            'user_id'    => $userId,
            'payeer'     => $payeer,
            'type'       => $type,
            'type_state' => $typeState,
            'pay'        => $pay,
            'message'    => $message,
            'created_at' => Carbon::now(),
        ]);
    }
}
