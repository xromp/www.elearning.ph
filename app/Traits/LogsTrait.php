<?php

namespace App\Traits;

use Illuminate\Http\Request;
use DB;

use App\Question;
use App\Category;
use App\Student;
use App\Question_Choices;
use App\Answer;
use App\Logs;

trait LogsTrait
{
    public function insertLogs($data) {

        $transaction = DB::transaction(function($data) use($data){
            if ($data['type'] == 'WAD') {
                $data['type_desc'] = 'Working Activities (Direct)';
            } elseif ($data['type'] == 'WAI') {
                $data['type_desc'] = 'Working Activities (Indirect)';
            } elseif ($data['type'] == 'TM') {
                $data['type_desc'] = 'Topics Mastered';
            } elseif ($data['type'] == 'PA') {
                $data['type_desc'] = 'Planning Activities';
            } elseif ($data['type'] == 'SA') {
                $data['type_desc'] = 'Social Activities';
            } elseif ($data['type'] == 'FA') {
                $data['type_desc'] = 'Fun Activities';
            } else {return;}

            $logs = new Logs;
                $logs->log_description = $data['desc'];
                $logs->student_id = $data['student_id'];
                $logs->type = $data['type_desc'];
                $logs->save();
        });
    }

    public function workingLogs($data){        
        $formData = array(
            'student_id'=>$data['student_id'],
            'question_id'=>$data['question_id']
        );

        if ($data['type'] == 'ASKED') {
            $formData['desc'] = $formData['student_id'].' has posted question '.$formData['question_id'];
            $formData['type'] = 'WAD';
        } elseif ($data['type'] == 'ANSWERED') {
            $formData['desc'] = $formData['student_id'].' has answered question '.$formData['question_id'];
            $formData['type'] = 'WAD';
        } elseif ($data['type'] == 'RATED') {
            $formData['desc'] = $formData['student_id'].' has rated question '.$formData['question_id'];
            $formData['type'] = 'WAI';
        } else {
            throw new \Exception("Error Processing Request");
        }
        $this->insertLogs($formData);
    }

    public function masteredLogs($data){
        $formData = array(
            'student_id'=>$data['student_id'],
            'category'=>$data['category']
        );

        $formData['desc'] = $data['student_id'].' has mastered '.$data['category'];

        $this->insertLogs($formData);
    }
}
