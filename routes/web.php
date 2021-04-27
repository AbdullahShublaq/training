<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/authtest', function () {

    dd(auth()->guard('jobSeeker')->check());
});

Route::group(['prefix' => 'jobSeeker'], function () {
    Route::get('/login', 'Auth\JobSeekerLoginController@login_form')->name('jobSeeker.login_form');
    Route::post('/submit-login', 'Auth\JobSeekerLoginController@login')->name('jobSeeker.login');
    Route::get('/register', 'Auth\JobSeekerLoginController@register_form')->name('jobSeeker.register_form');
    Route::post('/submit_register', 'Auth\JobSeekerLoginController@register_post')->name('jobSeeker.register');

    Route::get('logout', 'Auth\JobSeekerLoginController@logout_jobSeeker')->name('jobSeeker.logout');

    Route::group(['prefix' => 'profile', 'namespace' => 'FrontController'], function () {
        Route::get('/', 'JobSeekerProfileController@index')->name('jobSeeker.profile.index');
        Route::get('/edit', 'JobSeekerProfileController@edit')->name('jobSeeker.profile.edit');
        Route::post('/update/{jobseeker}', 'JobSeekerProfileController@update')->name('jobSeeker.profile.update');

        Route::group(['prefix' => 'education'], function () {
            Route::get('/create', 'JobSeekerEductaionController@create')->name('jobSeeker.profile.education.create');
            Route::post('/store', 'JobSeekerEductaionController@store')->name('jobSeeker.profile.education.store');
            Route::get('/edit/{id}', 'JobSeekerEductaionController@edit')->name('jobSeeker.profile.education.edit');
            Route::post('/update/{id}', 'JobSeekerEductaionController@update')->name('jobSeeker.profile.education.update');
            Route::get('/destroy/{id}', 'JobSeekerEductaionController@destroy')->name('jobSeeker.profile.education.destroy');
        });

        Route::group(['prefix' => 'experience'], function () {
            Route::get('/create', 'JobSeekerExperienceController@create')->name('jobSeeker.profile.experience.create');
            Route::post('/store', 'JobSeekerExperienceController@store')->name('jobSeeker.profile.experience.store');
            Route::get('/edit/{id}', 'JobSeekerExperienceController@edit')->name('jobSeeker.profile.experience.edit');
            Route::post('/update/{id}', 'JobSeekerExperienceController@update')->name('jobSeeker.profile.experience.update');
            Route::get('/destroy/{id}', 'JobSeekerExperienceController@destroy')->name('jobSeeker.profile.experience.destroy');
        });

        Route::group(['prefix' => 'training'], function () {
            Route::get('/create', 'JobSeekerTrainingController@create')->name('jobSeeker.profile.training.create');
            Route::post('/store', 'JobSeekerTrainingController@store')->name('jobSeeker.profile.training.store');
            Route::get('/edit/{id}', 'JobSeekerTrainingController@edit')->name('jobSeeker.profile.training.edit');
            Route::post('/update/{id}', 'JobSeekerTrainingController@update')->name('jobSeeker.profile.training.update');
            Route::get('/destroy/{id}', 'JobSeekerTrainingController@destroy')->name('jobSeeker.profile.training.destroy');
        });

    });
});

Route::group(['prefix' => 'employer'], function () {

    Route::get('/login', 'Auth\EmployerLoginController@login_form')->name('employer.login_form');
    Route::post('/submit-login', 'Auth\EmployerLoginController@login')->name('employer.login');
    Route::get('/register', 'Auth\EmployerLoginController@register_form')->name('employer.register_form');
    Route::post('/submit_register', 'Auth\EmployerLoginController@register_post')->name('employer.register');
    Route::get('/logout', 'Auth\EmployerLoginController@logout_employer')->name('employer.logout');


//employer stuff
    Route::group(['prefix' => 'jobs', 'namespace' => 'FrontController'], function () {

        Route::get('/', 'JobController@index')->name('job.index');
        Route::get('/create', 'JobController@create')->name('job.create');
        Route::post('/store/{employer}', 'JobController@store')->name('job.store');
        Route::get('/edit/{job}', 'JobController@edit')->name('job.edit');
        Route::post('/update/{job}', 'JobController@update')->name('job.update');
        Route::get('/destroy/{job}', 'JobController@destroy')->name('job.destroy');
    });
    Route::group(['prefix' => 'training', 'namespace' => 'FrontController'], function () {
        Route::get('/', 'TrainingController@index')->name('training.index');
        Route::get('/create', 'TrainingController@create')->name('training.create');
        Route::post('/store/{employer}', 'TrainingController@store')->name('training.store');
        Route::get('/edit/{training}', 'TrainingController@edit')->name('training.edit');
        Route::post('/update/{training}', 'TrainingController@update')->name('training.update');
        Route::get('/destroy/{training}', 'TrainingController@destroy')->name('training.destroy');

    });

    Route::group(['prefix' => 'profile', 'namespace' => 'FrontController'], function () {
        Route::get('/', 'EmployerProfileController@index')->name('employer.profile.index');
        Route::get('/edit', 'EmployerProfileController@edit')->name('employer.profile.edit');
        Route::post('/update/{employer}', 'EmployerProfileController@update')->name('employer.profile.update');
    });
});

Route::group(['namespace' => 'FrontController'], function () {

    Route::get('/', 'HomeController@jobs')->name('jobs');
    Route::get('/employers', 'HomeController@employers')->name('employers');
    Route::get('/trainings', 'HomeController@trains')->name('trains');
    Route::get('/jobSeekers', 'HomeController@jobSeekers')->name('jobSeekers');


    Route::get('/job-seeker/{jobSeeker}', 'JobSeekerController@show')->name('jobseeker.show');
    Route::get('/employer/{employer}', 'EmployerController@show')->name('employer.show');
    Route::get('/job/{job}', 'JobController@show')->name('job.show');
    Route::get('/training/{training}', 'TrainingController@show')->name('training.show');


//attempt to train
    Route::post('/training/{training}', 'TrainingApplicationController@store')->name('training.apply');
    Route::post('/job/{job}/apply', 'JobApplicationController@store')->name('job.apply');

});


