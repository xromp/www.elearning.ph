<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;
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
    public function index(Request $request)
    {
        $request->session()->get('elearning_sess_accountId');
        $name = $request->session()->get('elearning_sess_name');

        if($request->session()->get('elearning_sess_accountId'))
        {
            return view('question.index', ['name'=>$name]);
        }
        else
        {
            return redirect('login');
        }
    }

    public function get(Request $request)
    {
        $formData = array(
            'limit'=>$request->input('limit'),
            'questionCode'=>$request->input('questionCode'),
            'categoryCode'=>$request->input('categoryCode'),
            'type'=>$request->input('orno'),
        );

        $question = DB::table('questions as q')
            -> select(
                'q.question_code',
                'q.title',
                'q.description', 
                'c.category_code',
                'c.description as category_desc',
                't.type_code',
                't.description as type_desc',
                'q.student_id',
                DB::raw('concat(s.lName,",", s.fName," ", s.mName) as student_name'),
                'a.no_of_answers',
                'ans.answer',
                DB::raw('ans.student_id as student_answered'),
                'q.created_at')
            -> leftJoin( DB::raw( "(SELECT answers.question_code, COUNT( answers.question_code ) as no_of_answers FROM answers GROUP BY answers.question_code) as a"), 'a.question_code', '=', 'q.question_code' )
            -> leftjoin('answers as ans','ans.question_code','=','q.question_code')
            -> leftjoin('categories as c','c.category_code','=','q.category_code')
            -> leftjoin('types as t','t.type_code','=','q.type_code')
            -> leftjoin('students as s','s.student_id','=','q.student_id');

        if (!$this->isEmpty($formData['questionCode'])) {
            $question->where('q.question_code',$formData['questionCode']);
        }
        if (!$this->isEmpty($formData['categoryCode'])) {
            $question->where('q.category_code',$formData['categoryCode']);
        }
        if ($formData['limit']) {
            $question->take($formData['limit']);
        }
        $question= $question
        ->latest()
        ->get();
        
        $result = array();

        $questionCopy = json_decode($question, true);
        foreach ($questionCopy as $key => $value) {
            $hasAnswered = DB::table('answers')
                ->where('question_code',$value['question_code'])
                ->where('student_id',$value['student_answered'])
                ->count();
            $isSelf = ($request->session()->get('student_id') == $value['student_id']);
            $hasAnswered = ($hasAnswered >= 1);

            $value['student_info'] = array(
                'student_id'=>$value['student_id'],
                'name'=>$value['student_name'],
                'is_self'=>$isSelf,
                'has_answered'=>$hasAnswered
            );

            $value['students_answered'] = collect([
                array('student_id'=>1, 'name'=>'Rom', 'answer'=>'a', 'is_correct'=>false, 'answered_at'=> 'new Date()'),
                array('student_id'=>2, 'name'=>'Mark', 'answer'=>'b', 'is_correct'=>false, 'answered_at'=> 'new Date()')
            ]);


            if ($value['student_info']['has_answered']){
                $value['answer'] = $value['answer'];            
            }

            if ($value['type_code'] == 'MULTIPLE_CHOICE'){
                $multipleChoice = DB::table('multiple_choices')
                    ->select('question_code','choice_code','choice_desc')
                    ->where('question_code',$value['question_code'])
                    ->get();
                
                $value['choiceList'] =  $multipleChoice;
            }
            array_push($result,$value);
        }

        return response()-> json([
            'status'=>200,
            'count'=>count($result),
            'data'=>$result,
            'message'=>''
        ]);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'type_code'=> 'required',
            'category_code'=> 'required',
            'title'=> 'required',
            'description'=> 'required'
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
        $data['student_id'] = $request->session()->get('student_id');
        $data['createdBy'] = $request-> input('createdBy');
        $data['question_code'] = $this->generateQuestionCode($data['category_code'],$data['type_code']);
        
        $hasAnswered = DB::table('answers')
            ->where('question_code',$data['question_code'])
            ->where('student_id',$data['student_id'])
            ->count();

        if ($hasAnswered >= 1){
            return response()->json([
                'status'=> 403,
                'data'=>'',
                'message'=>'You\'ve already answered this question.'
            ]);
        };

        // $transaction = DB::transaction(function($data) use($data){
 
        // $data['student_id'] = $request-> input('student_id');
        
        $transaction = DB::transaction(function($data) use($data){
            $question = new Question;
            $questionCode = $data['question_code'];// generate realtime ans_code
            $question->description = $data['description'];
            $question->title = $data['title'];
            $question->category_code = $data['category_code'];
            $question->type_code = $data['type_code'];
            $question->is_verified = 0;
            $question->question_code = $questionCode;
            $question->student_id = $data['student_id'];

            $question->save();
 
            if ($question->question_id && $questionCode) {

            //     // multiple choice
                // if($data['type_code'] == 1) {
                if($data['type_code'] == 'MULTIPLE_CHOICE') {
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

    public function getCategories(Request $request)
    {
        $categories = Category::all();
        // echo "erikon";
        return response()->json([
            'status' => 200,
            'data' => $categories,
            'message' => 'Successfully loaded.'
        ]);
    }

    public function getQuestions()
    {
        $questions = question::with([
                    'students',
                    'category', 
                    'multiple_Choice'=>function($q){
                        $q->select('multiple_choice_id', 'question_code', 'choice', 'choice_desc')
                        ->get();
                    }])
                    ->select('question_id', 'question_code', 'category_code', 'type_code', 'title', 'description', 'student_id')
                    ->where('question_code', 'Q0103-002')
                    ->get();
        return response()->json([
            'status' => 200,
            'data' => $questions,
            'message' => 'Successfully loaded.'
        ]);
    }

    public function isEmpty($question){
        return (!isset($question) || trim($question)===''|| $question ==='undefined');
    }

    public function generateQuestionCode($categoryCode, $typeCode){
        // Q0101-0001
        $category = DB::table('categories')
            ->where('category_code',$categoryCode)
            ->first();

        $type = DB::table('types')
            ->where('type_code',$typeCode)
            ->first();
        
        $counter = DB::table('questions')
            ->where('category_code',$categoryCode)
            ->where('type_code',$typeCode)
            ->count();

        $category_id = sprintf('%02d', $category->category_id);
        $type_id = sprintf('%02d', $type->type_id);
        $counter = $counter+1;
        $counter = sprintf('%04d', $counter);
        
        $question = 'Q'.$category_id.$type_id.'-'.$counter;
        return $question;
    }


    //for checking purposes only
    public function sess(Request $request)
    {
        echo "email = ".$request->session()->get('elearning_sess_accountId');
        echo "<br>";
        echo "sess = ".$request->session()->get('elearning_sess_email');
    }

    public function sess_flush(Request $request)
    {
        echo "sess = ".$request->session()->forget('sess_email');
        echo "<br>";
        echo "sess = ".$request->session()->forget('sess_accountId');
    }

    public function leaderboard()
    {
        $students = DB::table('students')->get();

        foreach($students as $key=>$student)
        {
            $data[$key]['student_id'] = $student->student_id;
            $data[$key]['fName'] = $student->fName;
            $data[$key]['mName'] = $student->mName;
            $data[$key]['lName'] = $student->lName;
            $data[$key]['name'] = $student->lName.", ".$student->fName." ".$student->mName;
            $data[$key]['hashedID'] = $this->GetRandom(10).$student->student_id.$this->GetRandom(10);
        }

        return response()->json([
            'status' => 200,
            'data' => $data,
            'message' => 'Successfully loaded.'
        ]);
    }

    public function GetRandom($keyLength)
    {
        return str_random($keyLength);
    }

    // public function QuestionsPosted()
    // {
    //     $questions = question::with([
    //                 'students',
    //                 'category', 
    //                 'multiple_Choice'=>function($q){
    //                     $q->select('multiple_choice_id', 'question_code', 'choice', 'choice_desc')
    //                     ->get();
    //                 }])
    //                 ->select('question_id', 'question_code', 'category_code', 'type_code', 'title', 'description', 'student_id')
    //                 ->where('question_code', 'Q0103-002')
    //                 ->get();
    //     return response()->json([
    //         'status' => 200,
    //         'data' => $questions,
    //         'message' => 'Successfully loaded.'
    //     ]);
    // }
}
