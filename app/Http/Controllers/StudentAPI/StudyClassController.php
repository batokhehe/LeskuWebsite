<?php

namespace App\Http\Controllers\StudentAPI;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product; 
use App\StudyClass; 
use App\StudyClassDetail; 
use App\TeacherSchedule; 
use App\Notifications\NotificationHelper; 
use Illuminate\Support\Facades\Auth; 
use Validator;
use Illuminate\Support\Str;
use DateTime;
use DateTimeZone;
use Carbon\Carbon;

class StudyClassController extends Controller
{
    public $successStatus = 200;
    public $failedStatus = 401;

    public function __construct()
    {
        $this->product_mdl =  new Product();
        $this->study_class_mdl =  new StudyClass();
        $this->study_class_detail_mdl =  new StudyClassDetail();
        $this->teacher_schedule_mdl =  new TeacherSchedule();
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
            $explode = explode(', ', $value['selectedSchedule']);
            $new_date = date('Y-m-d H:i', strtotime($explode[1]));
            
            $details = array(
                'study_class_id' => $study_class_id,
                'subject_id' => $value['subject'],
                'teacher_id' => $value['teacherId'],
                'study_start_at' => $new_date,
                'unique_code' => $unique_code,
                'status' => '0',
            );
            $study_class_detail_result = $this->study_class_detail_mdl->create($details);

            $teacher_schedule_data = array(
                                    'status' => '1',
                                    'study_class_detail_id' => $study_class_detail_result->id,
                                );
            $this->teacher_schedule_mdl
                    ->where('teacher_id', $value['teacherId'])
                    ->where('schedule_date', $new_date)
                    ->update($teacher_schedule_data);
        }   

        $product = $this->product_mdl->where('id', $product_id)->first();

        $created_at = date('Y-m-d H:i', strtotime($study_class->created_at));
        $return = array(
                'price' => $product->price,
                'ordered_assembly' => $ordered_assembly,
                'ordered_subject' => count($ordered_subject),
                'created_at' => $created_at,
            );

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

        foreach ($result as $key => $value) {
            $result[$key]['teacher_age'] = date_diff(date_create($value->date_of_birth), date_create('now'))->y;
            $date = date('D, d-M-Y H:i', strtotime($value->study_start_at));
            $explode = explode(',', $date);
            $month = $this->indonesian_day($explode[0]);
            $new_date = $month . ', ' . $explode[1];
            $result[$key]['study_start_at'] = $new_date;
        }

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

        // foreach ($result as $key => $value) {
        //     $created_at = $value['created_at']->toDateTimeString();
        //     $date = date('D, d-M-Y H:i', strtotime($created_at));
        //     // $date = date('D, d-M-Y H:i', strtotime($value['created_at']->format('jS F Y h:i:s A')));
        //     // $explode = explode(',', $date);
        //     // $month = $this->indonesian_day($explode[0]);
        //     // $new_date = $month . ', ' . $explode[1];
        //     $result[$key]['created_at'] = $date;
        // }

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

    public function indonesian_day($month){
        $bulan = array(
                    'Sun' => 'Minggu',
                    'Mon' => 'Senin',
                    'Tue' => 'Selasa',
                    'Wed' => 'Rabu',
                    'Thu' => 'Kamis',
                    'Fri' => 'Jumat',
                    'Sat' => 'Sabtu',
                );
        return $bulan[$month];
    }
}
