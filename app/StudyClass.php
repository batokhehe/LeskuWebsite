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
    				$this->table . '.trf_file',
    				$this->table . '.created_at',
    				$this->table . '.status'
    			)
    			->join($this->table2, $this->table2 . '.id', '=', $this->table . '.product_id')
                ->whereIn($this->table . '.status', [0, 1])
                ->orderBy($this->table . '.status')
                ->get();

                return $query;
    }
}
