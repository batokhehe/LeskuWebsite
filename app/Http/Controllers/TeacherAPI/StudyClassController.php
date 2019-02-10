<?php

namespace App\Http\Controllers\TeacherAPI;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\StudyClass;
use App\StudyClassDetail;
use App\Notifications\NotificationHelper;

class StudyClassController extends Controller
{
	public $successStatus = 200;
	public $failedStatus = 401;

	public function __construct()
    {
        $this->study_class_mdl =  new StudyClass();
        $this->study_class_detail_mdl =  new StudyClassDetail();
        $this->notification_helper = new NotificationHelper();
    }

    public function waiting(Request $request){
        if(!$request->user())
            return response()->json(
                [
                    'status' => $this->failedStatus,
                    'response' => 'Unauthorized'
                ], 
                $this->failedStatus
            ); 

        $user_id = $request->user()->id;

        $result = $this->study_class_detail_mdl->teacher_waiting($user_id);

        return response()->json(
                    $result, 
                $this->successStatus
            ); 
    }
}
