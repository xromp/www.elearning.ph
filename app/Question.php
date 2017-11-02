<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Question extends Model
{
    // protected $table = 'ss';

    protected $primary_key = "question_id";

    public function question_choices(){
        return $this->hasMany(Question_Choices::class,'question_code');
    }
}
