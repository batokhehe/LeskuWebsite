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
	    Route::post('login', 'StudentAPI\AuthController@login');
	    Route::post('register', 'StudentAPI\AuthController@register');

        Route::post('teacher/login', 'TeacherAPI\AuthController@login');
	  
	    Route::group([
	      'middleware' => 'auth:api'
	    ], function() {
	        Route::get('logout', 'StudentAPI\AuthController@logout');
	        Route::get('user', 'StudentAPI\AuthController@user');
	    });
	}
);

//Study Level
Route::get('study_levels', 'StudentAPI\StudyLevelController@all');

//HOME
Route::group([
      'middleware' => 'auth:api'
    ], function() {
    	//Product
        Route::get('products', 'StudentAPI\ProductController@all');

        //Subject
        Route::get('subjects', 'StudentAPI\SubjectController@all');

        //Order
        Route::get('order/teachers', 'StudentAPI\TeacherController@all');
        Route::post('order/teacher_blank_schedules', 'StudentAPI\TeacherController@blank_schedules');
        Route::post('order/add', 'StudentAPI\StudyClassController@store');
        Route::get('order/unpaid', 'StudentAPI\StudyClassController@unpaid');
        Route::post('order/detail', 'StudentAPI\StudyClassController@detail');
        Route::post('order/upload_trf_file', 'StudentAPI\StudyClassController@upload');
    }
);


//UTILS
Route::post('encode', 'StudentAPI\ProductController@base64encoder');
Route::post('decode', 'StudentAPI\ProductController@base64decoder');
