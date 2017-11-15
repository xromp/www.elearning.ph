<?php 

namespace App\Traits;

use DB;

use App\Student;
use App\Question;
use App\Question_Choices;
use App\Answer;
use App\Category;

trait AchievementsTrait
{
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
}