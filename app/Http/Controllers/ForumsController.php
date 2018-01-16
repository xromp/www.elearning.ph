<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Student;

class ForumsController extends Controller
{
    public function Index()
    {
    	// echo "forum index";
    	return view('forum.index');
    	
    }

    public function Forums()
    {
    	$id = session()->get('student_id');
    	$forums = DB::table('forums')->where('student_id', $id)->get();

    	foreach($forums as $forum)
    	{
    		$ForumCode = $forum->forum_code;
    		$forum->comments = $this->Comments($ForumCode);
    	}

    	return response()->json([
            'status' => 200,
            'data' => $forums,
            'message' => 'Successfully loaded.'
        ]);
    }

    public function Comments($forumCode)
    {
    	$id = session()->get('student_id');
    	$comments = DB::table('comments')->where('forum_code', $forumCode)->get();
    	return $comments;
    }

}