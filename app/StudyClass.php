<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudyClass extends Model
{
	protected $fillable = [
        'user_id', 'product_id', 'ordered_assembly', 'ordered_subject', 'status',
    ];

    protected $hidden = [

    ];

    protected $table = 'study_classes';
    protected $table2 = 'products';
	protected $table3 = 'users';
	protected $table4 = 'study_class_details';
	protected $table5 = 'subjects';
	protected $table6 = 'teachers';
    protected $table7 = 'students';

    public function unpaid($user_id = null){
    	$query = $this->select(
    				$this->table . '.id',
    				$this->table . '.product_id',
    				$this->table2 . '.name as product_name',
    				$this->table . '.ordered_assembly',
    				$this->table . '.ordered_subject',
    				// $this->table . '.trf_file',
    				$this->table . '.created_at',
    				$this->table . '.status'
    			)
    			->join($this->table2, $this->table2 . '.id', '=', $this->table . '.product_id')
                ->whereIn($this->table . '.status', [0, 1])
                ->where($this->table . '.user_id', $user_id)
                // ->orderBy($this->table . '.status')
                ->get();

                return $query;
    }

    public function waiting($user_id = null){
    	$query = $this->select(
    				$this->table . '.id',
    				$this->table . '.product_id',
    				$this->table2 . '.name as product_name',
    				$this->table . '.ordered_assembly',
    				$this->table . '.ordered_subject',
    				$this->table . '.created_at',
    				$this->table . '.status'
    			)
    			->join($this->table2, $this->table2 . '.id', '=', $this->table . '.product_id')
                ->whereIn($this->table . '.status', [2])
                ->where($this->table . '.user_id', $user_id)
                ->get();

                return $query;
    }

    public function paid($user_id = null){
    	$query = $this->select(
    				$this->table . '.id',
    				$this->table . '.product_id',
    				$this->table2 . '.name as product_name',
    				$this->table . '.ordered_assembly',
    				$this->table . '.ordered_subject',
    				$this->table . '.created_at',
    				$this->table . '.status'
    			)
    			->join($this->table2, $this->table2 . '.id', '=', $this->table . '.product_id')
                ->whereIn($this->table . '.status', [3])
                ->where($this->table . '.user_id', $user_id)
                ->get();

                return $query;
    }

	public function payment_verification()
    {
			$query = $this->select(
						$this->table. '.id',
						$this->table3 . '.username',
						$this->table3 . '.first_name',
						$this->table3 . '.last_name',
						$this->table2 . '.name as product_name',
						$this->table . '.ordered_assembly',
						$this->table . '.ordered_subject',
						$this->table . '.status'
					)
					->join($this->table3, $this->table3 . '.id', '=', $this->table . '.user_id')
					->join($this->table2, $this->table2 . '.id', '=', $this->table . '.product_id')
					->where($this->table . '.status', '1')
								->get();

								return $query;
    }

    public function find($id)
    {
			$query = $this->select(
						$this->table. '.id',
						$this->table3 . '.first_name',
						$this->table3 . '.last_name',
						$this->table2 . '.name as product_name',
						$this->table . '.ordered_assembly',
						$this->table . '.ordered_subject',
						$this->table . '.status',
                        $this->table . '.trf_file'
					)
					->join($this->table3, $this->table3 . '.id', '=', $this->table . '.user_id')
					->join($this->table2, $this->table2 . '.id', '=', $this->table . '.product_id')
					->where($this->table. '.id', $id)
								->first();

								return $query;
    }

	public function find_detail($id)
    {
			$query = $this->select(
						$this->table6. '.name as teacher_name',
						$this->table5 . '.name as subject_name',
						$this->table4 . '.study_start_at'
					)
					->from($this->table4)
					->join($this->table6, $this->table6 . '.id', '=', $this->table4 . '.teacher_id')
					->join($this->table5, $this->table5 . '.id', '=', $this->table4 . '.subject_id')
					->where($this->table4. '.study_class_id', $id)
								->get();

								return $query;
    }

    public function change_teacher()
    {
        $query = $this->select(
                    $this->table6. '.name as teacher_name',
                    $this->table5 . '.name as subject_name',
                    $this->table4 . '.study_start_at',
                    $this->table4 . '.id',
                    $this->table4 . '.study_class_id',
                    $this->table3 . '.first_name',
                    $this->table3 . '.last_name'
                )
                ->from($this->table4)
                ->join($this->table6, $this->table6 . '.id', '=', $this->table4 . '.teacher_id')
                ->join($this->table5, $this->table5 . '.id', '=', $this->table4 . '.subject_id')
                ->join($this->table, $this->table . '.id', '=', $this->table4 . '.study_class_id')
                ->join($this->table3, $this->table3 . '.id', '=', $this->table . '.user_id')
                ->where($this->table4 . '.status', '2')
                            ->get();

                return $query;
    }

    public function find_change_teacher($id = null)
    {
        $query = $this->select(
                    $this->table6. '.name as teacher_name',
                    $this->table5 . '.name as subject_name',
                    $this->table4 . '.study_start_at',
                    $this->table4 . '.id',
                    $this->table4 . '.study_class_id',
                    $this->table3 . '.first_name',
                    $this->table3 . '.last_name'
                )
                ->from($this->table4)
                ->join($this->table6, $this->table6 . '.id', '=', $this->table4 . '.teacher_id')
                ->join($this->table5, $this->table5 . '.id', '=', $this->table4 . '.subject_id')
                ->join($this->table, $this->table . '.id', '=', $this->table4 . '.study_class_id')
                ->join($this->table3, $this->table3 . '.id', '=', $this->table . '.user_id')
                ->where($this->table4 . '.status', '2')
                ->where($this->table4 . '.id', $id)
                            ->first();

                return $query;
    }

    public function reschedule()
    {
        $query = $this->select(
                    $this->table6. '.name as teacher_name',
                    $this->table5 . '.name as subject_name',
                    $this->table4 . '.study_start_at',
                    $this->table4 . '.id',
                    $this->table4 . '.study_class_id',
                    $this->table3 . '.first_name',
                    $this->table3 . '.last_name',
                    $this->table4 . '.status',
                    $this->table4 . '.student_status'
                )
                ->from($this->table4)
                ->join($this->table6, $this->table6 . '.id', '=', $this->table4 . '.teacher_id')
                ->join($this->table5, $this->table5 . '.id', '=', $this->table4 . '.subject_id')
                ->join($this->table, $this->table . '.id', '=', $this->table4 . '.study_class_id')
                ->join($this->table3, $this->table3 . '.id', '=', $this->table . '.user_id')
                ->where($this->table4 . '.status', '5')
                ->orWhere($this->table4 . '.student_status', '5')
                            ->get();

                return $query;
    }

    public function find_reschedule($id = null)
    {
        $query = $this->select(
                    $this->table6. '.name as teacher_name',
                    $this->table6. '.phone_number as teacher_phone',
                    $this->table6 . '.id as teacher_id',
                    $this->table5 . '.name as subject_name',
                    $this->table4 . '.study_start_at',
                    $this->table4 . '.id',
                    $this->table4 . '.study_class_id',
                    $this->table4 . '.status',
                    $this->table4 . '.student_status',
                    $this->table3 . '.first_name',
                    $this->table3 . '.last_name',
                    $this->table7 . '.phone_number as student_phone'
                )
                ->from($this->table4)
                ->join($this->table6, $this->table6 . '.id', '=', $this->table4 . '.teacher_id')
                ->join($this->table5, $this->table5 . '.id', '=', $this->table4 . '.subject_id')
                ->join($this->table, $this->table . '.id', '=', $this->table4 . '.study_class_id')
                ->join($this->table3, $this->table3 . '.id', '=', $this->table . '.user_id')
                ->join($this->table7, $this->table7 . '.user_id', '=', $this->table . '.user_id')
                ->where(function ($query) {
                            $query->where($this->table4 . '.status', '=', '5')
                                  ->orWhere($this->table4 . '.student_status', '=', '5');
                        })
                ->where($this->table4 . '.id', $id)
                            ->first();

                return $query;
    }

    public function update($data = array(), $id = NULL)
    {
      $query = StudyClass::where('id', $id)->update($data);
      return $query;
    }

    public function softDelete($data = array(), $id = NULL)
    {
      $users = StudyClass::where('id', $id)->update($data);
      return $users;
    }
}
