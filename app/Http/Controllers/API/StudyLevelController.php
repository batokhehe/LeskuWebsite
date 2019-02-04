<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\StudyLevel; 
use Validator;

class StudyLevelController extends Controller
{
    public $successStatus = 200;
    public $failedStatus = 401;

    public function __construct()
    {
        $this->study_level_mdl =  new StudyLevel();
    }

	/** 
    * product api 
    * 
    * @return \Illuminate\Http\Response 
    */ 
    public function all() 
    { 
        $result = $this->study_level_mdl->all();

        return response()->json(
                $result
            , 
            $this->successStatus
        ); 
    }
}
