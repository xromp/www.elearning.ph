<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

Use DB;
use App\Student;
use App\Questions;

use Hash;
class ProfileController extends Controller
{
    public function index(Request $request)
    {
       echo 'id ='. $request->session()->get('elearning_sess_accountId');
       return view('profile.index');
    }

    public function viewOtherProfile($id)
    {
    	$hashedID = $this->RemoveExtras($id);

    	if(!$hashedID)
    	{
    		$hashedID = session()->get('elearning_sess_accountId');
    	}

    	if(Student::PerStudent($hashedID)->first())
    	{
	    	$student = Student::PerStudent($hashedID)->first();
	    	return view('profile.index');
    	}
    	else
    	{
    		return "Profile Not found!";
    	}
    }

    public function User(Request $request)
    {
    	$id = session()->get('elearning_sess_accountId');
    	$user = Student::PerStudent($id)->first();

    	return response()-> json([
            'status'=>200,
            'data'=>$user,
            'message'=>''
        ]);
    }

    public function OtherUser(Request $request)
    {
    	$hashedID = $request->input('hashedID');
    	$hashedID = $this->RemoveExtras($hashedID);

    	$user = Student::PerStudent($hashedID)->first();

    	return response()-> json([
            'status'=>200,
            'data'=>$user,
            'message'=>''
        ]);
    }

    public function PostedQuestions(Request $request)
    {
    	$hashedID = $request->input('hashedID');
    	$hashedID = $this->RemoveExtras($hashedID);

    	$id = session()->get('elearning_sess_accountId');

    	// if($hashedID == $id)
    	// { 
    	// 	$isSelf = "true"; 
    	// 	$postedQuestions = DB::table('questions as q')
     //        -> select('*')->where('student_id', $id)->get();
    	// }
    	// else
    	// { 
    	// 	$isSelf = "false"; 
    	// 	$postedQuestions = null;
    	// }

        $postedQuestions = DB::table('questions as q')
        -> select('*')->where('student_id', $hashedID)->get();

        return response()-> json([
            'status'=>200,
            'data'=>$postedQuestions,
            // 'isSelf'=>$isSelf,
            'message'=>''
        ]);
    }

    public function sampleCrypt(Request $request, $id)
    {


    	// $id = $request->input('id');

    	// return bcrypt($id);

    	// $id = bcrypt($id);

    	$id_len = strlen($id);


    	// return str_random(40);
    	// $s
    	// return str_pad($id, 5, )
    	// $myStr = "erikson b supnet ";
    	// return strlen($myStr);
    	// return $result = substr($myStr, 5, );

  //   	if(Hash::check("1", $id)) {
		//     return "true";
		// }
		// else
		// {
		// 	return "false";
		// }
		$random1 = $this->GetRandom(10);
		$random2 = $this->GetRandom(10);
    	$data =  $random1.$id.$random2;

    	 // $f1 = substr($data, 10);
    	 // return $data;
    	// return $f2 = substr($f1, 0, -10);
    	// return substr($data, , );

    	return bcrypt('rom');
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
