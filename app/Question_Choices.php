<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question_Choices extends Model
{
    protected $table = 'multiple_choices';

    protected $primaryKey 	= 'multiple_choice_id';

    public function question()
    {
    	$this->belongsTo('App\question', 'question_code');
    }
}
