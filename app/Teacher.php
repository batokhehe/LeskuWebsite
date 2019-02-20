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

	protected $fillable = [
      'name', 'address', 'email', 'phone_number', 'graduated', 'cv_file', 'certificate', 'id_card', 'user_id', 'image'
  ];
  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
      'remember_token',
  ];

  public function getAll()
  {
    $teacher = Teacher::whereNull('deleted_at')->get();
    return $teacher;
  }

  public function findData($id = NULL)
  {
    $teacher = Teacher::where('user_id', $id)->first();
    return $teacher;
  }

  public function updateData($data = array(), $id = NULL)
  {
    $teacher = Teacher::where('user_id', $id)->update($data);
    return $teacher;
  }

  public function softDelete($data = array(), $id = NULL)
  {
    $teacher = Teacher::where('user_id', $id)->update($data);
    return $teacher;
  }

  public function find_detail_change_teacher($schedule_date = NULL)
  {
    $teacher = Teacher::select(
                'teachers.id as teacher_id',
                'teachers.name',
                'teachers.address',
                'teachers.graduated',
                'teachers.major',
                'teachers.date_of_birth',
                'teachers.image',
                'teacher_schedules.id as teacher_schedules_id'
              )
              ->join('teacher_schedules', 'teachers.id', '=', 'teacher_schedules.teacher_id')
              ->where('teacher_schedules.schedule_date', $schedule_date)
              ->where('teacher_schedules.status', '0')
              ->get();
    return $teacher;
  }

}
