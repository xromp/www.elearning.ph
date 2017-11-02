<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
	protected $table = "students";

	protected $fillable = [
		'studID', 'fName', 'lName', 'mName'
	];

	protected $primaryKey = 'studID';

    // public function account()
    // {
    // 	return $this->hasOne('App\Account', 'studID');
    // }

    public function questions()
    {
    	return $this->hasMany('App\Question', 'studID');
    }

    // public function logs()
    // {
    // 	return $this->hasMany('App\Log', 'studID');
    // }

    //dynamic details
    public function scopePerStudent($query, $id)
    {
    	return $query->where('studID', $id);
    }

    public function questionsCount()
	{
	  return $this->questions()
	    ->selectRaw('studID, count(*) as count')
	    ->groupBy('studID');
	}
}