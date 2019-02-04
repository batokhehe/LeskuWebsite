<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
	//Schedule
	public function schedule($teacher_id = null){
		$query = $this->select('study_start_at')
					->from('study_class_details')
					->where('teacher_id', $teacher_id)
					->get();

		return $query;

	}
}
