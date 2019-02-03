<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class PassiveIncome extends Model
{
    public $table = "passive_income";

    /**
     * Function to return count your income
     *
     * @return mixed
     */
    public function count()
    {
        return UserPassiveIncome::where('user_id', Auth::user()->id)->where('passive_income_id', $this->id)->count();
    }

    /**
     * Function to return all income by user id
     */
    public function incomes()
    {
        $incomes = [];
        $getIncomes = UserPassiveIncome::select('passive_income.duration', 'passive_income.price', 'user_passive_income.buy_date', 'user_passive_income.id')
            ->join('passive_income', 'passive_income.id', '=', 'user_passive_income.passive_income_id')
            ->where('user_passive_income.user_id', Auth::user()->id)
            ->where('passive_income_id', $this->id)
            ->get();

        foreach ($getIncomes as $income) {
            $buyData = new Carbon($income->buy_date);
            $passed = $buyData->diffInDays(Carbon::now());
            $incomes[] = [
                'duration' => $income->duration,
                'passed' => $passed,
                'left' => $income->duration - $passed,
                'price' => $income->price,
                'total_paid' => $income->getTotalPaid->total_paid,
            ];
        }

        return $incomes;
    }
}
