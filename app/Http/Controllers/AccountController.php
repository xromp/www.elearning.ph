<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Account;
use App\Student;

class AccountController extends Controller
{
	// public function __construct(Request $request)
 //    {
 //    	if(!$request->session()->get('elearning_sess_accountId'))
 //    	{
	// 		return redirect('login');
 //    	}
 //    }

    public function index()
    {
    	return view('login');
    }

    public function auth(Request $request)
    {
    	$email = $request->input('uname');
    	$pword = $request->input('pword');

    	$account = new Account;
    	$accountData = $account->auth($email, $pword);

		if($accountData)
    	{
    		$student = Student::where('student_id', $accountData->account_id)->first();
			$request->session()->put('elearning_sess_accountId', $accountData->account_id);
			$request->session()->put('student_id', $accountData->account_id);
    		$request->session()->put('email', $email);
    		$request->session()->put('fullname', $student->lName.', '.$student->fName.''.$student->mName);
    		return redirect('question/view');
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

}
