<?php

namespace App\Http\Controllers\StudentAPI;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Student;

class StudentController extends Controller
{
	public $successStatus = 200;
    public $failedStatus = 401;

    public function __construct()
    {
        $this->student_mdl =  new Student();
    }

    //UPDATE ACCOUNT
    public function update(Request $request){
    	if(!$request->user())
            return response()->json(
                [
                    'status' => $this->failedStatus,
                    'response' => 'Unauthorized'
                ], 
                $this->failedStatus
            ); 

        $user_id = $request->user()->id;

        $data = array(
        	'name' => $request->name, 
        	'address' => $request->address, 
        	'phone_number' => $request->phone_number, 
        	'email' => $request->email, 
        );

        if($request->encoded_image || $request->encoded_image != ''){
        	$data['image'] = $request->encoded_image;
        }

        $result = $this->student_mdl->where('user_id', $user_id)->update($data);

        if($result){
        	return response()->json(
        		[
	                'status' => $this->successStatus,
                    'response' => 'Data Successfully Updated'
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
    }
}
