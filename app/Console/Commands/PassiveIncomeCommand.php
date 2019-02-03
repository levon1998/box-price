<?php

namespace App\Console\Commands;

use App\Models\PassiveIncomePayLogs;
use App\Models\UserPassiveIncome;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PassiveIncomeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:passive-income';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to pay passive income obligations';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // delete expired passive incomes
        UserPassiveIncome::where('end_date', '<', Carbon::now())->update(['deleted' => true]);

        //pay passive income obligations
        $userPassiveIncomes = UserPassiveIncome::select([
                'user_passive_income.id as id',
                'user_passive_income.user_id as user_id',
                'passive_income.daily_income as daily_income'
            ])
            ->join('passive_income', 'passive_income.id', '=', 'user_passive_income.passive_income_id')
            ->where('deleted', false)
            ->get();

        foreach ($userPassiveIncomes as $passiveIncome) {

            $totalPaid = PassiveIncomePayLogs::where('user_passive_income_id', $passiveIncome->id)->sum('amount');
            $passiveIncome->user->increment('balance', $passiveIncome->daily_income);
            $passiveIncome->save();

            $passiveIncomeLog = new PassiveIncomePayLogs([
                'user_id'                   => $passiveIncome->user_id,
                'user_passive_income_id'    => $passiveIncome->id,
                'amount'                    => $passiveIncome->daily_income,
                'total_paid'                => $totalPaid + $passiveIncome->daily_income,
                'total_user_balance'        => $passiveIncome->user->balance,
            ]);
            $passiveIncomeLog->save();

        }

    }
}
