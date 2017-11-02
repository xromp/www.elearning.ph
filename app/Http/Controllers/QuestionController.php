<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use DB;

use App\Student;
use App\Question;
use App\Question_Choices;
use App\Answer;
use App\Category;

// use App\Collection_line;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('question.index');
    }

    public function get(Request $request)
    {
        $formData = array(
            'limit'=>$request->input('limit'),
            'category'=>$request->input('collectionid'),
            'type'=>$request->input('orno'),
        );

 
        // $question = DB::table('question')
        //     ->select(
        //         'questionid',
        //         'question_code',
        //         'description',
        //         'title',
        //         'created_at',
        //         'updated_at',
        //         'created_by'
        //     );

        $questions = new question;
        $student = student::with(['questions'=>function($query){
                        return $query->orderBy('created_at','desc')->get();
                    },
                    'questions.multiple_Choice'
                    ])
                    // ->perStudent(2)
                    ->get();
        // $student->is_self = 'true';

        // $student = student::with(['questions'])->toSql();

        // $student = student::with('questions', 'questions.answers')->perStudent(1)->get();
        // return $student;

        // if ($formData['limit']) {
        //     $question->take($formData['limit']);
        // }

        // $questions = $questions->orderBy('created_at','desc')->get();

        // $result = json_decode($questions, true);
        // foreach ($result as $key => $question) {
        //     $result[$key]['category'] = 'Coding';
        //     $result[$key]['type'] = 'Composite';
        //     $result[$key]['is_self'] = true;
        //     $result[$key]['created_by_name'] = 'Rommel';
        //     $result[$key]['no_of_answers'] = 100;
        // }
 
        $question = DB::table('questions')
            ->select(
                'question_id',
                'question_code',
                'description',
                'title',
                'created_at',
                'updated_at',
                'student_id'
            );

        if ($formData['limit']) {
            $question->take($formData['limit']);
        }
        $question= $question->orderBy('created_at','desc')->get();

        $result = json_decode($question, true);
        foreach ($result as $key => $question) {
            $result[$key]['category'] = 'Coding';
            $result[$key]['type'] = 'Composite';
            $result[$key]['is_self'] = false;
            $result[$key]['created_by_name'] = 'Rommel';
            $result[$key]['no_of_answers'] = 100;
        }
            

        
        // return response()-> json([
        //     'status'=>200,
        //     'data'=>$result,
        //     'message'=>''
        // ]);

        return response()-> json([
            'status'=>200,
            'data'=>$student,
            'message'=>''
        ]);

        // return $student;
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'type_code'=> 'required',
            'category_code'=> 'required',
            'title'=> 'required',
            'description'=> 'required',
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
        $data['type_code'] = $request-> input('type_code');
        $data['category_code'] = $request-> input('category_code');
        $data['title'] = $request-> input('title');
        $data['choiceList'] = $request-> input('choiceList');
        $data['description'] = $request-> input('description');
 
        $data['createdBy'] = $request-> input('createdBy');

        // $transaction = DB::transaction(function($data) use($data){
 
        // $data['student_id'] = $request-> input('student_id');
        
        $transaction = DB::transaction(function($data) use($data){
            $question = new Question;
            $questionCode = 'Q10101-001';// generate realtime ans_code
            
            $question->question_code = $questionCode;
            $question->type_code = $data['type_code'];
            $question->category_code = $data['category_code'];
            $question->title = $data['title'];
            $question->description = $data['description'];
            $question->student_id = 1;
            $question->created_at = date('Y-m-d H:i:s');
            $question->updated_at = date('Y-m-d H:i:s');
 
            $question = new question;
            $questionCode = 'Q10101-005';// generate realtime ans_code
            $question->question = $data['description'];
            $question->title = $data['title'];
            $question->category_id = $data['category_code'];
            $question->type = $data['type_code'];
            $question->isVerified = 0;
            $question->question_code = $questionCode;
            $question->studID = 1;
            $question->save();
 
            if ($question->id && $questionCode) {

            //     // multiple choice
                if($data['type_code'] == 1) {
                // if($data['type_code'] == 'MULTIPLE_CHOICE') {
                    foreach ($data['choiceList'] as $key => $choices) {
                        $questionChoices = new Question_Choices;
                        $questionChoices->question_code = $questionCode;
                        $questionChoices->choice = $choices['choice_code'];
                        $questionChoices->choice_desc = $choices['choice_desc'];
                        // $questionChoices->is_correct = $choices['is_correct'];

                        //sample default values
                        $questionChoices->question_id = $question->question_id;
                        $questionChoices->is_correct = 0;
                        $questionChoices->save();
                    }
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
