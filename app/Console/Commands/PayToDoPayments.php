<?php

namespace App\Console\Commands;

use App\Libs\CPayeer;
use App\Models\PayLogs;
use App\Models\WithdrawPays;
use Illuminate\Console\Command;

class PayToDoPayments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:pay';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to pay to do pays';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $pays = WithdrawPays::select('id', 'pay', 'payeer', 'user_id')
            ->where('to_do', true)
            ->get();

        foreach ($pays as $pay) {
            $apiId           = env('PAYEER_API_ID');
            $apiKey          = env('PAYEER_SECRET');
            $amount          = number_format($pay->pay, 2, '.', '');
            $myAccountNumber = env('PAYEER_API_ACCOUNT');
            $accountNumber   = $pay->payeer;
            $userId          = $pay->user_id;

            $payeer = new CPayeer($myAccountNumber, $apiId, $apiKey);

            if ($payeer->isAuth()) {
                if ($payeer->checkUser(['user' => $accountNumber])) {
                    $arBalance = $payeer->getBalance();
                    if (isset($arBalance['balance'], $arBalance['balance']['RUB'])) {
                        if ($arBalance['balance']['RUB']['DOSTUPNO_SYST'] >= $amount) {
                            $initOutput = $payeer->initOutput([
                                'ps' => '1136053',
                                'curIn' => 'RUB',
                                'sumOut' => $amount,
                                'curOut' => 'RUB',
                                'param_ACCOUNT_NUMBER' => $accountNumber
                            ]);

                            if ($initOutput) {
                                $historyId = $payeer->output();
                                if ($historyId > 0) {
                                    // Выплата успешна
                                    $pay->state = 'success';

                                    $pay->user->decrement('balance', $amount);
                                    $pay->user->decrement('score', ceil($amount / 10));

                                    $pay->to_do = false;
                                    PayLogs::store($userId, $accountNumber,'output', 'success', $amount, 'ok');
                                } else {
                                    PayLogs::store($userId, $accountNumber, 'output', 'error', $amount, json_encode($payeer->getErrors()));
                                }
                            } else {
                                PayLogs::store($userId, $accountNumber, 'output', 'error', $amount, json_encode($payeer->getErrors()));
                            }

                        } else {
                            $pay->to_do = true;

                            $pay->user->decrement('balance', $amount);
                            $pay->user->decrement('score', ceil($amount / 10));

                            PayLogs::store($userId, $accountNumber, 'output', 'error', $amount, 'send to to_do');
                        }
                    }
                } else {
                    $pay->to_do = false;
                    PayLogs::store($userId, $accountNumber, 'output', 'error', $amount, 'not found');
                }
            } else {
                $pay->to_do = false;
                PayLogs::store($userId, $accountNumber, 'output', 'error', $amount, json_encode($payeer->getErrors()));
            }
            $pay->save();
        }
    }
}
