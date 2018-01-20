<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Traits\AchievementsTrait;
use DB;
use App\Student;
class LeaderboardController extends Controller
{

	use AchievementsTrait; // inherit function from achievements trait

   	public function Index()
   	{
   		return view('leaderboard.index');
   	}

   	public function Find(Request $request) //get top 3 scorers
   	{
   		$fName = $request->input('fName');

   		$students = DB::table('students')->where('fName', 'like', '%'.$fName.'%')->get();

   		if($students->count()>0)
   		{
	        foreach($students as $key=>$student)
	        {
	            $data[$key]['student_id'] = $student->student_id;
	            $data[$key]['fName'] = $student->fName;
	            $data[$key]['mName'] = $student->mName;
	            $data[$key]['lName'] = $student->lName;
	            $data[$key]['name'] = $student->lName.", ".$student->fName." ".$student->mName;
	            $data[$key]['hashedID'] = $this->GetRandom(10).$student->student_id.$this->GetRandom(10);
	            $data[$key]['achievements'] = $this->Achievements($data[$key]['hashedID']);
	        }
   		}
   		else
   		{
   			$data = null;
   		}

        return response()->json([
            'status' => 200,
            'data' => $data,
            'message' => 'Successfully loaded.'
        ]);
   	}

   	public function Users()
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
            $data[$key]['achievements'] = $this->Achievements($data[$key]['hashedID']);
        }

        return response()->json([
            'status' => 200,
            'data' => $data,
            'message' => 'Successfully loaded.'
        ]);
   	}

   	public function LeaderBoard() //get top 3 scorers
   	{
   		$students = DB::table('students')->limit(3)->get();

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


   	public function Achievements($hashedID)
    {
        // $hashedID = $request->input('hashedID');
     //    $hashedID = $this->RemoveExtras($hashedID);

     //    // $hashedID = 1;

    	// $achievements = array();

    	// if($this->FirstQuestion($hashedID))
    	// {
    	// 	array_push($achievements, $this->FirstQuestion($hashedID));
    	// }

    	// if($this->FirstAnswer($hashedID))
    	// {
    	// 	array_push($achievements, $this->FirstAnswer($hashedID));
    	// }

     //    if($this->Forum($hashedID))
     //    {
     //        array_push($achievements, $this->Forum($hashedID));
     //    }

     //    return $achievements;

        // return response()-> json([
        //     'status'=>200,
        //     'data'=>$achievements,
        //     'message'=>''
        // ]);
    }

   	public function GetRandom($keyLength)
    {
    	return str_random($keyLength);
    }

    public function RemoveExtras($hashed)
    {
    	$data = substr($hashed, 10);
    	return substr($data, 0, -10);
    }

}
