<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

    protected $primary_key = "studentId";

    public function questions(){
        return $this->hasMany('App\Question','studentId');
    }
}
