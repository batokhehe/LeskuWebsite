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

// Admin-Product
Route::get('/product', 'ProductController@index');
Route::get('/product/create', function () {
    return view('layouts.admin.pages.product.create');
});
Route::post('/product/store', 'ProductController@store')->name('product.store');
Route::get('/product/edit/{id}', 'ProductController@edit');
Route::post('/product/update/{id}', 'ProductController@update');
Route::get('/product/delete/{id}', 'ProductController@delete');

// Admin-user
Route::get('/user', 'UserController@index');
Route::get('/user/create', function () {
    return view('layouts.admin.pages.user.create');
});
Route::post('/user/store', 'UserController@store')->name('user.store');
Route::get('/user/edit/{id}', 'UserController@edit');
Route::post('/user/update/{id}', 'UserController@update');
Route::get('/user/delete/{id}', 'UserController@delete');

// Admin-transaction
Route::get('/payment_verification', 'Study_ClassController@index');
Route::get('/user/create', function () {
    return view('layouts.admin.pages.user.create');
});
Route::post('/user/store', 'UserController@store')->name('user.store');
Route::get('/payment_verification/edit/{id}', 'Study_ClassController@edit');
Route::post('/user/update/{id}', 'UserController@update');
Route::get('/user/delete/{id}', 'UserController@delete');

// Route::get('/home', 'HomeController@index')->name('home');
