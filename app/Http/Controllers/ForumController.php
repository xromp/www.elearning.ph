<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;

use App\Student;
use App\Forum;
use App\Comment;
use App\Traits\AchievementsTrait;

class ForumController extends Controller
{
    use AchievementsTrait;
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
 
    public function get(Request $request) {
        $data = array(
            'forum_id'=>$request->input('forumId')
        );

        $result = array();
        $forums = DB::table('forums as f')
            -> select(
                'f.forum_id',
                'description',
                'title',
                'f.student_id',
                DB::raw('concat(s.lName,",", s.fName," ", s.mName) as student_name'),
                'c.comment_count',
                'f.updated_at'
            )
            -> leftJoin( DB::raw( "(SELECT c.forum_id, COUNT( c.forum_id ) as comment_count FROM forums_comments as c GROUP BY c.forum_id) as c"), 'c.forum_id', '=', 'f.forum_id' )
            -> leftjoin('students as s','s.student_id','=','f.student_id');
        
        if(!$this->isEmpty($data['forum_id'])){
            $forums = $forums->where('f.forum_id',$data['forum_id']);
        }
        $forums = $forums->get();

        $forumsCopy = json_decode($forums, true);
        foreach ($forumsCopy as $key => $value) {
            $comments = DB::table('forums_comments as c')
                -> select(
                    'forum_comment_id',
                    'c.student_id',
                    'comment',
                    'c.updated_at',
                    DB::raw('concat(s.lName,",", s.fName," ", s.mName) as student_name')
                )
                -> leftjoin('students as s','s.student_id','=','c.student_id')
                ->where('forum_id',$value['forum_id'])
                ->get();
            
            $value['comments'] = $comments;
            $value['comments_count'] = $value['comment_count'];
            array_push($result,$value);
        }
        
        // if ($data['typeCode']) {
        //     $types->where('type_code',$data['typeCode']);
        // }

        return response()->json([
            'status' => 200,
            'data' => $result,
            // 'count' => $result->count(),
            'message' => ''
        ]);
    }

    public function save(Request $request){
        {
            $validator = Validator::make($request->all(),[
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
            $self = $request->session()->get('student_id');
            
            $data = array();
            $data['title'] = $request-> input('title');
            $data['description'] = $request-> input('description');
            $data['student_id'] = $self;
            

            $transaction = DB::transaction(function($data) use($data){
                $forum = new Forum;
                $forum->title = $data['title'];
                $forum->description = $data['description'];
                $forum->student_id = $data['student_id'];

                $forum->save();

                return response()->json([
                    'status' => 200,
                    'data' => 'null',
                    'message' => 'Successfully saved.'
                ]);
            });
    
            return $transaction;
        }   
    }

    public function saveComment(Request $request){
        {
            $validator = Validator::make($request->all(),[
                'comment'=> 'required',
                'forumId'=> 'required'
            ]);
    
            if ($validator-> fails()) {
                return response()->json([
                    'status'=> 403,
                    'data'=>'',
                    'message'=>'Unable to save.'
                ]);
            }
            $self = $request->session()->get('student_id');
            
            $data = array();
            $data['comment'] = $request-> input('comment');
            $data['forum_id'] = $request-> input('forumId');
            $data['student_id'] = $self;
            

            $transaction = DB::transaction(function($data) use($data){
                $comment = new Comment;
                $comment->forum_id = $data['forum_id'];
                $comment->student_id = $data['student_id'];
                $comment->comment = $data['comment'];

                $comment->save();

                return response()->json([
                    'status' => 200,
                    'data' => 'null',
                    'message' => 'Successfully saved.'
                ]);
            });
    
            return $transaction;
        }   
    }
} 
//     public function Comments($forumCode)
//     {
//     	$id = session()->get('student_id');
//     	$comments = DB::table('comments')->where('forum_code', $forumCode)->get();
//     	return $comments;
//     }

// } 
