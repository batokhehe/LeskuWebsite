<?php

namespace App\Http\Controllers\StudentAPI;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product; 
use App\StudyClass; 
use App\StudyClassDetail; 
use App\Notifications\NotificationHelper; 
use Illuminate\Support\Facades\Auth; 
use Validator;
use Illuminate\Support\Str;

class StudyClassController extends Controller
{
    public $successStatus = 200;
    public $failedStatus = 401;

    public function __construct()
    {
        $this->product_mdl =  new Product();
        $this->study_class_mdl =  new StudyClass();
        $this->study_class_detail_mdl =  new StudyClassDetail();
        $this->notification_helper = new NotificationHelper();
    }

	/** 
    * product api 
    * 
    * @return \Illuminate\Http\Response 
    */ 
    public function store(Request $request) 
    { 
        if(!$request->user() || !$request)
            return response()->json(
                [
                    'status' => $this->failedStatus,
                    'response' => 'Unauthorized'
                ], 
                $this->failedStatus
            ); 

        $user_id = $request->user()->id;
        $request_body = $request->json()->all();
        $product_id = $request_body['productId'];
        $json = $request_body['orderedClass'];
        $subject = array();

        foreach ($json as $key => $value) {
            array_push($subject, $value['subject']);
        }

        $ordered_assembly = count($subject);
        $ordered_subject = array_count_values($subject);

        $data = array(
                'user_id' => $user_id,
                'product_id' => $product_id,
                'ordered_assembly' => $ordered_assembly,
                'ordered_subject' => count($ordered_subject),
                'status' => '0',
            );

        $study_class = $this->study_class_mdl->create($data);

        $study_class_id = $study_class->id;

        foreach ($json as $key => $value) {
            $unique_code = str_random(6);

            // $var = str_replace('/', '-', $value['date']);
            // $date = date('Y-m-d H:i:s', strtotime($var));
            
            $details[] = array(
                'study_class_id' => $study_class_id,
                'subject_id' => $value['subject'],
                'teacher_id' => $value['teacherId'],
                'study_start_at' => $value['selectedSchedule'] ? $value['selectedSchedule'] : null,
                'unique_code' => $unique_code,
                'status' => '0',
            );
        }   

        $product = $this->product_mdl->where('id', $product_id)->first();

        $created_at = date('Y-m-d H:i', strtotime($study_class->created_at));
        $return = array(
                'price' => $product->price,
                'ordered_assembly' => $ordered_assembly,
                'ordered_subject' => count($ordered_subject),
                'created_at' => $created_at,
            );

        $this->study_class_detail_mdl->insert($details);

        return response()->json(
                $return, 
                $this->successStatus
            ); 
    }

    public function detail(Request $request){
        if(!$request->user() || !$request->study_class_id)
            return response()->json(
                [
                    'status' => $this->failedStatus,
                    'response' => 'Unauthorized'
                ], 
                $this->failedStatus
            ); 

        $study_class_id = $request->study_class_id;

        $result = $this->study_class_detail_mdl->detail($study_class_id);

        return response()->json(
                    $result, 
                $this->successStatus
            ); 
    }

    public function unpaid(Request $request){
        if(!$request->user())
            return response()->json(
                [
                    'status' => $this->failedStatus,
                    'response' => 'Unauthorized'
                ], 
                $this->failedStatus
            ); 

        $user_id = $request->user()->id;

        $result = $this->study_class_mdl->unpaid($user_id);

        return response()->json(
                    $result, 
                $this->successStatus
            ); 
    }

    public function upload(Request $request){
        if(!$request->user() || !$request)
            return response()->json(
                [
                    'status' => $this->failedStatus,
                    'response' => 'Unauthorized'
                ], 
                $this->failedStatus
            ); 

        $study_class_details_id = $request->id;
        $trf_file = $request->trf_file;

        $data = array(
                        'trf_file' => $trf_file,
                        'status' => '1'
                    );

        $this->study_class_mdl->where('id', $study_class_details_id)->update($data);

        return response()->json(
                [
                    'status' => $this->successStatus,
                    'response' => 'Data Uploaded'
                ],  
                $this->successStatus
            ); 
    }

    //PROCESS

    public function dummy_push_notif_to_teacher()
    {
        $firebase_id = "cpOBvjRxjRY:APA91bETiMDRSN3zZADGqep0WHKsD9dRY6evGjX-z6m8f3hI8XlcUgy1kXnQXYI6XEIbEZSzObfQiMtGpAmWe054hSd5JZZ5TU2rCdh7YIibxouiInywOaLkBGnZKz9YkuYl73EGza5s";
        $message = "Percobaan dari laravel";
        $type = "1";

        $result = $this->notification_helper->send_to_specific_user($firebase_id, $message, $type);

        return $result;
    }
}
