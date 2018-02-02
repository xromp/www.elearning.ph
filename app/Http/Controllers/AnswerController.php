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
use App\Achievements;

// use App\Collection_line;
use App\Traits\PointsTrait;
use App\Traits\AchievementsTrait;
use App\Traits\LogsTrait;


class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use PointsTrait;
    use AchievementsTrait;
    use LogsTrait;
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
            $data['question_id'] = $request-> input('question_id');
            $data['question_code'] = $request-> input('question_code');
            $data['category_code'] = $request-> input('category_code');
            $data['type_code'] = $request-> input('type_code');
            $data['student_id'] = $request-> input('student_id');
            $data['rating'] = $request-> input('rating');
            $data['answer'] = $request-> input('answer');
            $data['session']['student_id'] = $request->session()->get('student_id');
            $data['loggedForPlan']= $request-> input('loggedForPlan');

            $hasAnswered = DB::table('answers')
                ->where('question_code',$data['question_code'])
                ->where('student_id',$data['session']['student_id'])
                ->count();
            
            $isSelf = ($request->session()->get('student_id') == $data['student_id']);

            if( $hasAnswered >= 1 ) {
                return response()->json([
                    'status' => 403,
                    'data' => 'null',
                    'message' => 'You have already answered this question.'
                ]);
            }

            if($isSelf) {
                return response()->json([
                    'status' => 200,
                    'data' => 'null',
                    'message' => 'You are not allowed to answer your own question.'
                ]);
            }
            if ($data['type_code'] == 'CODING') {
                $hasAnsweredCorrectly = DB::table('answers')
                    ->where('question_code',$data['question_code'])
                    ->where('is_correct',1)
                    ->count();
                
                if( $hasAnsweredCorrectly >= 1 ) {
                    return response()->json([
                        'status' => 403,
                        'data' => 'null',
                        'message' => 'This question has been already answered correctly.'
                    ]);
                }
            }

            
            
            $transaction = DB::transaction(function($data) use($data){
                $answer = new Answer;
                $data['student_id'] = $data['session']['student_id'];//session
                $answer->question_code = $data['question_code'];
                $answer->student_id = $data['student_id'];
                $answer->answer = $data['answer'];
                if (!$this->isEmpty($data['rating'])) {
                    $answer->rating = $data['rating'];
                    //event logging
                    $logsData = array(
                        'student_id'=>$data['student_id'],
                        'type'=>'RATED',
                        'question_id'=>$data['question_id']
                    );
                    $this->workingLogs($logsData);
                } else {
                    //event logging
                    $logsData = array(
                        'student_id'=>$data['student_id'],
                        'type'=>'ANSWERED',
                        'question_id'=>$data['question_id']
                    );
                    $this->workingLogs($logsData);

                }
                // $answer->points = $this->getPointsAnswerPerStudent('answer',$data['type_code'],$data['category_code']);

                if ($data['type_code'] == 'MULTIPLE_CHOICE') {
                    $correctAns = DB::table('multiple_choices')
                        ->where('question_code',$data['question_code'])
                        ->where('choice_code',$data['answer'])
                        ->where('is_correct',1)
                        ->get();
                    
                    $answer->is_correct =  $correctAns->count();
                    $answer->save();
                    if ($correctAns->count()) {
                        $i = array(
                            'question_code'=>$data['question_code'],
                            'type_code'=>$data['type_code'],
                            'student_id'=>$data['student_id'],
                            'category_code'=>$data['category_code'],
                        );

                        DB::table('answers')
                            -> where('answer_id',$answer->answer_id)
                            -> update(['points'=>$this->getPointsAnswerPerStudent($i)]);
                    }
                } else if ($data['type_code'] == 'IDENTIFICATION') {
                    $correctAns = DB::table('multiple_choices')
                        ->where('question_code',$data['question_code'])
                        ->where('choice_code',$data['answer'])
                        ->where('is_correct',1)
                        ->get();
                    
                    $answer->is_correct =  $correctAns->count();
                    $answer->save();
                    // dd($this->getPointsAnswerPerStudent('answer',$data['type_code'],$data['category_code']));
                    if ($correctAns->count()) {
                        $i = array(
                            'question_code'=>$data['question_code'],
                            'type_code'=>$data['type_code'],
                            'student_id'=>$data['student_id'],
                            'category_code'=>$data['category_code'],
                        );

                        DB::table('answers')
                            -> where('answer_id',$answer->answer_id)
                            -> update(['points'=>$this->getPointsAnswerPerStudent($i)]);
                    }
                } else {
                    $answer->save();
                }
                
                if($data['loggedForPlan']) {
                    $logsData = array(
                        'student_id'=>$data['student_id'],
                        'question_id'=>$data['question_id']
                    );
                    $this->logsForPlan($logsData);
                }

                // achievements
                $this->isFirstAnswer($data);
                $this->isFirstCorrectAnswer($data);
                $this->isFirstRated($data);
                $this->isFirst5Rated($data);
     
                return response()->json([
                    'status' => 200,
                    'data' => 'null',
                    'message' => 'Successfully saved.'
                ]);
            });
    
            return $transaction;
        }   
    }

    public function getAnsweredBySelf(Request $request)
    {
        $formData = array(
            'student_id'=>$request->input('studentId')
        );
        $self = $request->session()->get('student_id');
        
        if ($self != $formData['student_id'] || $this->isEmpty($formData['student_id'])) {
            return response()-> json([
                'status'=>403,
                'data'=>'',
                'message'=>'Unauthorized'
            ]);
        }
        $answersPerStudent = DB::table('answers as a')
            -> select(
                'q.question_id',
                'q.question_code',
                'q.title',
                'q.description', 
                'q.is_approved',
                'c.category_code',
                'c.description as category_desc',
                't.type_code',
                't.description as type_desc',
                'q.student_id',
                DB::raw('concat(s.lName,",", s.fName," ", s.mName) as student_name'),
                'q.created_at')
            -> join ( DB::raw( "(SELECT 
                questions.question_id,
                questions.question_code,
                questions.category_code,
                questions.type_code,
                questions.student_id,
                questions.title,
                questions.description, 
                questions.is_approved,
                questions.created_at
                FROM questions) as q"), 
                'a.question_code', '=', 'q.question_code' )
            -> leftjoin('categories as c','c.category_code','=','q.category_code')
            -> leftjoin('types as t','t.type_code','=','q.type_code')
            -> leftjoin('students as s','s.student_id','=','q.student_id')
            -> where('a.student_id',$self)
            ->get();

       
        return response()-> json([
            'status'=>200,
            'count'=>count($answersPerStudent),
            'data'=>$answersPerStudent,
            'message'=>''
        ]);
    }

    public function isEmpty($question){
        return (!isset($question) || trim($question)===''|| $question ==='undefined');
    }
}
