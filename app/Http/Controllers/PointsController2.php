<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Question;
use App\Category;
use App\Student;
use App\Question_Choices;
use App\Answer;

class PointsController extends Controller
{
    public function index()
    {
    	echo "points here";
    }

    public function getCategories()
    {
        return DB::table('categories')->get();
    }

    public function getQuestions($category_code)
    {
    	return DB::table('questions')->where('category_code', $category_code)->get();
    }

    public function getAnswers($question_code)
    {
    	return DB::table('answers')->get();
    }

    // public function getPoints()
    // {
    // 	foreach($this->getCategories() as $catKey => $category)
    // 	{

    // 		$QuestionList = array();

    // 		$data[$catKey]['category_id'] = $category->category_id;
    // 		$data[$catKey]['category_code'] = $category->category_code;
    // 		$data[$catKey]['description'] = $category->description;
    // 		$data[$catKey]['no_of_questions'] = $this->getQuestions($category->category_code)->count();
    // 		$data[$catKey]['no_answered'] = 0;
    // 		$data[$catKey]['no_unanswered'] = 0;

    // 		foreach ($this->getQuestions($category->category_code) as $questionKey => $question) 
    // 		{
    // 			// echo $questionKey.$question->question_code;
    // 			// $data[$catKey]['no_answered'] = $data[$catKey]['no_answered'] + $this->getAnswers($question->question_code)->groupBy($question->question_code)->where('no_of_questions', '>', 0)->count();

    // 			$data[$catKey]['aaa'] = $this->getAnswers($question->question_code);
    // 		}

    // 		// echo $category->category_code;	
    // 		// foreach ($this->getQuestions($category->category_code) as $questionKey => $question) {
    // 		// 	// $data1[$questionKey]['others'] = $questionKey;
    // 		// 	// $QuestionsData = array(
    // 		// 	// 	'question_code' => $question->question_code
    // 		// 	// );

    // 		// 	// array_push($QuestionList, $QuestionsData);
    // 		// 	$data[$catKey]['no_of_questions'] = 10;
    // 		// }

    // 		// $data[$catKey]['question'] = $QuestionList;
    // 	}

    // 	return $data;

    // }

