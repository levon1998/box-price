<?php

namespace App\Http\Controllers;

use App\Models\PassiveIncome;
use App\Models\UserPassiveIncome;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PassiveIncomeController extends Controller
{
    /**
     * Function to return passive income index page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $passiveIncome = PassiveIncome::select('id', 'title', 'duration', 'price', 'daily_income', 'description', 'image')->get();

        return view('user.passive-income.index', compact('passiveIncome'));
    }

    /**
     * Function to buy new passive income
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function buyPassiveIncome(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:passive_income,id',
        ]);
        $passiveIncome = PassiveIncome::select('id', 'title', 'description', 'image', 'duration', 'price', 'daily_income')->find($request->input('id'));
        $user = User::select('id', 'balance')->find(Auth::user()->id);

        if (!empty($passiveIncome) && !empty($user)) {
            if ($passiveIncome->price <= $user->balance) {
                UserPassiveIncome::store($user->id, $passiveIncome->id);
                $user->decrement('balance', $passiveIncome->price);
                $user->save();

                $content  = $this->generateModalContent('Поздравляем', $passiveIncome->image, "Вы успешно приобрели пассивный источник дохода который будет вам {$passiveIncome->daily_income} рубля в день в течении {$passiveIncome->duration} дней.", 'OK', false);
                $response = ['status' => 'OK', 'body' => $content, 'data' => ['balance' => number_format($user->balance, 2, '.', ' ')]];

            } else {
                $content  = $this->generateModalContent('недостаточно средства', '/img/Balance_justice.png', "К сожалению вашем счету недостаточно средств хотите пополнить его.", 'BALANCE', false);
                $response = ['status' => 'BALANCE', 'body' => $content, 'data' => ['balance' => number_format($user->balance, 2, '.', ' ')]];
            }
        } else {
            $content  = $this->generateModalContent('Произошла ошибка', '/img/404.png', "Ошибка 404", 'ERROR');
            $response = ['status' => 'ERROR', 'body' => $content];
        }

        return response()->json($response);
    }

    /**
     * @param $header
     * @param $image
     * @param $content
     * @param $status
     * @param $hideMyBoxes
     * @return string
     * @throws \Throwable
     */
    private function generateModalContent($header, $image, $content, $status)
    {
        return view('user.home.modal-content')->with([
            'header'        => $header,
            'image'         => $image,
            'content'       => $content,
            'status'        => $status,
            'hideMyBoxes'   => true
        ])->render();
    }
}
