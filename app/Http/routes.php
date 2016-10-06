<?php
Route::get('/', function () {
    return view('home');
})->name('home');

Route::post('/login', 'AuthController@signIn')->name('auth.login');

Route::get('/logout', function(){
    Auth::logout();
    return redirect()->route('home');
})->name('auth.logout');

Route::get('/forgot-password', 'ForgotPasswordController@index')->name('password.forgot.page');
Route::post('/forgot-password', 'ForgotPasswordController@sendRecoveryEmail')->name('password.recover.email');
Route::get('/reset-password/{token}', 'ForgotPasswordController@showRecoveryPage')->name('password.recover.page');
Route::post('/reset-password/{token}', 'ForgotPasswordController@resetPassword')->name('password.reset');

Route::group(['prefix' => 'registration'], function(){

    Route::get('first-step', 'RegistrationController@partOne')->name('register.first');

    Route::group(['middleware' => 'auth'], function(){
        Route::get('second-step', 'RegistrationController@partTwo')->name('register.second');
        Route::get('third-step', 'RegistrationController@partThree')->name('register.third');

        Route::group(['middleware' => 'check-past-reading-exam'], function(){
            Route::get('pre-reading-exam', 'RegistrationController@readingExamConfirmation')->name('pre.reading.exam');
            Route::get('reading-exam', 'RegistrationController@startReadingExam')->name('reading.exam');
            Route::post('reading-exam', 'RegistrationController@saveReadingExamResults')->name('reading.exam.save');
        });

        Route::group(['middleware' => 'check-past-written-exam'], function(){
            Route::get('pre-written-exam', 'RegistrationController@writtenExamConfirmation')->name('pre.written.exam');
            Route::get('written-exam', 'RegistrationController@startWrittenExam')->name('written.exam');
            Route::post('written-exam', 'RegistrationController@saveWrittenExamResults')->name('written.exam.save');
        });
        

        Route::post('second-step', 'RegistrationController@savePartTwo')->name('register.second.save');
        Route::post('third-step', 'RegistrationController@savePartThree')->name('register.third.save');
        Route::get('resend-verification', 'RegistrationController@resendVerification')->name('email.verification.resend');
    });

    Route::post('first-step', 'RegistrationController@savePartOne')->name('register.first.save');
});

Route::get('/verify-account/{code}', 'RegistrationController@verifyEmail')->name('email.verify');

Route::group(['prefix' => 'exams', 'middleware' => ['auth', 'admin-only']], function(){
    Route::group(['prefix' => 'reading'], function(){
        Route::group(['prefix' => 'manage'], function(){
            Route::get('storyboard', 'ReadingExamController@editStoryboard')->name('reading.storyboard.edit');
            Route::post('storyboard', 'ReadingExamController@saveStoryboard')->name('reading.storyboard.save');
            Route::get('questions', 'ReadingExamController@addQuestion')->name('reading.questions.create');
            Route::post('questions', 'ReadingExamController@storeQuestion')->name('reading.questions.store');
            Route::get('questions/{id}', 'ReadingExamController@editQuestion')->name('reading.questions.edit');
            Route::post('questions/{id}', 'ReadingExamController@updateQuestion')->name('reading.questions.update');
            Route::delete('questions', 'ReadingExamController@deleteQuestion')->name('reading.questions.delete');
        });
    });

    Route::group(['prefix' => 'written'], function(){
        Route::group(['prefix' => 'manage'], function(){
            Route::get('questions', 'WrittenExamController@createQuestion')->name('written.questions.create');
            Route::post('questions', 'WrittenExamController@storeQuestion')->name('written.questions.store');
            Route::get('questions/{id}', 'WrittenExamController@editQuestion')->name('written.questions.edit');
            Route::delete('questions', 'WrittenExamController@deleteQuestion')->name('written.questions.delete');
            Route::post('questions/{id}', 'WrittenExamController@updateQuestion')->name('written.questions.update');
        });
    });
});

Route::group(['prefix' => 'written-exam', 'middleware' => ['auth', 'hr-only']], function(){
    Route::get('list', 'ProfileController@checkWrittenExams')->name('written.exam.list');
    Route::get('view/{id}', 'ProfileController@reviewWrittenExam')->name('written.exam.view');
    Route::post('check/{id}', 'ProfileController@checkWrittenExam')->name('written.exam.check');

    // Route::post('check/{id}', 'ProfileController@checkWrittenExam')->name('written.exam.pass');
    // Route::post('check/{id}', 'ProfileController@checkWrittenExam')->name('written.exam.fail');
});

Route::group(['prefix' => 'applicants', 'middleware' => ['auth','hr-only']], function(){
    Route::get('summary', 'ApplicantsController@summary')->name('applicants.summary');
    Route::patch('update/{id}', 'ApplicantsController@update')->name('applicants.update');
});

Route::group(['prefix' => 'hired', 'middleware' => ['auth','hr-only']], function(){
    Route::get('summary', 'HiredController@summary')->name('hired.summary');
    Route::post('update', 'HiredController@update')->name('hired.update');
});

Route::get('/profile', 'ProfileController@showProfile')->middleware('auth')->name('profile');
Route::get('/profile/{id}', 'ProfileController@view')->name('profile.view');

Route::get('/about-us', 'AboutUsController@index')->name('about-us');
Route::get('/help', 'HelpController@index')->name('help');

Route::get('/report', 'ReportController@show')->middleware('admin-only')->name('report.show');
// Route::get('/needed-teachers', 'NeededTeachersController@show')->middleware('hr-only')->name('needed.teachers');
// Route::post('/needed-teachers', 'NeededTeachersController@save')->middleware('admin-only')->name('needed.teachers.save');
// Route::patch('/needed-teachers', 'NeededTeachersController@fulfill')->middleware('hr-only')->name('needed.teachers.fulfill');


Route::get('needed-teachers/view', 'AdminNeededTeachersController@view')->name('needed-teachers.view');
Route::resource('needed-teachers', 'AdminNeededTeachersController');
Route::resource('fulfill-teachers', 'HRNeededTeacherFulfillmentsController');


Route::get('/fetch-cities', 'RegistrationController@fetch_cities');
