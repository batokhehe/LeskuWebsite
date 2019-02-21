<?php

namespace App\Http\Controllers\TeacherAPI;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\StudyClass;
use App\StudyClassDetail;
use App\Teacher;
use App\TeacherSchedule;
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
        $this->teacher_schedule_mdl =  new TeacherSchedule();
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
        $teacher = $this->teacher_mdl->where('user_id', $user_id)->first();

        $data = array('status' => '1');
        $result = $this->study_class_detail_mdl->where('id', $request->id)->where('teacher_id', $teacher->id)->update($data);

        $study_class_detail = $this->study_class_detail_mdl->where('id', $request->id)->first();
        $study_class_count = $this->study_class_detail_mdl->where('study_class_id', $study_class_detail->study_class_id)->where('status', 0)->count();

        $teacher_schedule_data = array('status' => '2', 'study_class_detail_id' => $study_class_detail->id);
        $result_teacher_schedule = $this->teacher_schedule_mdl->where('schedule_date', $study_class_detail->study_start_at)->where('teacher_id', $teacher->id)->update($teacher_schedule_data);

        if($study_class_count < 1){
            $study_class_data = array(
                            'status' => '3'
                        );
            $this->study_class_mdl->where('id', $study_class_detail->study_class_id)->update($study_class_data);
            $this->study_class_detail_mdl->where('study_class_id', $study_class_detail->study_class_id)->update($study_class_data);

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

    public function decline_order(Request $request){
        if(!$request->user())
            return response()->json(
                [
                    'status' => $this->failedStatus,
                    'response' => 'Unauthorized'
                ], 
                $this->failedStatus
            ); 

        $user_id = $request->user()->id;
        $teacher = $this->teacher_mdl->where('user_id', $user_id)->first();

        $data = array('status' => '2');
        $result = $this->study_class_detail_mdl->where('id', $request->id)->where('teacher_id', $teacher->id)->update($data);

        $study_class_detail = $this->study_class_detail_mdl->where('id', $request->id)->first();
        $teacher_schedule_data = array('status' => '2', 'study_class_detail_id' => $study_class_detail->id);
        $result_teacher_schedule = $this->teacher_schedule_mdl->where('schedule_date', $study_class_detail->study_start_at)->where('teacher_id', $teacher->id)->update($teacher_schedule_data);

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

    public function upcoming(Request $request){
        if(!$request->user())
            return response()->json(
                [
                    'status' => $this->failedStatus,
                    'response' => 'Unauthorized'
                ], 
                $this->failedStatus
            ); 

        $user_id = $request->user()->id;

        $result = $this->study_class_detail_mdl->teacher_upcoming($user_id);

        return response()->json(
                    $result, 
                $this->successStatus
            ); 
    }

    public function confirm_schedule(Request $request){
        if(!$request->user())
            return response()->json(
                [
                    'status' => $this->failedStatus,
                    'response' => 'Unauthorized'
                ], 
                $this->failedStatus
            ); 

        $teacher = $this->teacher_mdl->where('user_id', $request->user()->id)->first();

        $data = array('status' => '4');
        $result = $this->study_class_detail_mdl->where('id', $request->id)->where('teacher_id', $teacher->id)->update($data);

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

    public function reschedule(Request $request){
        if(!$request->user())
            return response()->json(
                [
                    'status' => $this->failedStatus,
                    'response' => 'Unauthorized'
                ], 
                $this->failedStatus
            ); 

        $teacher = $this->teacher_mdl->where('user_id', $request->user()->id)->first();

        $data = array('status' => '5');
        $result = $this->study_class_detail_mdl->where('id', $request->id)->where('teacher_id', $teacher->id)->update($data);

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

    public function finished(Request $request){
        if(!$request->user())
            return response()->json(
                [
                    'status' => $this->failedStatus,
                    'response' => 'Unauthorized'
                ], 
                $this->failedStatus
            ); 

        $user_id = $request->user()->id;

        $result = $this->study_class_detail_mdl->teacher_finished($user_id);

        return response()->json(
                    $result, 
                $this->successStatus
            ); 
    }

    public function presence(Request $request){
        if(!$request->user())
            return response()->json(
                [
                    'status' => $this->failedStatus,
                    'response' => 'Unauthorized'
                ], 
                $this->failedStatus
            ); 

        $user_id = $request->user()->id;

        $result = $this->study_class_detail_mdl->teacher_presence($user_id);

        return response()->json(
                    $result, 
                $this->successStatus
            ); 
    }

    public function confirm_presence(Request $request){
        if(!$request->user())
            return response()->json(
                [
                    'status' => $this->failedStatus,
                    'response' => 'Unauthorized'
                ], 
                $this->failedStatus
            ); 

        $teacher = $this->teacher_mdl->where('user_id', $request->user()->id)->first();

        $data = array(
            'status' => '9',
            'study_end_at' => now(),
        );
        $result = $this->study_class_detail_mdl
                    ->where('id', $request->id)
                    ->where('teacher_id', $teacher->id)
                    ->whereRaw("BINARY `unique_code`= ?", [$request->unique_code])->update($data);

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
