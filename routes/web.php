<?php

use App\Announcement;



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
    if(Auth::check()) {
        return redirect('/home');
    } else {
        $announcement = Announcement::find(1);
        return view('welcome')->with('announcement', $announcement);
    }

});


/* 
|--------------------------------------------------------------------------
|Example
*/

Route::get('/coach', 'CoachesController@index');
Route::get('/coach/{id}/{name}', 'CoachesController@student');

Route::get('/class', 'ClassesController@index');

Route::get('/home', 'HomeController@index')->name('home');

/* 
|--------------------------------------------------------------------------
|Setup screen
*/

Route::get('/user', 'UserController@index')->name('user');
Route::post('/user', 'UserController@filter')->name('user');
Route::get('/user/{user}', 'UserController@show')->name('user');
Route::get('/user/{user}/edit', 'UserController@edit')->name('user');
Route::put('/user/{user}/edit', 'UserController@update')->name('user');

Route::resource('Announcement', 'AnnouncementsController')->only([
    'edit', 'update'
])->middleware('permission:edit announcement');


/* 
|--------------------------------------------------------------------------
|Authentication
|No longer using Auth::routes(); for better understanding of the framework
*/

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

// Change Password Routes..
Route::get('password/change','Auth\ChangePasswordController@showChangePasswordForm')->name('password.change');
Route::post('password/change','Auth\ChangePasswordController@changePassword')->name('password.change');