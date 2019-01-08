<?php

namespace App\Http\Controllers;

use App\Models\Spinners;
use App\Models\UserSpinner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpinnerController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function autoSpinner()
    {
        $spinners = Spinners::select('id', 'name', 'description', 'price', 'level')
            ->orderBy('level')
            ->get();

        return view('user.auto-spinner.auto-spinner', compact('spinners'));
    }

    public function buySpinner(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:spinner,id',
        ]);

        $spinner = Spinners::select('id', 'level', 'price')->find($request->input('id'));
        if (Auth::user()->balance >= $spinner->price) {
            $nextSpinner = Spinners::select('id', 'level', 'price')->find($request->input('id') + 1);
            if (is_null(Auth::user()->spinner)) {
                if ($spinner->level == 1) {
                    UserSpinner::create([
                        'user_id'    => Auth::user()->id,
                        'spinner_id' => $request->input('id')
                    ]);
                    Auth::user()->decrement('balance', $spinner->price);
                    $content = $this->generateModalContent('Поздравляем', '/img/auto-spinner.png', "Вы успешно приобрели авто спиннер уровня {$spinner->level}", 'OK');
                    $nextButton = is_null($nextSpinner) ? null : "<button class='btn-alpha mt2 buy-spinner redirect-btn' data-spinner-id='{$nextSpinner->id}'>{$nextSpinner->price} Рублей</button>";
                    $response = ['status' => 'OK', 'body' => $content, 'data' => ['nextButton' => $nextButton, 'balance' => number_format(Auth::user()->balance, 2, '.', ' ')]];
                } else {
                    $content = $this->generateModalContent('Произошла ошибка', '/img/404.png', "Вы не можете купить этот авто спиннер ", 'ERROR');
                    $response = ['status' => 'OK', 'body' => $content];
                }
            } else {
                if (Auth::user()->spinner->spinner_id + 1 == $spinner->id) {
                    UserSpinner::where('user_id', Auth::user()->id)->update(['spinner_id' => $spinner->id]);
                    Auth::user()->decrement('balance', $spinner->price);

                    $content = $this->generateModalContent('Поздравляем', '/img/auto-spinner.png', "Вы успешно приобрели авто спиннер уровня {$spinner->level}", 'OK');
                    $nextButton = is_null($nextSpinner) ? null : "<button class='btn-alpha mt2 buy-spinner redirect-btn' data-spinner-id='{$nextSpinner->id}'>{$nextSpinner->price} Рублей</button>";
                    $response = ['status' => 'OK', 'body' => $content, 'data' => ['nextButton' => $nextButton, 'balance' => number_format(Auth::user()->balance, 2, '.', ' ')]];
                } else {
                    $content = $this->generateModalContent('Произошла ошибка', '/img/404.png', "Вы не можете купить этот авто спиннер ", 'ERROR');
                    $response = ['status' => 'OK', 'body' => $content];
                }
            }
        } else {
            $content  = $this->generateModalContent('недостаточно средства', '/img/Balance_justice.png', "К сожалению вашем счету недостаточно средств хотите пополнить его.", 'BALANCE');
            $response = ['status' => 'BALANCE', 'body' => $content];
        }

        return response()->json($response);
    }

    /**
     * @param $header
     * @param $image
     * @param $content
     * @param $status
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
