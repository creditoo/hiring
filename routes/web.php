<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
})->name('home');

Route::get('/account/profile', 'AccountController@profile')
    ->middleware('auth')
    ->name('profile');

Route::group(['prefix' => 'login'], function() {

    Route::get('github', 'Auth\LoginController@redirectToProvider')
        ->name('login');

    Route::get('github/callback', 'Auth\LoginController@handleProviderCallback');

});

Route::get('/logout', function() {
    Auth::logout();

    return redirect(route('home'));
})->name('logout');