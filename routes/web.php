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

// Website
Route::get('/', function () {
    return view('layouts.web.pages.home.index');
});

Route::get('/about', function () {
    return view('layouts.web.pages.about.index');
});

Route::get('/product', function () {
    return view('layouts.web.pages.product.index');
});

Route::get('/help', function () {
    return view('layouts.web.pages.help.index');
});

Route::get('/contact', function () {
    return view('layouts.web.pages.contact.index');
});

// Profile
Route::get('/profile', 'TeacherController@index');
Route::get('/profile/edit', 'TeacherController@edit');
Route::post('/profile/update', 'TeacherController@update');
Route::post('/profile/store', 'TeacherController@store')->name('teacher.store');


// Email related routes
Route::get('mail/send', 'MailController@send');
// Route::get('auth/verification', 'Auth\RegisterController@email_verification');



Auth::routes();

// Admin
Route::prefix('admin')->group(function() {
  Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
  Route::post('/login', 'Auth\AdminLoginController@Login')->name('admin.login.submit');
  Route::get('/', 'AdminController@index')->name('admin.dashboard');
});

// Route::get('/home', 'HomeController@index')->name('home');
