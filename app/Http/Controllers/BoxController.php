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
                $content  = $this->generateModalContent('Поздравляем', $box->image_source, "Вы успешно приобрели ящик с возможным вигишом до {$maxPrice} рублей.", 'OK', false);
                $response = ['status' => 'OK', 'body' => $content, 'data' => ['balance' => number_format($user->balance, 2, '.', ' ')]];
            } else {
                $content  = $this->generateModalContent('недостаточно средства', '/img/Balance_justice.png', "К сожалению вашем счету недостаточно средств хотите пополнить его.", 'BALANCE', false);
                $response = ['status' => 'BALANCE', 'body' => $content, 'data' => ['balance' => number_format($user->balance, 2, '.', ' ')]];
            }
        } else {
            $content  = $this->generateModalContent('Произошла ошибка', '/img/404.png', "Ошибка ящик не найден.", 'ERROR');
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
    private function generateModalContent($header, $image, $content, $status, $hideMyBoxes = true)
    {
        return view('user.home.modal-content')->with([
            'header'        => $header,
            'image'         => $image,
            'content'       => $content,
            'status'        => $status,
            'hideMyBoxes'   => $hideMyBoxes
        ])->render();
    }
}
