<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
	protected $table = "students";

	protected $fillable = [
		'fName', 'lName', 'mName'
	];

	protected $primaryKey = 'student_id';

    // public function account()
    // {
    // 	return $this->hasOne('App\Account', 'studID');
    // }

    public function questions()
    {
    	return $this->hasMany('App\Question', 'student_id');
    }

    // public function logs()
    // {
    // 	return $this->hasMany('App\Log', 'studID');
    // }

    //dynamic details
    public function scopePerStudent($query, $id)
    {
    	return $query->where('student_id', $id);
    }

    public function questionsCount()
	{
	   return $this->questions()
	    ->selectRaw('student_id, count(*) as count')
	    ->groupBy('student_id');
	}
}

