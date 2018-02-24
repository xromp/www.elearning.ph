<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Account;
use App\Student;

use Hash;

class AccountController extends Controller
{
	// public function __construct(Request $request)
 //    {
 //    	if(!$request->session()->get('elearning_sess_accountId'))
 //    	{
	// 		return redirect('login');
 //    	}
 //    }

    public function index(Request $request)
    {
      if($request->session()->get('email'))
      {
        return redirect('question/view');
      }
      else
      {
    	 return view('login');
      }
    }

  //   public function auth(Request $request)
  //   {
  //   	$email = $request->input('uname');
  //   	$pword = $request->input('pword');

  //   	$account = new Account;
  //   	$accountData = $account->auth($email, $pword);

		// if($accountData)
  //   	{
  //   		$student = Student::where('student_id', $accountData->account_id)->first();
		// 	$request->session()->put('elearning_sess_accountId', $accountData->account_id);
		// 	$request->session()->put('student_id', $accountData->account_id);
  //   		$request->session()->put('email', $email);
  //   		$request->session()->put('fullname', $student->lName.', '.$student->fName.''.$student->mName);
  //   		return redirect('question/view');
  //   	}
  //   	else
  //   	{
		// 	return redirect('login')->with('status', 'Login failed; Invalid email or password');
  //   	}
  //   }

    public function GetRandom($keyLength)
    {
        return str_random($keyLength);
    }

    public function auth(Request $request)
    {

    	$email = $request->input('uname');
    	$pword = $request->input('pword');

    	$account = new Account;
    	$accountData = $account->auth($email);

	   	if($accountData)
    	{
    		if(Hash::check($pword, $accountData->pword)) {
		        $student = Student::where('student_id', $accountData->account_id)->first();
				    $request->session()->put('elearning_sess_accountId', $accountData->account_id);
				    $request->session()->put('student_id', $accountData->account_id);
            $request->session()->put('email', $email);
            $request->session()->put('account_type', $accountData->accountTypeID);
            $request->session()->put('fullname', $student->lName.', '.$student->fName.' '.$student->mName);
	    		  $request->session()->put('hashedID', $this->GetRandom(10).$student['student_id'].$this->GetRandom(10));
            
	    		return redirect('question/view');
		    }
		    else
		    {
		    	return redirect('login')->with('status', 'Login failed; Invalid email or password');
		    }    		
    	}
    	else
    	{
			return redirect('login')->with('status', 'Login failed; Invalid email or password');
    	}
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('login');
    }

    public function store(Request $request)
    {
        // $avoCareer = new AvoCareer;  
        // $avoCareer->resume_link  = $request->resume_link;
        // $avoCareer->save();
        // $fileName = $avoCareer->id . '.' .
        $filename = $request->session()->get('elearning_sess_email');
      	echo "extension = ".  $request->file('resume_link')->getClientOriginalExtension();
        $request->file('resume_link')->move(base_path() . '/public/uploads/profile', $filename.".png");
        // $avoCareer->resume_link  = $fileName;
        // return redirect('careers');
    }

    public function bcrypt(){
        echo bcrypt('123');
    }
}
