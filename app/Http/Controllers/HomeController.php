<?php

namespace App\Http\Controllers;

use App\Models\Boxes;
use App\Models\BoxUser;
use App\Models\Subscriber;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SEO;

class HomeController extends Controller
{
    /**
     * Function to return home page
     */
    public function index()
    {
        SEO::setTitle('Главная страница');
        SEO::setDescription('Новые возможности онлайн заработка с минимальным рисками ');
        SEO::opengraph()->setUrl(url('/'));
        SEO::setCanonical(url('/'));
        SEO::opengraph()->addProperty('type', 'articles');

        $boxes = Boxes::select('id', 'name', 'description', 'price', 'image_source')->get();
        return view('user.home.index', compact('boxes'));
    }

    /**
     * Function to return home page
     */
    public function howItWork()
    {
        return view('user.how-it-work.index');
    }

    /**
     * Function to return home page
     */
    public function confirmEmail()
    {
        $confirmed = false;
        return view('user.confirm-email.index', compact('confirmed'));
    }

    /**
     * Function to return home page
     * @param $userId
     * @param $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function confirm($userId, $token)
    {
        $confirmed  = true;
        $user       = User::where('id', $userId)->where('verify_token', $token)->whereDate('created_at', '>', Carbon::now()->subDay())->first();
        if (!$user) abort(404);

        $user->verify_token      = null;
        $user->email_verified_at = Carbon::now();
        $user->save();

        return view('user.confirm-email.index', compact('confirmed'));
    }

    /**
     * Function to save subscriber email
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function subscribe(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|unique:subscribers,email|max:255|min:2',
        ]);

        $subscriber = new Subscriber();
        $subscriber->email = $request->input('email');
        $subscriber->save();

        return response()->json(['status' => 'ok', 'message' => 'Спасибо За Подписку']);
    }

    /**
     * Function to return lasts wins
     */
    public function lastWins()
    {
        SEO::setTitle('Последние Выигрыши');
        SEO::setDescription('Новые возможности онлайн заработка с минимальным рисками ');
        SEO::opengraph()->setUrl(url('/'));
        SEO::setCanonical(url('/last-winnings'));
        SEO::opengraph()->addProperty('type', 'articles');

        $lastWins = BoxUser::select('boxes.name', 'box_user.created_at', 'box_user.opened_date', 'box_user.price', 'users.username')
            ->join('boxes', 'boxes.id', '=', 'box_user.box_id')
            ->join('users', 'users.id', '=', 'box_user.user_id')
            ->where('state', 'open')
            ->orderBy('created_at', 'desc')
            ->limit(20)
            ->get();

        return view('user.last-wins.index', compact('lastWins'));
    }

    /**
     * Function to return about page
     */
    public function about()
    {
        SEO::setTitle('О проекте Box Price');
        SEO::setDescription('Новые возможности онлайн заработка с минимальным рисками ');
        SEO::opengraph()->setUrl(url('/'));
        SEO::setCanonical(url('/about'));
        SEO::opengraph()->addProperty('type', 'articles');

        return view('user.about.about');
    }
}
