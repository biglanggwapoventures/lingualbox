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
        Route::post('second-step', 'RegistrationController@savePartTwo')->name('register.second.save');
        Route::post('third-step', 'RegistrationController@savePartThree')->name('register.third.save');
    });

    Route::post('first-step', 'RegistrationController@savePartOne')->name('register.first.save');
});

Route::group(['prefix' => 'exams', 'middleware' => 'admin-only'], function(){
    Route::group(['prefix' => 'reading'], function(){
        Route::group(['prefix' => 'edit'], function(){

            Route::get('storyboard', 'ReadingExamController@editStoryboard')->name('reading.storyboard.edit');
            Route::post('storyboard', 'ReadingExamController@saveStoryboard')->name('reading.storyboard.save');

            Route::get('questions', 'ReadingExamController@addQuestion')->name('reading.questions.create');
            Route::post('questions', 'ReadingExamController@storeQuestion')->name('reading.questions.store');
            
            Route::get('questions/{id}', 'ReadingExamController@editQuestion')->name('reading.questions.edit');
            Route::post('questions/{id}', 'ReadingExamController@updateQuestion')->name('reading.questions.update');

        });
    });
});

Route::get('/profile', 'ProfileController@showProfile')->middleware('auth')->name('profile');

