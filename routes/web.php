<?php

Route::get('/', "HomeController@index");
Route::get('/how-it-work', "HomeController@howItWork");
Route::post('/subscribe', "HomeController@subscribe");
Route::get('/last-winnings', "HomeController@lastWins");

// Pages for not Authenticated users

Route::middleware('guest')->group(function () {
    Route::get('/sign-up', "Auth\RegisterController@showRegistrationForm");
    Route::post('/sign-up', "Auth\RegisterController@register");
    Route::get('/sign-in', "Auth\LoginController@showLoginForm")->name('sign-in');
    Route::post('/sign-in', "Auth\LoginController@login");
    Route::get('/confirm-email', "HomeController@confirmEmail");
    Route::get('/confirm/{id}/{token}', "HomeController@confirm")->where(['id' => '[0-9]+']);

    //Social Auth
    Route::get('auth/{provider}', 'Auth\SocialAuthController@redirectToProvider');
    Route::get('auth/{provider}/callback', 'Auth\SocialAuthController@handleProviderCallback');
});

//Pages for Authenticated users

Route::middleware('user')->group(function () {
    Route::get('/my-account', "AccountController@index")->name('my-account');
    Route::get('/logout', "Auth\LoginController@logout");
    Route::post('/buy-new-box', 'BoxController@buyNewBox');
    Route::get('/my-boxes', 'AccountController@myBoxes')->name('my-boxes');
    Route::post('/open-box', 'AccountController@openBox')->name('open-box');

    Route::get('/replenish-funds', 'AccountController@replenishFunds')->name('replenish-funds');
    Route::get('/withdraw-funds', 'AccountController@withdawnFunds')->name('withdraw-funds');
});