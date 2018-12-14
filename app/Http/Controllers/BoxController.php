<?php

namespace App\Http\Controllers;

use App\Models\Boxes;
use App\Models\BoxUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BoxController extends Controller
{
    /**
     * Function to buy a new box
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function buyNewBox(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:boxes,id',
        ]);
        $box  = Boxes::select('id', 'price', 'image_source')->find($request->input('id'));
        $user = User::select('id', 'balance')->find(Auth::user()->id);

        if (!empty($box) && !empty($user)) {
            if ($box->price <= $user->balance) {
                BoxUser::buyBox($box->id, $user->id);
                $user->decrement('balance', $box->price);
                $user->save();
                $maxPrice = $box->price * 2;
                $content  = view('user.home.modal-content')->with([
                    'header'  => 'Поздравляем',
                    'image'   => $box->image_source,
                    'content' => "Вы успешно приобрели ящик с возможным вигишом до {$maxPrice} рублей.",
                    'status'  => 'OK'
                ])->render();
                $response = ['status' => 'OK', 'body' => $content, 'data' => ['balance' => number_format($user->balance, 2, '.', ' ')]];
            } else {
                $content = view('user.home.modal-content')->with([
                    'header'  => 'недостаточно средства',
                    'image'   => '/img/Balance_justice.png',
                    'content' => "К сожалению вашем счету недостаточно средств хотите пополнить его.",
                    'status'  => 'BALANCE'
                ])->render();
                $response = ['status' => 'BALANCE', 'body' => $content, 'data' => ['balance' => number_format($user->balance, 2, '.', ' ')]];
            }
        } else {
            $content = view('user.home.modal-content')->with([
                'header'  => 'Произошла ошибка',
                'image'   => '/img/404.png',
                'content' => "Ошибка ящик не найден.",
                'status'  => 'ERROR'
            ])->render();
            $response = ['status' => 'ERROR', 'body' => $content];
        }
        return response()->json($response);
    }
}
