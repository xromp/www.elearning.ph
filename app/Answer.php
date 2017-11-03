<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    //
    protected $primaryKey = 'answer_id';

    public function questions()
    {
    	return $this->hasMany('App\Question', 'question_code');
    }
}
