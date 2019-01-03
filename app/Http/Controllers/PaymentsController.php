<?php

namespace App\Http\Controllers;

use App\Models\ReplenishPays;
use App\User;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function replenishFundsResult(Request $request)
    {
        if (!in_array($_SERVER['REMOTE_AD DR'], ['185.71.65.92', '185.71.65.189','149.202.17.210'])) return;

        $mOperationId = $request->input('m_operation_id');
        $mSign = $request->input('m_sign');

        if (isset($mOperationId, $mSign)) {
            $arHash = [
                $request->input('m_operation_id'),
                $request->input('m_operation_ps'),
                $request->input('m_operation_date'),
                $request->input('m_operation_pay_date'),
                $request->input('m_shop'),
                $request->input('m_orderid'),
                $request->input('m_amount'),
                $request->input('m_curr'),
                $request->input('m_desc'),
                $request->input('m_status'),
                env('M_KEY')
            ];
            $signHash = strtoupper(hash('sha256', implode(':', $arHash)));

            if ($request->input('m_sign') == $signHash && $request->input('m_status') == 'success') {
                exit($request->input('m_orderid').'|success');
            }
            exit($request->input('m_orderid').'|error');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function replenishFundsSuccess(Request $request)
    {
        // Update pay log
        $replenishPays = ReplenishPays::select('user_id', 'pay')->where('order_id', $request->input('m_orderid'))->first();
        $sum = $replenishPays->pay + ($replenishPays->pay * 20 / 100);
        $replenishPays->status = true;
        $replenishPays->total = $sum;
        $replenishPays->save();

        // Update user
        $user = User::select('id', 'balance', 'score')->where('id', $replenishPays->user_id)->first();
        $user->increment('balance', $sum);
        $user->score = $replenishPays->pay / 10;
        $user->save();

        $request->session()->flash('success', true);
        return redirect('/replenish-funds');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function replenishFundsFail(Request $request)
    {
        ReplenishPays::where('order_id', $request->input('m_orderid'))->delete();
        $request->session()->flash('success', false);
        return redirect('/replenish-funds');
    }
}
