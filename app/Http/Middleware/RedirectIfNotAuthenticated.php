<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class RedirectIfNotAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (!Auth::guard($guard)->check()) {
            return redirect('/');
        }

        if (is_null(Auth::guard($guard)->user()->email_verified_at)) {
            Auth::logout();
            $request->session()->flash('notActiveUser', 'пожалуйста подтвердите вашу регистрация');
            return Redirect::route('sign-in');
        }

        return $next($request);
    }
}
