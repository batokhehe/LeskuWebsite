<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Teacher; 
use Illuminate\Support\Facades\Auth; 
use Validator;
use DateTime;
use DateTimeZone;

class TeacherController extends Controller
{
    public $successStatus = 200;
    public $failedStatus = 401;

    public function __construct()
    {
        $this->teacher_mdl =  new Teacher();
    }

	/** 
    * product api 
    * 
    * @return \Illuminate\Http\Response 
    */ 
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

        $result = $this->teacher_mdl->all();

        return response()->json(
            	$result
            , 
            $this->successStatus
        ); 
    }

    public function blank_schedules(Request $request){
        if(!$request->user() || !$request->teacher_id)
            return response()->json(
                [
                    'status' => $this->failedStatus,
                    'response' => 'Unauthorized'
                ], 
                $this->failedStatus
            ); 

        $result = $this->teacher_mdl->schedule($request->teacher_id);
        $schedule = array();
        $blank_schedule = array();

        $now__ = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        $now_ = date('Y-m-d', $now__);
        $now = new DateTime($now_, new DateTimeZone('Asia/Jakarta'));

        //get one week later
        $oneweek__ = mktime(0, 0, 0, date('m'), date('d') + 7, date('Y'));
        $oneweek_ = date('Y-m-d', $oneweek__);
        $oneweek = new DateTime($oneweek_, new DateTimeZone('Asia/Jakarta'));

        foreach ($result as $res) {
            $schedule[] = date('Y-m-d H:i', strtotime($res->study_start_at));
        }

        do {
            $is_weekend = $this->is_weekend($now->format('Y-m-d'));
            if(!$is_weekend){
                for ($i=8;$i<17;$i++) { 
                    if($i < 10){
                        $time = '0' . $i . ':00';
                    }else {
                        $time = $i . ':00';
                    }
                    $temp = $now->format('Y-m-d') . ' ' . $time;
                    if(in_array($temp, $schedule)){
                        // echo $temp . '<br>';
                    } else {
                        $blank_schedule[] = $temp;
                    }
                }
            }
            $now->modify('+1 day');
        } while ($now <= $oneweek);
        $blank_schedule = array('schedule' => $blank_schedule);
        return response()->json(
                $blank_schedule
            , 
            $this->successStatus
        ); 
    }

    public function is_weekend($date){
        return (date('N', strtotime($date)) >= 6);
    }
    
}
