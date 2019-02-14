<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name', 'parent_name', 'school_name', 'school_class', 'address', 'email', 'phone_number', 'level_id', 'user_id', 'image'
    ];

    protected $hidden = [
        
    ];
}
