<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use DB;

use App\Question;
use App\Student;
use App\Question_Choices;
use App\Answer_Multiple_Choice;
use App\Answer;

// use App\Collection_line;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('stock-market.index');
    }

    public function save(Request $request){
        {
            $validator = Validator::make($request->all(),[
                'question_code'=> 'required',
                'category_code'=> 'required',
                'type_code'=> 'required',
                'answer'=> 'required'
            ]);
    
            if ($validator-> fails()) {
                return response()->json([
                    'status'=> 403,
                    'data'=>'',
                    'message'=>'Unable to save.'
                ]);
            }
    
            $data = array();
            $data['question_code'] = $request-> input('question_code');
            $data['category_code'] = $request-> input('category_code');
            $data['type_code'] = $request-> input('type_code');
            $data['rating'] = $request-> input('rating');
            $data['answer'] = $request-> input('answer');
            
            $transaction = DB::transaction(function($data) use($data){
                $answer = new Answer;
                $data['student_id'] = 1;//session
                $answer->question_code = $data['question_code'];
                $answer->student_id = $data['student_id'];

                if (!$this->isEmpty($data['rating'])) {
                    $answer->rating = $data['rating'];
                }

                $answer->save();
     
                if ($answer->answer_id) {
    
                    if($data['type_code'] == 'MULTIPLE_CHOICE') {
                        $answer_choices = new Answer_Multiple_Choice;

                        $answer_choices->answer_id = $answer->answer_id;
                        $answer_choices->answer = $data['answer'];

                        $answer_choices->save();
                    }
    
                } else {
                    throw new \Exception("Error Processing Request");
                }
    
                return response()->json([
                    'status' => 200,
                    'data' => 'null',
                    'message' => 'Successfully saved.'
                ]);
    
            });
    
            return $transaction;
        }   
    }

    public function isEmpty($question){
        return (!isset($question) || trim($question)===''|| $question ==='undefined');
    }
}
