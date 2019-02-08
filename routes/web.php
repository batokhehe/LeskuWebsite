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
    return view('welcome');
});

// Email related routes
Route::get('mail/send', 'MailController@send');
Route::get('auth/verification', 'Auth\RegisterController@email_verification');

//admin
Route::get('/admin', function () {
    return view('layouts.admin.pages.home.index');
});
