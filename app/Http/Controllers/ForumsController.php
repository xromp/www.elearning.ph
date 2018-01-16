<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ForumsController extends Controller
{
    public function Index()
    {
    	// echo "forum index";
    	return view('forum.index');
    }

    public function get(Request $request)
    {
        $data = array(
            'typeCode'=>$request->input('typeCode')
        );
        /******
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

         * 
         * 
         * 
         */
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
            -> leftjoin('students as s','s.student_id','=','f.student_id')
            ->get();
    
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
            
            $value['comments']['list'] = $comments;
            $value['comments']['count'] = $value['comment_count'];
            array_push($result,$value);
        }
        
        if ($data['typeCode']) {
            $types->where('type_code',$data['typeCode']);
        }

        return response()->json([
            'status' => 200,
            'data' => $result,
            // 'count' => $result->count(),
            'message' => ''
        ]);
    }
}
