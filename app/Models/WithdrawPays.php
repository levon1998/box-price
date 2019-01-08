<?php

namespace App\Models;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class WithdrawPays extends Model
{
    public $table = 'withdraw_pays';

    protected $fillable = [
        'user_id',
        'payeer',
        'pay',
        'state',
        'created_at',
        'updated_at'
    ];

    /**
     * @param $userId
     * @param $payeer
     * @param $amount
     * @param $state
     * @return mixed
     */
    public static function store($userId, $payeer, $amount, $state)
    {
        return self::create([
            'user_id'    => $userId,
            'payeer'     => $payeer,
            'pay'        => $amount,
            'state'      => $state,
            'created_at' => Carbon::now(),
        ]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
