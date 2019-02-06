<?php

namespace App\Http\Controllers\TeacherAPI;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User; 
use App\Teacher; 
use App\Mail\LeskuEmailer;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Mail;
use Validator;

class AuthController extends Controller
{
    public $successStatus = 200;
    public $failedStatus = 401;

    public function login(Request $request){ 

        $validator = Validator::make($request->all(), [ 
            'email' => 'required|string|email', 
            'password' => 'required', 
            'app_firebase_id' => 'required', 
        ]);

        if ($validator->fails())
            return response()->json(
                [
                    'status' => $this->failedStatus,
                    'response'=> $validator->errors()
                ], 
                $this->failedStatus
            );

        if(Auth::attempt(['email' => request('email'), 'password' => request('password'), 'type' => 1])){ 
            $user = Auth::user();

            if($user->email_verified_at != null){
            	$success['first_name'] = $user->first_name;
	            $success['last_name'] = $user->last_name;
	            $success['email'] = $user->email;
	            $success['token'] =  $user->createToken('LeskuApp')->accessToken; 
	            $success['app_img'] = $user->app_img;

	            $user_mdl = new User;

	            $data = array(
	                        'app_firebase_id' => request('app_firebase_id'), 
	                        'app_token' => $success['token'],
	                    );

	            $user_mdl->where('id', $user->id)->update($data);
	           
	            return response()->json(
	                [
	                    'status' => $this->successStatus,
	                    'response' => $success
	                ], 
	                $this->successStatus
	            ); 
            } else {
            	return response()->json(
	                [
	                    'status' => $this->failedStatus,
	                    'response' => 'Unauthorized'
	                ], 
	                $this->failedStatus
	            ); 
            }
        } else { 
            return response()->json(
                [
                    'status' => $this->failedStatus,
                    'response' => 'Unauthorized'
                ], 
                $this->failedStatus
            ); 
        } 
    }
}
