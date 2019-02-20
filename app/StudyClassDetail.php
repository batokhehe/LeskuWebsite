<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StudyClassDetail extends Model
{
    protected $table = 'study_class_details';
	protected $table2 = 'subjects';
	protected $table3 = 'teachers';
    protected $table4 = 'study_classes';
    protected $table5 = 'students';

    protected $fillable = [
        'study_class_id', 'subject_id', 'teacher_id', 'study_start_at', 'unique_code', 'status',
    ];

    protected $hidden = [
        
    ];

    public function detail($study_class_id = null){
    	$query = $this->select(
    				$this->table . '.id', 
    				$this->table . '.study_class_id', 
    				$this->table . '.subject_id',
    				$this->table2 . '.name as subject_name',
    				$this->table . '.teacher_id',
    				$this->table3 . '.name as teacher_name',
    				$this->table3 . '.image as teacher_image',
                    $this->table3 . '.date_of_birth',
                    $this->table3 . '.graduated',
                    $this->table3 . '.major',
                    $this->table3 . '.address',
    				$this->table . '.study_start_at',
                    $this->table . '.status'
    			)
    			->join($this->table2, $this->table2 . '.id', '=', $this->table . '.subject_id')
    			->join($this->table3, $this->table3 . '.id', '=', $this->table . '.teacher_id')
                ->where($this->table . '.study_class_id', $study_class_id)
                ->get();

                return $query;
    }

    public function accepted_order($study_class_id = null){
        $query = $this->select(DB::raw('count(*) as accepted'))
                ->where($this->table . '.study_class_id', $study_class_id)
                ->where($this->table . '.status', '1')
                ->first();

                return $query;
    }

    public function student_upcoming($user_id = null){
        $query = $this->select(
                    $this->table . '.id', 
                    $this->table . '.study_class_id', 
                    $this->table . '.subject_id',
                    $this->table2 . '.name as subject_name',
                    $this->table3 . '.name as teacher_name',
                    $this->table3 . '.address as teacher_address',
                    $this->table3 . '.image as teacher_image',
                    $this->table . '.study_start_at'
                )
                ->join($this->table2, $this->table2 . '.id', '=', $this->table . '.subject_id')
                ->join($this->table3, $this->table3 . '.id', '=', $this->table . '.teacher_id')
                ->join($this->table4, $this->table4 . '.id', '=', $this->table . '.study_class_id')
                ->join($this->table5, $this->table5 . '.user_id', '=', $this->table4 . '.user_id')
                ->where($this->table5 . '.user_id', $user_id)
                ->where($this->table . '.student_status', '0')
                ->where($this->table4 . '.status', '3')
                ->get();

                return $query;
    }

    public function teacher_waiting($user_id = null){
        $query = $this->select(
                    $this->table . '.id', 
                    $this->table . '.study_class_id', 
                    $this->table . '.subject_id',
                    $this->table2 . '.name as subject_name',
                    $this->table5 . '.name as student_name',
                    $this->table5 . '.address as student_address',
                    $this->table5 . '.image as student_image',
                    $this->table . '.study_start_at'
                )
                ->join($this->table2, $this->table2 . '.id', '=', $this->table . '.subject_id')
                ->join($this->table3, $this->table3 . '.id', '=', $this->table . '.teacher_id')
                ->join($this->table4, $this->table4 . '.id', '=', $this->table . '.study_class_id')
                ->join($this->table5, $this->table5 . '.user_id', '=', $this->table4 . '.user_id')
                ->where($this->table3 . '.user_id', $user_id)
                ->where($this->table . '.status', '0')
                ->where($this->table4 . '.status', '2')
                ->get();

                return $query;
    }

    public function teacher_upcoming($user_id = null){
        $query = $this->select(
                    $this->table . '.id', 
                    $this->table . '.study_class_id', 
                    $this->table . '.subject_id',
                    $this->table2 . '.name as subject_name',
                    $this->table5 . '.name as student_name',
                    $this->table5 . '.address as student_address',
                    $this->table5 . '.image as student_image',
                    $this->table . '.study_start_at'
                )
                ->join($this->table2, $this->table2 . '.id', '=', $this->table . '.subject_id')
                ->join($this->table3, $this->table3 . '.id', '=', $this->table . '.teacher_id')
                ->join($this->table4, $this->table4 . '.id', '=', $this->table . '.study_class_id')
                ->join($this->table5, $this->table5 . '.user_id', '=', $this->table4 . '.user_id')
                ->where($this->table3 . '.user_id', $user_id)
                ->where($this->table . '.status', '3')
                ->where($this->table4 . '.status', '3')
                ->get();

                return $query;
    }

    public function find_data_for_email($study_class_id = null, $user_id = null){
        $query = $this->select(
                    $this->table . '.id', 
                    $this->table . '.study_class_id', 
                    $this->table . '.subject_id',
                    $this->table2 . '.name as subject_name',
                    $this->table3 . '.name as teacher_name',
                    $this->table . '.study_start_at',
                    $this->table . '.unique_code'
                )
                ->join($this->table2, $this->table2 . '.id', '=', $this->table . '.subject_id')
                ->join($this->table3, $this->table3 . '.id', '=', $this->table . '.teacher_id')
                ->join($this->table4, $this->table4 . '.id', '=', $this->table . '.study_class_id')
                ->where($this->table . '.study_class_id', $study_class_id)
                ->where($this->table4 . '.user_id', $user_id)
                ->where($this->table4 . '.status', '3')
                ->get();

                return $query;
    }
}
