<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use DB;

use App\Question;
use App\Category;
use App\Student;
use App\Question_Choices;
use App\Answer;

// use App\Collection_line;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('stock-market.index');
    }

    public function get(Request $request)
    {
        $data = array(
            'categoryCode'=>$request->input('categoryCode')
        );

        $categories = DB::table('categories');
        
        if ($data['categoryCode']) {
            $categories->where('category_code',$data['categoryCode']);
        }
        $categories = $categories->get();

        return response()->json([
            'status' => 200,
            'data' => $categories,
            'count' => $categories->count(),
            'message' => 'Successfully saved.'
        ]);
    }

    public function getWithAnswer(Request $request) 
    {
        $data = array(
            'categoryCode'=>$request->input('categoryCode')
        );

        $result = array();

        $categories = DB::table('categories as c')
            ->select('c.category_code','c.description')
            ->leftJoin( DB::raw( "(SELECT q.category_code, COUNT( q.category_code ) as no_of_questions FROM questions as q GROUP BY q.category_code) as q"), 'q.category_code', '=', 'c.category_code' );

        if ($data['categoryCode']) {
            $categories->where('c.category_code',$data['categoryCode']);
        }
        // dd($categories->get());
        $categories = $categories->get();
        
        $categoriesCopy = json_decode($categories, true);
        foreach ($categoriesCopy as $key => $category) {
            $answers = DB::table('questions as q')
                ->select(
                    DB::raw(' COALESCE(no_answered,0) as no_answered')
                )
                ->leftJoin( DB::raw( '(SELECT question_code,COUNT(question_code) as no_answered from answers group by question_code) as a'), 'a.question_code', '=', 'q.question_code' )
                ->where('q.category_code',$category['category_code'])
                ->where('q.is_approved',1)
                ->get();
                
            $noAnswered = $answers->where('no_answered','>','0')
                ->count();
            
            $noUnanswered = $answers->where('no_answered',0)
                ->count();
            
            $data = $category;
            // $data['answers'] = $answers;
            $data['no_answered'] = $noAnswered;
            $data['no_unanswered'] = $noUnanswered;

            array_push($result,$data);
        }
        

        return response()->json([
            'status' => 200,
            'count' => $categories->count(),            
            'data' => $result,
            'message' => 'Successfully saved.'
        ]);
    }
}
