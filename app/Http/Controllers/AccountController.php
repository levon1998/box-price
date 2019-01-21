<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReplenishFundsSaveRequest;
use App\Http\Requests\WithDrawFundsSaveRequest;
use App\Libs\CPayeer;
use App\Models\Boxes;
use App\Models\BoxUser;
use App\Models\PayLogs;
use App\Models\ReplenishPays;
use App\Models\WithdrawPays;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;

class AccountController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $lastWins = BoxUser::select('boxes.name', 'box_user.created_at', 'box_user.opened_date', 'box_user.price')
            ->join('boxes', 'boxes.id', '=', 'box_user.box_id')
            ->where('user_id', Auth::user()->id)
            ->where('state', 'open')
            ->orderBy('created_at', 'desc')
            ->limit(20)
            ->get();

        return view('user.account.index', compact('lastWins'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function myBoxes()
    {
        $closedBoxes = BoxUser::getUserBoxes('closed');
        $openBoxes = BoxUser::getUserBoxes('open');

        return view('user.account.my-boxes', compact('closedBoxes', 'openBoxes'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function openBox(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:box_user,id',
        ]);

        $boxUser = BoxUser::select('id','box_id')->where('id', $request->input('id'))->where('state', 'closed')->where('user_id', Auth::user()->id)->first();

        if ($boxUser) {
            $box = Boxes::select('image_source', 'min_prize', 'max_prize')->find($boxUser->box_id);
            $price = rand($box->min_prize, $box->max_prize - Boxes::getDecrementValue($boxUser->box_id));

            $boxUser->state         = 'open';
            $boxUser->opened_date   = Carbon::now();
            $boxUser->price         = $price;
            $boxUser->save();

            User::where('id', Auth::user()->id)->increment('balance', $price);
            $user = User::select('balance')->find(Auth::user()->id);

            $content  = view('user.home.modal-content')->with([
                'header'  => 'Поздравляем',
                'image'   => $box->image_source,
                'content' => "Поздравляю вы выиграли выигрыш в стоимости {$price} рублей.",
                'status'  => 'OPEN_STATE'
            ])->render();
            $response = ['status' => 'OK', 'body' => $content, 'data' => ['price' => $price, 'balance' => number_format($user->balance, 2, '.', ' ')]];
        } else {
            $content = view('user.home.modal-content')->with([
                'header'  => 'Произошла ошибка',
                'image'   => '/img/404.png',
                'content' => "Ошибка ящик не найден.",
                'status'  => 'ERROR'
            ])->render();
            $response = ['status' => 'ERROR', 'body' => $content, 'data' => []];
        }

        return response()->json($response);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function replenishFunds()
    {
        $lastWins = ReplenishPays::select('order_id', 'pay', 'created_at')
            ->where('user_id', Auth::user()->id)
            ->where('status', true)
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get();

        return view('user.account.replenish-funds', compact('lastWins'));
    }

    /**
     * @param ReplenishFundsSaveRequest $request
     * @return void
     */
    public function replenishFundsSave(ReplenishFundsSaveRequest $request)
    {
        $userId = Auth::user()->id;
        $mOrderId = uniqid(time().Auth::user()->id);
        $sum = number_format($request->input('m_amount'), 2, '.', '');

        $arHash['m_shop'] = env('PAYEER_M_ID');
        $arHash['m_orderid'] = '154809729255c46170cee152';//$mOrderId;
        $arHash['m_amount'] = $sum;
        $arHash['m_curr'] = env('PAYEER_M_CURR');
        $arHash['m_desc'] = base64_encode('Пополнения счета');
        $arHash['m_key']  = env('M_KEY');
        $arHash['m_sign'] = strtoupper(hash('sha256', implode(':', $arHash)));

        ReplenishPays::create([
            'user_id' => $userId,
            'order_id' => $mOrderId,
            'pay' => $sum,
            'status' => false
        ]);

        return redirect(env('PAYEER_MERCHENT_URL').http_build_query($arHash));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function withDawnFunds()
    {
        $lastPays = WithdrawPays::select('id', 'payeer', 'pay', 'state', 'created_at')
            ->where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->get();

        return view('user.account.with-dawn-funds', compact('lastPays'));
    }

    /**
     * @param WithDrawFundsSaveRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function withDawnFundsSave(WithDrawFundsSaveRequest $request)
    {
        $apiId           = env('PAYEER_API_ID');
        $apiKey          = env('PAYEER_SECRET');
        $amount          = number_format($request->input('m_amount'), 2, '.', '');
        $myAccountNumber = env('PAYEER_API_ACCOUNT');
        $accountNumber   = $request->input('payeer_account');
        $userId          = Auth::user()->id;

        $payeer = new CPayeer($myAccountNumber, $apiId, $apiKey);
        $withdrawPays = WithdrawPays::store($userId, $accountNumber, $amount, 'in_process');

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
                                $withdrawPays->state = 'success';

                                Auth::user()->decrement('balance', $amount);
                                Auth::user()->decrement('score', ceil($amount / 10));

                                $request->session()->flash('success', true);
                                $request->session()->flash('message', "Поздравляем. выплата успешно выполнено.");
                                PayLogs::store($userId, $accountNumber,'output', 'success', $amount, 'ok');
                            } else {

                                $request->session()->flash('success', true);
                                $request->session()->flash('message', "Ошибка, пожалуйста попробуйте немного позже.");
                                PayLogs::store($userId, $accountNumber, 'output', 'error', $amount, json_encode($payeer->getErrors()));
                            }
                        } else {

                            $request->session()->flash('success', false);
                            $request->session()->flash('message', "Ошибка, пожалуйста попробуйте немного позже.");
                            PayLogs::store($userId, $accountNumber, 'output', 'error', $amount, json_encode($payeer->getErrors()));
                        }

                    } else {
                        $withdrawPays->to_do = true;

                        Auth::user()->decrement('balance', $amount);
                        Auth::user()->decrement('score', ceil($amount / 10));

                        $request->session()->flash('success', true);
                        $request->session()->flash('message', "Поздравляем. выплата успешно выполнено.");
                        PayLogs::store($userId, $accountNumber, 'output', 'error', $amount, 'send to to_do');
                    }
                }
                $withdrawPays->save();
            } else {
                $request->session()->flash('success', false);
                $request->session()->flash('message', "Кошелек не найден.");
                PayLogs::store($userId, $accountNumber, 'output', 'error', $amount, 'not found');
            }
        } else {
            $request->session()->flash('success', false);
            $request->session()->flash('message', "Ошибка, пожалуйста попробуйте немного позже.");
            PayLogs::store($userId, $accountNumber, 'output', 'error', $amount, json_encode($payeer->getErrors()));
        }

        return redirect()->route('withdraw-funds');
    }
}
