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
}
