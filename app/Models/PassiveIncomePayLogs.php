<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PassiveIncomePayLogs extends Model
{
    public $table = "passive_income_pay_logs";

    protected $fillable =[
        'user_id',
        'user_passive_income_id',
        'amount',
        'total_paid',
        'total_user_balance'
    ];
}
