<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeacherSchedule extends Model
{
    protected $fillable = [
      'teacher_id', 'schedule_date', 'status', 'study_class_detail_id',
	  ];
	  /**
	   * The attributes that should be hidden for arrays.
	   *
	   * @var array
	   */
	  protected $hidden = [
	  ];

	  public function find_detail_reschedule($teacher_id = NULL)
	  {
	    $query = TeacherSchedule::where('teacher_id', $teacher_id)
	              ->where('status', '0')
	              ->get();
	    return $query;
	  }
}
