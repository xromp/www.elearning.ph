<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;
use DB;

use App\Student;
use App\Question;
use App\Question_Choices;
use App\Answer;
use App\Category;
use App\Achievements;

use App\Traits\PointsTrait;
use App\Traits\AchievementsTrait;
// use App\Collection_line;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use PointsTrait;
    use AchievementsTrait;
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
        $isAdmin = ($request->session()->get('account_type') == 1);

        // $data = array();
        // $data['category_code'] = 'ADAPTER';
        // $data['student_id'] = 5;

        // dd($this->isMasterAchievedByCategory($data));

        $question = DB::table('questions as q')
            -> select(
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
                'a.no_of_answers',
                'q.created_at')
            -> leftJoin( DB::raw( "(SELECT answers.question_code, COUNT( answers.question_code ) as no_of_answers FROM answers GROUP BY answers.question_code) as a"), 'a.question_code', '=', 'q.question_code' )
            -> leftjoin('categories as c','c.category_code','=','q.category_code')
            -> leftjoin('types as t','t.type_code','=','q.type_code')
            -> leftjoin('students as s','s.student_id','=','q.student_id');

        if (!$this->isEmpty($formData['questionCode'])) {
            $question->where('q.question_code',$formData['questionCode']);
        }
        if (!$this->isEmpty($formData['categoryCode'])) {
            $question->where('q.category_code',$formData['categoryCode']);
        }

        // if (!$isAdmin){
        //     $question->where('q.is_approved',1);
        // }

        if ($formData['limit']) {
            $question->take($formData['limit']);
        }
        $question= $question
        ->latest()
        ->get();
        
        $result = array();

        $questionCopy = json_decode($question, true);
        foreach ($questionCopy as $key => $value) {
            $validEntry = true;

            $hasAnswered = DB::table('answers')
                ->where('question_code',$value['question_code'])
                ->where('student_id',$request->session()->get('student_id'))
                ->count();
            
            $isSelf = ($request->session()->get('student_id') == $value['student_id']);
            $hasAnswered = ($hasAnswered >= 1);

            $value['student_info'] = array(
                'student_id'=>$request->session()->get('student_id'),
                'name'=>$request->session()->get('fullname'),
                'is_self'=>$isSelf,
                'has_answered'=>$hasAnswered,
                'is_admin'=>$isAdmin
            );
            
            if ($value['type_code'] == 'MULTIPLE_CHOICE'){
                $multipleChoice = DB::table('multiple_choices')
                    ->select('question_code','choice_code','choice_desc')
                    ->where('question_code',$value['question_code'])
                    ->get();
                
                $value['choiceList'] =  $multipleChoice;
            } elseif($value['type_code'] == 'CODING') {
                $hasAnsweredCorrectly = DB::table('answers')
                    ->select('question_code','choice_code','choice_desc')
                    ->where('question_code',$value['question_code'])
                    ->where('is_correct',1)
                    ->count();
                $value['is_answered_correctly'] = ($hasAnsweredCorrectly >= 1);
            }

            if ($value['student_info']['is_self'] == true || ($value['type_code'] == 'CODING' && $value['is_answered_correctly'] && $value['student_info']['has_answered']) ){
                $isCodingCorrectlyAnswered = ($value['type_code'] == 'CODING' && $value['is_answered_correctly'] && $value['student_info']['has_answered']);

                $student_answered = DB::table('answers as a')
                ->select('a.student_id',
                    DB::raw('concat(s.lName,",", s.fName," ", s.mName) as name'),
                    'answer',
                    'question_code',
                    'is_correct')
                ->leftjoin('students as s','s.student_id','=','a.student_id')
                ->where('a.question_code',$value['question_code']);

                if ($isCodingCorrectlyAnswered) {
                    $student_answered->where('a.is_correct',true);
                }
                $student_answeredCopy = $student_answered;
                $student_answered = $student_answered->get();
                
                if ($isCodingCorrectlyAnswered) {
                    $student_answeredCopy = $student_answeredCopy->first();
                    // check if current you user answer this correctly
                    if ($student_answeredCopy->student_id == $request->session()->get('student_id')) {
                        $value['student_info']['answered_correctly'] = true;
                    }
                                    
                }

                $value['students_answered'] = array(
                    'list'=>collect($student_answered),
                    'count'=>$student_answered->count()
                );    
            }
            

            if ($value['student_info']['has_answered']){
                $studentAnswer = DB::table('answers')
                    ->where('question_code',$value['question_code'])
                    ->where('student_id',$request->session()->get('student_id'))
                    ->get();

                $value['answer'] = array();
                $studentAnswerCopy = json_decode($studentAnswer, true);
                // dd($studentAnswerCopy);
                foreach ($studentAnswerCopy as $key => $student_value)
                {
                    array_push($value['answer'],$student_value['answer']);
                }
            }

            if ($value['student_info']['is_self']){
                $correctAnswer = DB::table('multiple_choices')
                    ->where('question_code',$value['question_code'])
                    ->where('is_correct',1)
                    ->get();

                $value['answer'] = array();
                $correctAnswerCopy = json_decode($correctAnswer, true);
                foreach ($correctAnswerCopy as $key => $ans_value)
                {
                    array_push($value['answer'],$ans_value['choice_code']);
                }
                
            }

            if ($value['type_code'] == 'CODING'){
                // $validEntry = !$value['is_answered_correctly'];
            }

            if ( !($isSelf || $isAdmin) && !$value['is_approved'] ) {
                $validEntry = false;
            }

            if ($validEntry) {
                array_push($result,$value);
                
            }
        }

        return response()-> json([
            'status'=>200,
            'count'=>count($result),
            'data'=>$result,
            'message'=>''
        ]);
    }
    
    public function getWithPaginate(Request $request){
        $users = DB::table('questions')->simplePaginate(10);
        
        return $users;
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
        $data['answer'] = $request-> input('answer');
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
        $this->isFirstQuestion($data);

        $transaction = DB::transaction(function($data) use($data){
            $question = new Question;
            $questionCode = $data['question_code'];// generate realtime ans_code
            $question->description = $data['description'];
            $question->title = $data['title'];
            $question->category_code = $data['category_code'];
            $question->type_code = $data['type_code'];
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
                        $questionChoices->choice_code = $choices['choice_code'];
                        $questionChoices->choice_desc = $choices['choice_desc'];
                        $questionChoices->is_correct = $choices['is_correct'];

                        //sample default values
                        $questionChoices->save();
                    }
                } else if($data['type_code'] == 'IDENTIFICATION') {
                    foreach ($data['answer'] as $key => $choices) {
                        $questionChoices = new Question_Choices;
                        $questionChoices->question_code = $questionCode;
                        $questionChoices->choice_code = $choices;
                        $questionChoices->choice_desc = $choices;
                        $questionChoices->is_correct = 1;

                        //sample default values
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

    public function action(Request $request){
        $validator = Validator::make($request->all(),[
            'question_code'=> 'required',
            'action'=>'required',
            'student_id'=>'required'
        ]);

        if ($validator-> fails()) {
            return response()->json([
                'status'=> 403,
                'data'=>'',
                'message'=>'Unable to save.'
            ]);
        }

        $data = array(
            'questionCode'=>$request->input('question_code'),
            'action'=>$request->input('action'),
            'is_approved' => 0,
            'student_id' => $request->input('student_id'),
            'category_code' => $request->input('category_code'),
            'type_code' => $request->input('type_code')
        );

        if(!($data['action'] == 'APPROVED'||$data['action'] == 'DECLINED')) {
            return response()->json([
                'status'=> 403,
                'data'=>'',
                'message'=>'Invalid action.'
            ]);

        }

        $account_type = $request->session()->get('account_type');

        if($account_type != 1) {
            return response()->json([
                'status'=> 403,
                'data'=>'',
                'message'=>'You are not authorized to perform this action.'
            ]);
        }
        
        if ($data['action'] == 'APPROVED') {
            $data['is_approved'] = 1;
        }

        $transaction = DB::transaction(function($data) use($data) {
            
            DB::table('questions')
                -> where('question_code',$data['questionCode'])
                -> update(['is_approved'=>$data['is_approved']]);

            if ($data['is_approved']) {
                $i = array(
                    'question_code'=>$data['questionCode'],
                    'type_code'=>$data['type_code'],
                    'student_id'=>$data['student_id'],
                    'category_code'=>$data['category_code'],
                );

                DB::table('questions')
                    -> where('question_code',$data['questionCode'])
                    -> update(['points'=>$this->getPointsQuestionPerStudent($i)]);
            }
            
            $message = 'Successfully '.strtolower($data['action'].'.');

            return response()->json([
                'status'=> 200,
                'data'=>'',
                'message'=>$message
            ]);
        });

        //checking achievements
        $this->isFirstApprovedQuestion($data);
        $this->isHaving20QuestionsApproved($data);
        $this->isFirstReject($data);
        return $transaction;
    }

    public function actionAnswer(Request $request){
        $validator = Validator::make($request->all(),[
            'question_code'=> 'required',
            'action'=>'required',
            'student_id'=>'required'
        ]);

        if ($validator-> fails()) {
            return response()->json([
                'status'=> 403,
                'data'=>'',
                'message'=>'Unable to save.'
            ]);
        }

        $data = array(
            'question_code'=>$request->input('question_code'),
            'action'=>$request->input('action'),
            'student_id'=>$request->input('student_id'),
            'is_correct'=>0,
            'category_code'=>$request->input('category_code'),
            'type_code'=>$request->input('type_code')
        );

        $currentUser = $request->session()->get('student_id');

        if(!($data['action'] == 'CORRECT'||$data['action'] == 'WRONG')) {
            return response()->json([
                'status'=> 403,
                'data'=>'',
                'message'=>'Invalid action.'
            ]);
        }

        $askQuestion = DB::table('questions')
            ->where('question_code',$data['question_code'])
            ->first();

        if  ($currentUser != $askQuestion->student_id){
            return response()->json([
                'status'=> 403,
                'data'=>'',
                'message'=>'You are not authorized to perform this action'
            ]);
        }
        
        if ($data['action'] == 'CORRECT') {
            $data['is_correct'] = 1;
        }

        $transaction = DB::transaction(function($data) use($data) {
            
            DB::table('answers')
            -> where('question_code',$data['question_code'])
            -> where('student_id',$data['student_id'])
            -> update(['is_correct'=>$data['is_correct']]);

            if ($data['is_correct']) {
                $i = array(
                    'question_code'=>$data['question_code'],
                    'type_code'=>$data['type_code'],
                    'student_id'=>$data['student_id'],
                    'category_code'=>$data['category_code'],
                );

                DB::table('answers')
                    -> where('answer_id',$answer->answer_id)
                    -> update(['points'=>$this->getPointsAnswerPerStudent($i)]);
                // DB::table('answers')
                // -> where('question_code',$data['question_code'])
                // -> where('student_id',$data['student_id'])
                // -> update(['points'=>$this->GetPoints('answer',$data['type_code'],$data['category_code'])]);

                $this->isFirstCorrectAnswer($data);
                $this->isFirstCodingCorrectAnswer($data);
            }
            
            $message = 'Successfully updated';

            return response()->json([
                'status'=> 200,
                'data'=>'',
                'message'=>$message
            ]);
        });

        return $transaction;
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

    // ASK ACHIEVEMENTS
    public function isFirstQuestion($data) {

        if ($this->isEmpty($data['student_id'])) {
            return 'No student_id supplied';
        }
        
        $questions_count = DB::table('questions as q')
            -> where('student_id',$data['student_id'])
            -> count();
        
        $isFirstQuestion = ($questions_count == 0);

        if ($isFirstQuestion){
            $transaction = DB::transaction(function($data) use($data) {
                
                $formData = array (
                    'code'=> 'ASK-02',
                    'student_id'=>$data['student_id']

                );

                if ($this->isAchivementExists($formData)){
                    return response()->json([
                        'status'=> 200,
                        'data'=>'',
                        'message'=>'Achievement Code '.$formData['code'].' has already exists.'
                    ]);   
                }

                $achivements = new Achievements;
                $achivements->achievement_code = $formData['code'];
                $achivements->student_id = $data['student_id'];
                $achivements->is_achieved = true;

                $achivements->save();
                $this->onLoadAchieved($data);
                if ($achivements->id){
    
                    return response()->json([
                        'status'=> 200,
                        'data'=>'',
                        'message'=>'Sucessfully saved.'
                    ]);    
                } else {
                    throw new \Exception("Error Processing Request");
                }
            });
            return $transaction;
        }
    }

    public function isFirstApprovedQuestion($data) {

        if ($this->isEmpty($data['student_id'])) {
            return 'No student_id supplied';
        }
        
        $questions_count = DB::table('questions as q')
            -> where('is_approved',true)
            -> where('student_id',$data['student_id'])
            -> count();
        
        $isFirstQuestion = ($questions_count == 0);

        if ($isFirstQuestion){
            $transaction = DB::transaction(function($data) use($data) {
                
                $formData = array (
                    'code'=> 'ASK-03',
                    'student_id'=>$data['student_id']

                );

                if ($this->isAchivementExists($formData)){
                    return response()->json([
                        'status'=> 200,
                        'data'=>'',
                        'message'=>'Achievement Code '.$formData['code'].' has already exists.'
                    ]);   
                }

                $achivements = new Achievements;
                $achivements->achievement_code = $formData['code'];
                $achivements->student_id = $data['student_id'];
                $achivements->is_achieved = true;

                $achivements->save();
 
                if ($achivements->id){
    
                    return response()->json([
                        'status'=> 200,
                        'data'=>'',
                        
                        'message'=>'Sucessfully saved.'
                    ]);    
                } else {
                    throw new \Exception("Error Processing Request");
                }
            });
            return $transaction;
        }
    }

    public function isHaving20QuestionsApproved($data) {

        if ($this->isEmpty($data['student_id'])) {
            return 'No student_id supplied';
        }
        
        $questions_count = DB::table('questions as q')
            -> where('is_approved',true)
            -> where('student_id',$data['student_id'])
            -> count();
        
        $isFirst20Question = ($questions_count == 20);

        if ($isFirst20Question){
            $transaction = DB::transaction(function($data) use($data) {
                
                $formData = array (
                    'code'=> 'ASK-04',
                    'student_id'=>$data['student_id']

                );

                if ($this->isAchivementExists($formData)){
                    return response()->json([
                        'status'=> 200,
                        'data'=>'',
                        'message'=>'Achievement Code '.$formData['code'].' has already exists.'
                    ]);   
                }

                $achivements = new Achievements;
                $achivements->achievement_code = $formData['code'];
                $achivements->student_id = $data['student_id'];
                $achivements->is_achieved = true;

                $achivements->save();
 
                if ($achivements->id){
    
                    return response()->json([
                        'status'=> 200,
                        'data'=>'',
                        'message'=>'Sucessfully saved.'
                    ]);    
                } else {
                    throw new \Exception("Error Processing Request");
                }
            });
            return $transaction;
        }
    }

    public function having20QuestionsApproved(Request $request) {
        
    }
    
    public function isAchivementExists($formData) {
        $isExists = DB::table('achievements as a')
            -> where('achievement_code',$formData['code'])
            -> where('student_id',$formData['student_id'])
            -> count();
        
        return ($isExists >= 1);
    }

}

