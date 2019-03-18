<?php

use App\Announcement;

Auth::routes();

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
    $announcement = Announcement::find(1);
    return view('welcome')->with('announcement', $announcement);
});


/* 
|--------------------------------------------------------------------------
|Example
*/

Route::get('/dashboard', function () {
    return 'User logged in';
});

Route::get('/coach', 'CoachesController@index');
Route::get('/coach/{id}/{name}', 'CoachesController@student');

Route::get('/class', 'ClassesController@index');

Route::get('/home', 'HomeController@index')->name('home');

//route to setup landing page announcement
Route::resource('Announcement', 'AnnouncementsController')->only([
    'edit', 'update'
]);;

//return view('coach.main');
