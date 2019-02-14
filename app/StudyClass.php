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
                ->orderBy($this->table . '.status')
                ->get();

                return $query;
    }

		public function paymentVerification()
    {
			$query = $this->select(
						$this->table. '.id',
						$this->table3 . '.username',
						$this->table2 . '.name',
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
						$this->table . '.status'
					)
					->join($this->table3, $this->table3 . '.id', '=', $this->table . '.user_id')
					->join($this->table2, $this->table2 . '.id', '=', $this->table . '.product_id')
					->where($this->table. '.id', $id)
								->first();

								return $query;
    }

		public function findDetail($id)
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
