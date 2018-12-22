<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Socialite;
use App\Http\Controllers\Controller;

class SocialAuthController extends Controller
{
    const providers = [
        'vkontakte'     => "1",
        'odnoklassniki' => "2",
        'facebook'      => "3",
    ];
    /**
     * @param $provider
     * @return mixed
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * @param $provider
     * @return
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        $user = $this->findOrCreateUser($user, $provider);
        Auth::login($user);
        return redirect('/my-account');
    }

    /**
    _ If a user has registered before using social auth, return the user
    _ else, create a new user object.
    _ @param  $user Socialite user object
    _ @param $provider Social auth provider
    _ @return  User
     */
    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) return $authUser;

        return User::create([
            'provider_id'       => $user->id,
            'provider'          => $provider,
            'username'          => explode(" ", $user->name)[0].$user->id.self::providers[$provider],
            'email'             => $user->email,
            'avatar'            => $user->avatar,
            'password'          => Hash::make("123456"),
            'email_verified_at' => Carbon::now(),
            'balance'           => 0
        ]);
    }
}
