<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\Student;
use App\Question;
use App\Question_Choices;
use App\Answer;
use App\Category;
use Hash;

class AchievementsController extends Controller
{
    public function RemoveExtras($hashed)
    {
        $data = substr($hashed, 10);
        return substr($data, 0, -10);
    }

    public function FirstQuestion($id)
    {
    	// $id = session()->get('elearning_sess_accountId');
    	$data = DB::table('students as s')
    				->select('s.student_id',
    					's.fName',
    					's.mName',
    					's.lName',
    					'l.log_description'
    				)
    				->where('s.student_id', $id)
    				->where('l.log_description', 'Posted a question')
    				-> leftjoin('logs as l','s.student_id','=','l.student_id')
    				->get();
    	$data->count();

        

    	if($data->count()>0)
    	{
    		$achievement = array(
    				'AchievementType'=>'First Question',
    				'Desc'=>'Can you help me?',
    				'Icon'=>'first-question.png'
    		); 
    		return $achievement;
    	}
    }

    public function FirstAnswer($id)
    { 
    	// $id = session()->get('elearning_sess_accountId');
    	$data = DB::table('students as s')
    				->select('s.student_id',
    					's.fName',
    					's.mName',
    					's.lName',
    					'l.log_description'
    				)
    				->where('s.student_id', $id)
    				->where('l.log_description', 'Answered a question')
    				-> leftjoin('logs as l','s.student_id','=','l.student_id')
    				->get();
    	$data->count();

    	if($data->count()>0)
    	{
    		$achievement = array(
    				'AchievementType'=>'Answered Question',
    				'Desc'=>'Trying my best',
    				'Icon'=>'first-answer.png'
    		); 
    		return $achievement;
    	}
    }

    public function Forum($id)
    { 
        // $id = session()->get('elearning_sess_accountId');
        $data = DB::table('students as s')
                    ->select('s.student_id',
                        's.fName',
                        's.mName',
                        's.lName',
                        'l.log_description'
                    )
                    ->where('s.student_id', $id)
                    ->where('l.log_description', 'Posted a topic')
                    -> leftjoin('logs as l','s.student_id','=','l.student_id')
                    ->get();
        $data->count();

        if($data->count()>=5)
        {
            $achievement = array(
                    'AchievementType'=>'Forum',
                    'Desc'=>'Conversationalist',
                    'Icon'=>'forum.png'
            ); 
            return $achievement;
        } 

    }


    public function Achievements(Request $request)
    {	
        $hashedID = $request->input('hashedID');
        $hashedID = $this->RemoveExtras($hashedID);

    	$achievements = array();

    	if($this->FirstQuestion($hashedID))
    	{
    		array_push($achievements, $this->FirstQuestion($hashedID));
    	}

    	if($this->FirstAnswer($hashedID))
    	{
    		array_push($achievements, $this->FirstAnswer($hashedID));
    	}

        if($this->Forum($hashedID))
        {
            array_push($achievements, $this->Forum($hashedID));
        }

        return response()-> json([
            'status'=>200,
            'data'=>$achievements,
            'message'=>''
        ]);
	}

    // public function RemoveExtras($hashed)
    // {
    //     $data = substr($hashed, 10);
    //     return substr($data, 0, -10);
    // }

    public function getStudID(Request $request) 
    {   
        $id = "UaQHgsgZW51GXsU4yOwKW";
        echo $this->RemoveExtras($id);

        // $student_id = $request->input('studentId');
        // if(Hash::check(1, '$2y$10$yJkoIsiZ.ECLdjmRQxc42uxT5YcPLjPD8dZMvQE.KMkyVEW80TCRy'))
        // {
        //     echo "true";
        // }
        // else
        // {
        //     echo "false";
        // }
    }

    public function GetRandom($keyLength)
    {
        return str_random($keyLength);
    }

	public function get(Request $request) 
    {    

        // $studentId = $this->RemoveExtras($request->input('studentId'));

        $data = array(
            'student_id'=>$request->input('studentId'),
            'search_name'=>$request->input('search_name')
        );

        $result = array();

        $students = DB::table('students as s')
            -> select(
                'student_id',
                DB::raw('concat(s.lName,",", s.fName," ", s.mName) as student_name')
            );

        if ($data['student_id'])
        {
            $students = $students-> where ('student_id',$data['student_id']);
        }

        if ($data['search_name']) {
            $students = $students->orWhere('s.lName', 'like', '%' . $data['search_name'] . '%')
                ->orWhere('s.fName', 'like', '%' . $data['search_name'] . '%')
                ->orWhere('s.mName', 'like', '%' . $data['search_name'] . '%');
        }
        
        $students = $students->get();
        $studentsCopy = json_decode($students, true);
        foreach ($studentsCopy as $key => $student) {
            $achievementsResult = array();
            
            $achievementsTypes = array(
                array('desc' => 'Asking Questions','code'=>'ASKING'),
                array('desc' => 'Answering Questions','code'=>'ANSWER'),
                array('desc' => 'Participation','code'=>'PARTICIPATION'),
                array('desc' => 'Social Activities','code'=>'SOCIAL'),
                array('desc' => 'Ratings','code'=>'RATINGS'),
                array('desc' => 'Fun Activities','code'=>'FUN')
            );

            // $categoriesCopy = json_decode($categories, true);
            foreach ($achievementsTypes as $key => $type) {
                $achievementsPerStudents = DB::table('rewards as r')
                -> select(
                    'r.reward_id',
                    'r.achievement_code',
                    'type',
                    'title', 
                    'description',
                    'icon_path',
                    'a.student_id',
                    'a.is_achieved'
                )
                -> leftJoin( DB::raw( "(SELECT achievements.achievement_code, is_achieved, student_id FROM achievements 
                    WHERE student_id = '".$student['student_id']."'
                    GROUP BY achievements.achievement_code,is_achieved, student_id) as a"), 'a.achievement_code', '=', 'r.achievement_code' )
                -> where('r.active',true)
                -> where('r.type',$type['code'])
                // -> where('student_id',$student['student_id'])
                -> get();

                $typeDetails['list'] = $achievementsPerStudents;
                $typeDetails['count'] = $achievementsPerStudents->count();
                $typeDetails['desc'] = $type['desc'];
                $typeDetails['type'] = $type['code'];
                                
                array_push($achievementsResult,$typeDetails); 
            }
            $studentDetails['student_id'] = $student['student_id'];
            $studentDetails['hashedID'] = $this->GetRandom(10).$student['student_id'].$this->GetRandom(10);
            $studentDetails['name'] = $student['student_name'];
            $studentDetails['achievementList'] = $achievementsResult;


            array_push($result,$studentDetails); 
        }

        return response()->json([
            'status' => 200,
            'data' => $result,
            'count' => count($result),
            'message' => 'Successfully saved.'
        ]);
    }

    public function ask_01 (Request $request){
        $data = array(
            'student_id'=>$request->input('studentId')
        );
    }
}
