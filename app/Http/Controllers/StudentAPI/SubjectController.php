<?php

namespace App\Http\Controllers\StudentAPI;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Subject;

class SubjectController extends Controller
{
	public $successStatus = 200;
    public $failedStatus = 401;

    public function __construct()
    {
        $this->subject_mdl =  new Subject();
    }
    
    public function all(Request $request) 
    { 
        if(!$request->user())
            return response()->json(
                [
                    'status' => $this->failedStatus,
                    'response' => 'Unauthorized'
                ], 
                $this->failedStatus
            ); 
        
        $result = $this->subject_mdl->all();

        return response()->json(
            	$result
            , 
            $this->successStatus
        ); 
    }
}
