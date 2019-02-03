<?php

Route::get('/', "HomeController@index");
Route::get('/how-it-work', "HomeController@howItWork");
Route::post('/subscribe', "HomeController@subscribe");
Route::get('/last-winnings', "HomeController@lastWins");
Route::get('/news', "NewsController@index");
Route::get('/about', "HomeController@about");
Route::get('/contacts', "ContactController@index");
Route::get('/rules', "HomeController@rules");

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
    Route::get('/auto-spinner', 'SpinnerController@autoSpinner')->name('auto-spinner');
    Route::post('/buy-spinner', 'SpinnerController@buySpinner')->name('buy-spinner');
    Route::get('/passive-income', 'PassiveIncomeController@index')->name('passive-income');
    Route::post('/buy-passive-income', 'PassiveIncomeController@buyPassiveIncome')->name('buy-passive-income');

    // Payment actions
    Route::get('/replenish-funds', 'AccountController@replenishFunds')->name('replenish-funds');
    Route::post('/replenish-funds', 'AccountController@replenishFundsSave')->name('replenish-funds-save');
    Route::get('/withdraw-funds', 'AccountController@withDawnFunds')->name('withdraw-funds');
    Route::post('/withdraw-funds', 'AccountController@withDawnFundsSave')->name('withdraw-funds-save');
    Route::post('/replenish-funds/result', 'PaymentsController@replenishFundsResult');
    Route::get('/replenish-funds/success', 'PaymentsController@replenishFundsSuccess');
    Route::get('/replenish-funds/fail', 'PaymentsController@replenishFundsFail');
});

// Pages for admin

Route::middleware('admin')->prefix('admin')->group(function () {
    Route::get('/login', "AdminAuthController@showLoginForm")->name('admin-login');
});