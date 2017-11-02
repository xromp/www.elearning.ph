<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Question extends Model
{

    // protected $table = 'question';
    protected $table = 'question';

    protected $fillable = [
    	'question', 'title', 'category_id', 'type', 'isVerified', 'question_code', 'studID', 'created_at', 'updated_at'
    ];
    
	protected $primaryKey 	= 'question_id';

	public function multiple_Choice()
    {
    	return $this->hasMany('App\Question_Choices', 'question_id');
    }

    public function students()
    {
    	return $this->hasMany('App\student', 'studID');
    }

    // public function multiple_Choice2()
    // {
    // 	return $this->hasMany('App\Question_Choices', 'question_id');
    // }

    public function multipleCount()
	{
	  return $this->multiple_Choice()
	    ->selectRaw('question_id, count(*) as count')
	    ->groupBy('question_id');
	}
 //    public function questionsCount()
	// {
	//   	return $this->selectRaw('studID, count(*) as aggregate')
	//     ->groupBy('studID');
	// }


    // public function answers()
    // {
    //     return $this->hasMany('App\Answer', 'question_id');
    // }
}
