<?php

namespace App\Http\Controllers\TeacherAPI;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\StudyClass;
use App\StudyClassDetail;
use App\Teacher;
use App\User;
use App\Notifications\NotificationHelper;
use Illuminate\Support\Facades\Mail;
use App\Mail\LeskuEmailer;

class StudyClassController extends Controller
{
	public $successStatus = 200;
	public $failedStatus = 401;

	public function __construct()
    {
        $this->study_class_mdl =  new StudyClass();
        $this->study_class_detail_mdl =  new StudyClassDetail();
        $this->teacher_mdl =  new Teacher();
        $this->user_mdl =  new User();
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

    public function accept_order(Request $request){
        if(!$request->user())
            return response()->json(
                [
                    'status' => $this->failedStatus,
                    'response' => 'Unauthorized'
                ], 
                $this->failedStatus
            ); 

        $user_id = $request->user()->id;
        $id = $request->study_class_detail_id;
        $teacher = $this->teacher_mdl->where('user_id', $user_id)->first();

        $data = array('status' => '1');

        $result = $this->study_class_detail_mdl->where('id', $request->id)->where('teacher_id', $teacher->id)->update($data);

        $study_class_detail = $this->study_class_detail_mdl->where('id', $request->id)->first();
        $study_class_count = $this->study_class_detail_mdl->where('study_class_id', $study_class_detail->study_class_id)->where('status', 0)->count();

        // echo $study_class_count;

        if($study_class_count < 1){
            $study_class_data = array(
                            'status' => '3'
                        );
            $this->study_class_mdl->where('id', $study_class_detail->study_class_id)->update($study_class_data);
            $study_class_data = $this->study_class_mdl->where('id', $study_class_detail->study_class_id)->first();
            $student_user_data = $this->user_mdl->where('id', $study_class_data->user_id)->first();
            $study_class_detail_data = $this->study_class_detail_mdl->find_data_for_email($study_class_detail->study_class_id, $study_class_data->user_id);
            $objEmailer = new \stdClass();
            $objEmailer->name = $student_user_data->first_name . ' ' . $student_user_data->last_name;
            $objEmailer->study_class_details = $study_class_detail_data;
            $objEmailer->sender = 'Admin Lesku';
            $objEmailer->receiver = $student_user_data->first_name . ' ' . $student_user_data->last_name;
     
            Mail::to($request->user()->email)->send(new LeskuEmailer($objEmailer));
        }

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
