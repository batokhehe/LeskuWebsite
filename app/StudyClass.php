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

		public function update_token($data, $id){
        $user = StudyClass::where('id', $id)->update($data);

        return $user;
    }

		protected $table_1 = 'study_classes';
		protected $table_2 = 'users';
		protected $table_3 = 'products';

		public function paymetVerification()
    {
			$query = $this->select(
						$this->table_1 . '.id',
						$this->table_2 . '.username',
						$this->table_3 . '.name',
						$this->table . '.ordered_assembly',
						$this->table . '.ordered_subject',
						$this->table . '.status'
					)
					->join($this->table_2, $this->table_2 . '.id', '=', $this->table_1 . '.user_id')
					->join($this->table_3, $this->table_3 . '.id', '=', $this->table_1 . '.product_id')
								->get();

								return $query;
    }

    public function find($id)
    {
      $users = StudyClass::where('id', $id)->first();
      return $users;
    }

    public function update($data = array(), $id = NULL)
    {
      $users = StudyClass::where('id', $id)->update($data);
      return $users;
    }

    public function softDelete($data = array(), $id = NULL)
    {
      $users = StudyClass::where('id', $id)->update($data);
      return $users;
    }
}
