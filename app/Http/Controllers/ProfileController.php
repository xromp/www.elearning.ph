<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
class ProfileController extends Controller
{
    public function index(Request $request)
    {
       echo 'id ='. $request->session()->get('elearning_sess_accountId');
       return view('profile.index', ['name'=> "asdf"]);
    }

    public function viewOtherProfile($id)
    {
    	// echo "this is id = ".$id;

    	$student = Student::PerStudent($id)->first();
    	echo "name =".$name = $student->fName;
    	return view('profile.index')->with('student', $student);
    	// return $student;
    }


}
