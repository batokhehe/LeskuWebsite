<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'prefix' => 'auth'
	], function () {
	    Route::post('login', 'API\AuthController@login');
	    Route::post('register', 'API\AuthController@register');
	  
	    Route::group([
	      'middleware' => 'auth:api'
	    ], function() {
	        Route::get('logout', 'API\AuthController@logout');
	        Route::get('user', 'API\AuthController@user');
	    });
	}
);

//Study Level
Route::get('study_levels', 'API\StudyLevelController@all');

//HOME
Route::group([
      'middleware' => 'auth:api'
    ], function() {
    	//Product
        Route::get('products', 'API\ProductController@all');

        //Subject
        Route::get('subjects', 'API\SubjectController@all');

        //Order
        Route::get('order/teachers', 'API\TeacherController@all');
        Route::post('order/teacher_blank_schedules', 'API\TeacherController@blank_schedules');
        Route::post('order/add', 'API\StudyClassController@store');
        Route::get('order/unpaid', 'API\StudyClassController@unpaid');
        Route::post('order/detail', 'API\StudyClassController@detail');
        Route::post('order/upload_trf_file', 'API\StudyClassController@upload');
    }
);


//UTILS
Route::post('encode', 'API\ProductController@base64encoder');
Route::post('decode', 'API\ProductController@base64decoder');
