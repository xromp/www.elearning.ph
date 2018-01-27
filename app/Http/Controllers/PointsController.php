<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Question;
use App\Category;
use App\Student;
use App\Question_Choices;
use App\Answer;

use App\Traits\PointsTrait;
use App\Traits\AchievementsTrait;

class PointsController extends Controller
{

	use PointsTrait;
    use AchievementsTrait;   
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
                ->where('q.is_approved', 1)

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
    }

    public function sortUnanswered(Request $request)
    {
    	$data = array($this->getWithAnswer($request));

    	foreach ($data[0] as $key=> $datum) {
    		 $no_answered[$key] = $datum['no_answered'];
    		 $no_unanswered[$key] = $datum['no_unanswered'];
    		 $category_id[$key] = $datum['category_id'];
    	}
    	
    	array_multisort($no_unanswered, SORT_ASC, $data[0]);

    	return $data[0];
    }

     //STEP1
    public function GetMedian(Request $request)
    {
    	$med_col = array();

    	foreach ($this->sortUnanswered($request) as $key => $datum) 
    	{
    		$no_of_questions = $datum['no_of_questions'];
    		array_push($med_col, $no_of_questions);
    	}

    	return $median = collect($med_col)->median();
    }

    public function GetCountStudent(Request $request)
    {
    	$med_col = array();

    	foreach ($this->sortUnanswered($request) as $key => $datum) 
    	{
    		$no_of_questions = $datum['no_of_questions'];
    		array_push($med_col, $no_of_questions);
    	}

    	return $median = collect($med_col)->median();
    }



    public function PointsPosting(Request $request) // for posting
    {
    	$median = $this->GetMedian($request);

    	$higher = 0;
    	$lower = 0;
    	$status = '';
    	$data = $this->sortUnanswered($request);

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

		if($lower == 0){
            $lower = 0;
        }
        else
        {
            $lowerPointsDiff = 2/$lower;
        }

        if($higher == 0){
            $higher = 0;
        }
        else
        {
            $higherPointsDiff = 2/$higher;
        }

    	$currentStatus = '';
		$currentValue = 0;
		$unanswered = '';
		$val = 0;

    	foreach ($data as $key => $datum) 
    	{
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
    			// $currentValue = $val;
    		}
    		else
    		{
	    		if($unanswered == $datum['no_unanswered'])
	    		{
	    			$val = $currentValue;
	    			$unanswered = $datum['no_unanswered'];
	    		}
	    		else
	    		{
	    			// $val = "not equal";
	    			if($datum['status'] == 'Higher')
	    			{
	    				$unanswered = $datum['no_unanswered'];
	    				// $val = "higher-erik";
	    				$val = $currentValue - $higherPointsDiff;
	    			}
	    			else
	    			{
	    				if($currentStatus != "Lower")
	    				{
	    					$unanswered = $datum['no_unanswered'];
	    					$val = 2;
	    				}
	    				else 
	    				{
	    					$unanswered = $datum['no_unanswered'];
	    					// $val ="lower-erik";
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
    		$data[$key]['val'] = $val;

    		
    	}

    	return $data;
    }

   

    public function PointsAnswering(Request $request) // points for answering 
    {

    	$median = $this->GetMedian($request);

    	$higher = 0;
    	$lower = 0;
    	$status = '';
    	$unanswered = '';
    	$data = $this->sortUnanswered($request);

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

		 if($lower == 0){
            $lower = 0;
        }
        else
        {
            $lowerPointsDiff = 4/$lower;
        }

        if($higher == 0){
            $higher = 0;
        }
        else
        {
            $higherPointsDiff = 4/$higher;
        }


    	$currentStatus = '';
		$currentValue = 0;

    	foreach ($data as $key => $datum) 
    	{

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

    			$currentStatus = $datum['status'];
    			$data[$key]['value'] = $val;
    			$unanswered = $datum['no_unanswered'];
    		}
    		else
    		{
	    		if($unanswered == $datum['no_unanswered'])
	    		{
	    			$unanswered = $datum['no_unanswered'];
	    			$val = $currentValue;
	    		}
	    		else
	    		{
	    			if($datum['status'] == 'Lower')
	    			{
	    				$unanswered = $datum['no_unanswered'];
	    				$val = $lowerPointsDiff + $currentValue;
	    			}
	    			else
	    			{
	    				if($currentStatus != "Higher")
	    				{
	    					$unanswered = $datum['no_unanswered'];
	    					$val = 5;
	    				}
	    				else
	    				{
	    					$unanswered = $datum['no_unanswered'];
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


    public function GetPoints(Request $request, $action, $questionType, $categoryType)
    {
    	if($action === "answer")
    	{
    		$data = $this->PointsAnswering($request);
    	}
    	elseif($action === "post")
    	{
    		$data = $this->PointsPosting($request);
    	}
    	else
    	{
    		echo "Invalid type of action!";	
    	}
    	
    	$points = 0;
    	foreach ($data as $key => $datum) 
    	{
    		$category_id =  $datum['category_id'];
    		$Identification =  $datum['Identification'];
    		$MultipleChoice =  $datum['MultipleChoice'];
    		$Coding =  $datum['Coding'];
    		$value =  $datum['value'];

    		if($category_id == $categoryType)
    		{
    			if($questionType === "Identification")
    			{
    				$points = $Identification;
    			}
    			elseif($questionType === "MultipleChoice")
    			{
    				$points = $MultipleChoice;
    			}
    			elseif($questionType === "Coding")
    			{
    				$points = $Coding;
    			}
    			else
    			{
    				echo "Invalid type of question!";

    			}
    			// elseif($questionType == $Identification)
    		}
    	}
    	return $points;
    }
 

	public function getTotalPointsByCategory(Request $request)
    {
        $data = array(
			'category_code'=>$request->input('categoryCode'),
			'student_id'=>$request->input('studentId'),
        );

        return response()->json([
            'status' => 200,
            'data' => $this->getTotalPointPerCategory($data),
            'message' => 'Successfully saved.'
        ]);
    }
}