    public function getWithAnswer(Request $request) 
    {
        $data = array(
            'categoryCode'=>$request->input('categoryCode')
        );

        $result = array();

        $categories = DB::table('categories as c')
            ->leftJoin( DB::raw( "(SELECT q.category_code, COUNT( q.category_code ) as no_of_questions FROM questions as q GROUP BY q.category_code) as q"), 'q.category_code', '=', 'c.category_code' );

        if ($data['categoryCode']) {
            $categories->where('c.category_code',$data['categoryCode']);
        }

        $categories = $categories->get();
        
        $categoriesCopy = json_decode($categories, true);
        foreach ($categoriesCopy as $key => $category) {
            $answers = DB::table('questions as q')
                ->select(
                    DB::raw(' COALESCE(no_answered,0) as no_answered')
                )
                ->leftJoin( DB::raw( '(SELECT question_code, COUNT(question_code) as no_answered from answers group by question_code order by no_answered) as a'), 'a.question_code', '=', 'q.question_code' )
                ->where('q.category_code',$category['category_code'])

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
        

        return $result;
        // return response()->json([
        //     'status' => 200,
        //     'count' => $categories->count(),            
        //     'data' => $result,
        //     'message' => 'Successfully saved.'
        // ]);
    }

    //step 1
    public function median(Request $request)
    {
    	$med_col = array();

    	foreach ($this->getWithAnswer($request) as $key => $datum) 
    	{
    		$no_of_questions = $datum['no_of_questions'];
    		array_push($med_col, $no_of_questions);
    	}

    	//STEP1
    	$median = collect($med_col)->median();

    	$higher = 0;
    	$lower = 0;
    	$status = '';
    	$data = $this->getWithAnswer($request);

    	foreach ($data as $key => $datum) 
    	{
    		if($median>$datum['no_unanswered'])
    		{
    			$higher = $higher + 1;
    			$status = "Higher";
    		}
    		else
    		{
    			$lower = $lower + 1;
    			$status = "Lower";
    		}

    		$data[$key]['status'] = $status; 

    	}

		$lowerPointsDiff = 2/$lower;
    	$higherPointsDiff = 2/$higher;

    	$currentStatus = '';
		$currentValue = 0;
    	foreach ($data as $key => $datum) 
    	{

    		// echo $datum['status'];
    		if($key==0)
    		{
    			if($datum['status'] == 'Higher')
    			{
    				$val = 4;
    			}
    			else
    			{
    				$val = 2;
    			}

    			$currentValue = $val;
    			$currentStatus = $datum['status'];
    			$data[$key]['value'] = $val;
    		}
    		else
    		{
	    		if($currentStatus == $datum['status'])
	    		{
	    			$val = $currentValue;
	    			// $data[$key]['value'] = $val;
	    		}
	    		else
	    		{
	    			if($datum['status'] == 'Higher')
	    			{
	    				$val = $currentValue - $higherPointsDiff;
	    				// $data[$key]['value'] = $val;
	    			}
	    			else
	    			{
	    				if($currentStatus != "Lower")
	    				{
	    					$val = 2;
	    					// $data[$key]['value'] = $val;
	    				}
	    				else
	    				{
	    					$val = $currentValue - $lowerPointsDiff;
	    				}
	    			}
	    		}
				
				$data[$key]['value'] = $val;

	    	}

    		$data[$key]['Identification'] = $val * 0.75;
    		$data[$key]['MultipleChoice'] = $val * 0.75;
    		$data[$key]['Coding'] = $val * 1;

    		$currentStatus = $datum['status']; 
			$currentValue = $val;
    		
    	}

    	return $data;
    }

    public function points_answering(Request $request)
    {
    	$med_col = array();

    	foreach ($this->getWithAnswer($request) as $key => $datum) 
    	{
    		$no_of_questions = $datum['no_of_questions'];
    		array_push($med_col, $no_of_questions);
    	}

    	//STEP1
    	$median = collect($med_col)->median();

    	$higher = 0;
    	$lower = 0;
    	$status = '';
    	$data = $this->getWithAnswer($request);

    	foreach ($data as $key => $datum) 
    	{
    		if($median>$datum['no_unanswered'])
    		{
    			$lower = $lower + 1;
    			$status = "Lower";
    		}
    		else
    		{
    			$higher = $higher + 1;
    			$status = "Higher";
    		}

    		$data[$key]['status'] = $status; 

    	}

		$lowerPointsDiff = 4/$lower;
    	$higherPointsDiff = 4/$higher;

    	$currentStatus = '';
		$currentValue = 0;
    	foreach ($data as $key => $datum) 
    	{

    		// $data[$key]['lowerPointsDiff'] = $lowerPointsDiff;
    		// $data[$key]['higherPointsDiff'] = $higherPointsDiff;
    		
    		// echo $datum['status'];
    		if($key==0)
    		{
    			if($datum['status'] == 'Higher')
    			{
    				$val = 5;
    			}
    			else
    			{
    				$val = 1;
    			}

    			$currentValue = $val;
    			$currentStatus = $datum['status'];
    			$data[$key]['RawPoints'] = $val;
    		}
    		else
    		{
	    		if($currentStatus == $datum['status'])
	    		{
	    			$val = $currentValue;
	    			// $data[$key]['value'] = $val;
	    		}
	    		else
	    		{
	    			if($datum['status'] == 'Lower')
	    			{
	    				$val = $lowerPointsDiff + $currentValue;
	    				// $val = $currentValue - $higherPointsDiff;
	    				// $data[$key]['value'] = $val;
	    			}
	    			else
	    			{
	    				if($currentStatus != "Higher")
	    				{
	    					$val = 5;
	    					// $data[$key]['value'] = $val;
	    				}
	    				else
	    				{
	    					$val = $currentValue + $higherPointsDiff;
	    				}
	    			}
	    		}
				
				$data[$key]['RawPoints'] = $val;

	    	}

    		$data[$key]['Identification'] = $val * 0.75;
    		$data[$key]['MultipleChoice'] = $val * 0.75;
    		$data[$key]['Coding'] = $val * 1;
    		
    		$currentStatus = $datum['status']; 
			$currentValue = $val;
    	
    	}

    	return $data;
    }


    public function sampleArray(Request $request)
    {
    	$dd = $this->median($request);

    	$dd1 = array($dd);
  		
  		// print_r($dd1);

    	foreach ($dd1[0] as $key=> $datum) {
    		 $no_answered[$key] = $datum['no_answered'];
    		 $no_unanswered[$key] = $datum['no_unanswered'];
    		 $category_id[$key] = $datum['category_id'];
    		// echo $datum['no_answered'];
    	}
    	
    	array_multisort($no_unanswered, SORT_ASC, $dd1[0]);


    	// foreach ($dd1[0] as $key=> $datum) {
    	// 	echo "<br>";

    	// 	echo $no_answered[$key] = $datum['no_answered'];
    	// 	echo " | ";
    	// 	echo $no_unanswered[$key] = $datum['no_unanswered'];
    	// 	echo " | ";
    	// 	echo $category_id[$key] = $datum['category_id'];
    	// 	// echo $datum['no_answered'];
    	// }
    	
    	// array_multisort($no_unanswered, SORT_ASC, $dd1[0]);

    	// echo "<br> --------------------------";
    	// foreach ($dd1[0] as $key=> $datum) {
    	// 	echo "<br>";

    	// 	echo $no_answered[$key] = $datum['no_answered'];
    	// 	echo " | ";
    	// 	echo $no_unanswered[$key] = $datum['no_unanswered'];
    	// 	echo " | ";
    	// 	echo $category_id[$key] = $datum['category_id'];
    	// 	// echo $datum['no_answered'];
    	// }

    	// return response()->json([
     //        'data' => $dd1
     //    ]);

    	// $dd1 = json_decode($dd1);
    	return $dd1[0];
    }


    public function ref(Request $request)
    {
    	$dd = $this->median2($request);

    	$dd1 = array($dd);
    	$med_col = array();
  		
  		// print_r($dd1);

    	foreach ($dd1[0] as $key=> $datum) {
    		 $no_answered[$key] = $datum['no_answered'];
    		 $no_unanswered[$key] = $datum['no_unanswered'];
    		 $category_id[$key] = $datum['category_id'];
    		// echo $datum['no_answered'];
    		 $no_of_questions = $datum['no_of_questions'];
    		  
    		 array_push($med_col, $no_of_questions);
    	}
    	
    	array_multisort($no_unanswered, SORT_ASC, $dd1[0]);


    	 

    	//STEP1
    	echo "median = ".$median = collect($med_col)->median();


    	foreach ($dd1[0] as $key=> $datum) {
    		echo "<br>";

    		echo $no_answered[$key] = $datum['no_answered'];
    		echo " | ";
    		echo $no_unanswered[$key] = $datum['no_unanswered'];
    		echo " | ";
    		echo $category_id[$key] = $datum['category_id'];
    		// echo $datum['no_answered'];
    	}
    	
    	array_multisort($no_unanswered, SORT_ASC, $dd1[0]);

    	echo "<br> --------------------------";
    	foreach ($dd1[0] as $key=> $datum) {
    		echo "<br>";
    		echo "answered = ";
    		echo $no_answered[$key] = $datum['no_answered'];

    		echo " | ";
    		echo "unanswered = ";
    		echo $no_unanswered[$key] = $datum['no_unanswered'];
    		echo " | ";
    		echo "category = ";
    		echo $category_id[$key] = $datum['category_id'];
    		echo " | ";
    		echo "status = ";
    		echo $category_id[$key] = $datum['status'];
    		echo " | ";
    		echo "raw points = ";
    		echo $category_id[$key] = $datum['value'];
    	
    		// echo $datum['no_answered'];
    	}
 
    	// return $dd1[0];
    }

    public function ref2(Request $request)
    {
    	$dd = $this->median3($request);

    	$dd1 = array($dd);
    	$med_col = array();
  		
  		// print_r($dd1);

    	foreach ($dd1[0] as $key=> $datum) {
    		 $no_answered[$key] = $datum['no_answered'];
    		 $no_unanswered[$key] = $datum['no_unanswered'];
    		 $category_id[$key] = $datum['category_id'];
    		// echo $datum['no_answered'];
    		 $no_of_questions = $datum['no_of_questions'];
    		  
    		 array_push($med_col, $no_of_questions);
    	}
    	
    	array_multisort($no_unanswered, SORT_ASC, $dd1[0]);


    	 

    	//STEP1
    	echo "median = ".$median = collect($med_col)->median();


    	foreach ($dd1[0] as $key=> $datum) {
    		echo "<br>";
    		echo $no_answered[$key] = $datum['no_answered'];
    		echo " | ";
    		echo $no_unanswered[$key] = $datum['no_unanswered'];
    		echo " | ";
    		echo $category_id[$key] = $datum['category_id'];
    		// echo $datum['no_answered'];
    	}
    	
    	array_multisort($no_unanswered, SORT_ASC, $dd1[0]);

    	echo "<br> --------------------------";
    	foreach ($dd1[0] as $key=> $datum) {
    		echo "<br>";
    		echo "answered = ";
    		echo $no_answered[$key] = $datum['no_answered'];
    		echo " | ";
    		echo "unanswered = ";
    		echo $no_unanswered[$key] = $datum['no_unanswered'];
    		echo " | ";
    		echo "category = ";
    		echo $category_id[$key] = $datum['category_id'];
    		echo " | ";
    		echo "status = ";
    		echo $category_id[$key] = $datum['status'];
    		echo " | ";
    		echo "raw points = ";
    		echo $category_id[$key] = $datum['value'];
    		echo " | ";
    		echo "Identification = ";
    		echo $category_id[$key] = $datum['Identification'];
    		echo " | ";
    		echo "Multiple choice = ";
    		echo $category_id[$key] = $datum['MultipleChoice'];
    		echo " | ";
    		echo "Coding = ";
    		echo $category_id[$key] = $datum['Coding'];
    		// echo $datum['no_answered'];
    	}
    	// return $dd1[0];
    }

    //step 1
    public function median2(Request $request) // for posting
    {
    	$med_col = array();

    	// echo $this->sampleArray($request);

    	foreach ($this->sampleArray($request) as $key => $datum) 
    	{
    		$no_of_questions = $datum['no_of_questions'];
    		array_push($med_col, $no_of_questions);
    	}

    	//STEP1
    	$median = collect($med_col)->median();

    	$higher = 0;
    	$lower = 0;
    	$status = '';
    	$data = $this->sampleArray($request);

    	foreach ($data as $key => $datum) 
    	{
    		if($median>$datum['no_unanswered'])
    		{
    			$higher = $higher + 1;
    			$status = "Higher";
    		}
    		else
    		{
    			$lower = $lower + 1;
    			$status = "Lower";
    		}

    		$data[$key]['status'] = $status; 

    	}

		$lowerPointsDiff = 2/$lower;
    	$higherPointsDiff  = 2/$higher;
    	$currentStatus        = '';
		$currentValue         = 0;
		$unanswered           = '';
    	foreach ($data as $key => $datum) 
    	{

    		

    		// echo $datum['status'];
    		if($key==0)
    		{
    			if($datum['status'] == 'Higher')
    			{
    				$val = 4;
    			}
    			else
    			{
    				$val = 2;
    			}

    			// $currentValue = $val;
    			$currentStatus = $datum['status'];
    			$unanswered = $datum['no_unanswered'];

    			$data[$key]['value'] = $val;
    		}
    		else
    		{
	    		if($unanswered == $datum['no_unanswered'])
	    		{
	    			$val = $currentValue;
	    			// $data[$key]['value'] = $val;
	    		}
	    		else
	    		{
	    			if($datum['status'] == 'Higher')
	    			{
	    				$val = $currentValue - $higherPointsDiff;
	    				// $data[$key]['value'] = $val;
	    			}
	    			else
	    			{
	    				if($currentStatus != "Lower")
	    				{
	    					$val = 2;
	    					// $data[$key]['value'] = $val;
	    				}
	    				else
	    				{
	    					$val = $currentValue - $lowerPointsDiff;
	    				}
	    			}
	    		}
				
				$data[$key]['value'] = $val;

	    	}

    		$data[$key]['Identification'] = $val * 0.75;
    		$data[$key]['MultipleChoice'] = $val * 0.75;
    		$data[$key]['Coding'] = $val * 1;
    		$currentStatus = $datum['status']; 
			$currentValue = $val;
    		
    	}

    	return $data;
    }

    public function median3(Request $request) // points for answering 
    {
    	$med_col = array();

    	foreach ($this->sampleArray($request) as $key => $datum) 
    	{
    		$no_of_questions = $datum['no_of_questions'];
    		array_push($med_col, $no_of_questions);
    	}

    	//STEP1
    	$median = collect($med_col)->median();

    	$higher = 0;
    	$lower = 0;
    	$status = '';
    	$unanswered = '';
    	$data = $this->sampleArray($request);

    	foreach ($data as $key => $datum) 
    	{
    		if($median>$datum['no_unanswered'])
    		{
    			$lower = $lower + 1;
    			$status = "Lower";
    		}
    		else
    		{
    			$higher = $higher + 1;
    			$status = "Higher";
    		}

    		$data[$key]['status'] = $status; 

    	}

		$lowerPointsDiff = 4/$lower;
    	$higherPointsDiff = 4/$higher;

    	$currentStatus = '';
		$currentValue = 0;
    	foreach ($data as $key => $datum) 
    	{

    		// $data[$key]['lowerPointsDiff'] = $lowerPointsDiff;
    		// $data[$key]['higherPointsDiff'] = $higherPointsDiff;
    		
    		// echo $datum['status'];
    		if($key==0)
    		{
    			if($datum['status'] == 'Higher')
    			{
    				$val = 5;
    			}
    			else
    			{
    				$val = 1;
    			}

    			// $currentValue = $val;
    			$currentStatus = $datum['status'];
    			$data[$key]['value'] = $val;
    			$unanswered = $datum['no_unanswered'];
    		}
    		else
    		{
	    		if($unanswered == $datum['no_unanswered'])
	    		{
	    			$val = $currentValue;
	    			// $data[$key]['value'] = $val;
	    		}
	    		else
	    		{
	    			if($datum['status'] == 'Lower')
	    			{
	    				$val = $lowerPointsDiff + $currentValue;
	    				// $val = $currentValue - $higherPointsDiff;
	    				// $data[$key]['value'] = $val;
	    			}
	    			else
	    			{
	    				if($currentStatus != "Higher")
	    				{
	    					$val = 5;
	    					// $data[$key]['value'] = $val;
	    				}
	    				else
	    				{
	    					$val = $currentValue + $higherPointsDiff;
	    				}
	    			}
	    		}
				
				$data[$key]['value'] = $val;

	    	}

    		$data[$key]['Identification'] = $val * 0.75;
    		$data[$key]['MultipleChoice'] = $val * 0.75;
    		$data[$key]['Coding'] = $val * 1;
    		
    		$currentStatus = $datum['status']; 
			$currentValue = $val;
    	}
    	return $data;
    }

}
