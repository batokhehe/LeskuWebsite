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

}
