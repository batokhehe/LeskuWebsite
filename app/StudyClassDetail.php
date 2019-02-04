<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudyClassDetail extends Model
{
    protected $table = 'study_class_details';
	protected $table2 = 'subjects';
	protected $table3 = 'teachers';

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
    				$this->table . '.study_start_at'
    			)
    			->join($this->table2, $this->table2 . '.id', '=', $this->table . '.subject_id')
    			->join($this->table3, $this->table3 . '.id', '=', $this->table . '.teacher_id')
                ->where($this->table . '.study_class_id', $study_class_id)
                ->get();

                return $query;
    }
}
