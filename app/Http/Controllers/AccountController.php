<?php

namespace App\Http\Controllers;

use App\Models\Boxes;
use App\Models\BoxUser;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('user.account.replenish-funds');
    }

    public function withDawnFunds()
    {
        return view('user.account.with-dawn-funds');
    }
}
