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

class TypeController extends Controller
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
            'typeCode'=>$request->input('typeCode')
        );

        $types = DB::table('types');
        
        if ($data['typeCode']) {
            $types->where('type_code',$data['typeCode']);
        }
        $types = $types->get();

        return response()->json([
            'status' => 200,
            'data' => $types,
            'count' => $types->count(),
            'message' => 'Successfully saved.'
        ]);
    }
    public function isEmpty($question)
    {
        return (!isset($question) || trim($question)===''|| $question ==='undefined');
    }
}
