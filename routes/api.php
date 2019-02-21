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
        //STUDENT
	    Route::post('login', 'StudentAPI\AuthController@login');
	    Route::post('register', 'StudentAPI\AuthController@register');

        //TEACHER
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
Route::get('dummy_push_notif', 'StudentAPI\StudyClassController@dummy_push_notif_to_teacher');

//HOME
Route::group([
      'middleware' => 'auth:api'
    ], function() {
        /*---------- STUDENT -----------*/
        //Account
        Route::post('student/update_account', 'StudentAPI\StudentController@update');

    	//Product
        Route::get('products', 'StudentAPI\ProductController@all');

        //Subject
        Route::get('subjects', 'StudentAPI\SubjectController@all');

        //Order
        Route::get('order/teachers', 'StudentAPI\TeacherController@all');
        Route::post('order/teacher_blank_schedules', 'StudentAPI\TeacherController@blank_schedules');
        Route::post('order/add', 'StudentAPI\StudyClassController@store');
        Route::get('order/unpaid', 'StudentAPI\StudyClassController@unpaid');
        Route::get('order/waiting', 'StudentAPI\StudyClassController@waiting');
        Route::get('order/paid', 'StudentAPI\StudyClassController@paid');
        Route::post('order/detail', 'StudentAPI\StudyClassController@detail');
        Route::post('order/upload_trf_file', 'StudentAPI\StudyClassController@upload');

        //Schedule
        Route::get('schedule/upcoming', 'StudentAPI\StudyClassController@upcoming');
        Route::post('schedule/confirm_schedule', 'StudentAPI\StudyClassController@confirm_schedule');
        Route::post('schedule/reschedule', 'StudentAPI\StudyClassController@reschedule');

        //History
        Route::get('history', 'StudentAPI\StudyClassController@history');
        Route::post('history/rating', 'StudentAPI\StudyClassController@rating');
        /*---------- STUDENT -----------*/

        /*---------- TEACHER -----------*/
        Route::get('teacher/order/waiting', 'TeacherAPI\StudyClassController@waiting');
        Route::post('teacher/order/accept_order', 'TeacherAPI\StudyClassController@accept_order');
        Route::post('teacher/order/decline_order', 'TeacherAPI\StudyClassController@decline_order');

        Route::get('teacher/order/upcoming', 'TeacherAPI\StudyClassController@upcoming');
        Route::post('teacher/schedule/confirm_schedule', 'TeacherAPI\StudyClassController@confirm_schedule');
        Route::post('teacher/schedule/reschedule', 'TeacherAPI\StudyClassController@reschedule');

        Route::get('teacher/order/finished', 'TeacherAPI\StudyClassController@finished');

        Route::get('teacher/presence', 'TeacherAPI\StudyClassController@presence');
        Route::post('teacher/presence/confirm', 'TeacherAPI\StudyClassController@confirm_presence');
        /*---------- TEACHER -----------*/
    }
);


//UTILS
Route::post('encode', 'StudentAPI\ProductController@base64encoder');
Route::post('decode', 'StudentAPI\ProductController@base64decoder');
