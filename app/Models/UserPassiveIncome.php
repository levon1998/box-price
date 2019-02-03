<?php

namespace App\Models;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class UserPassiveIncome extends Model
{
    public $table = "user_passive_income";

    public $timestamps=false;

    protected $fillable =[
        'user_id',
        'passive_income_id',
        'buy_date',
        'end_date',
        'deleted'
    ];


    /**
     * Function to store data in to db
     *
     * @param $userId
     * @param $passiveIncomeId
     */
    public static function store($userId, $passiveIncomeId)
    {
        $passiveIncome = PassiveIncome::select('duration')->find($passiveIncomeId);

        $userPassiveIncome = new self();
        $userPassiveIncome->user_id = $userId;
        $userPassiveIncome->passive_income_id = $passiveIncomeId;
        $userPassiveIncome->buy_date = Carbon::now();
        $userPassiveIncome->end_date = Carbon::now()->addDays($passiveIncome->duration);
        $userPassiveIncome->deleted = false;
        $userPassiveIncome->save();
    }

    /**
     * Function to get user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * Function to get last total paid
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getTotalPaid()
    {
        return $this->hasOne(PassiveIncomePayLogs::class, 'user_passive_income_id', 'id')->latest()->limit(1);
    }

}
