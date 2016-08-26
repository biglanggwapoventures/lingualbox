<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');


Route::post('/login', 'AuthController@signIn')->name('auth.login');
Route::get('/logout', function(){
    Auth::logout();
    return redirect()->route('home');
})->name('auth.logout');

Route::group(['prefix' => 'registration'], function(){

    Route::get('first-step', 'RegistrationController@partOne')->name('register.first');

    Route::group(['middleware' => 'auth'], function(){
        Route::get('second-step', 'RegistrationController@partTwo')->name('register.second');
        Route::get('third-step', 'RegistrationController@partThree')->name('register.third');
    });

    Route::post('first-step', 'RegistrationController@savePartOne')->name('register.first.save');
    Route::post('second-step', 'RegistrationController@savePartTwo')->name('register.second.save');

});