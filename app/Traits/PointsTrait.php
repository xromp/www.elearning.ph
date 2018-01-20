<?php

namespace App\Traits;

use Illuminate\Http\Request;
use DB;

use App\Question;
use App\Category;
use App\Student;
use App\Question_Choices;
use App\Answer;

trait PointsTrait
{
   
    public function getWithAnswer() 
    {
        $result = array();
        $categories = DB::table('categories as c')
            ->leftJoin( DB::raw( "(SELECT q.category_code, COUNT( q.category_code ) as no_of_questions FROM questions as q GROUP BY q.category_code) as q"), 'q.category_code', '=', 'c.category_code' );
 

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
    }

    public function sortUnanswered()
    {
    	$data = array($this->getWithAnswer());

    	foreach ($data[0] as $key=> $datum) {
    		 $no_answered[$key] = $datum['no_answered'];
    		 $no_unanswered[$key] = $datum['no_unanswered'];
    		 $category_id[$key] = $datum['category_id'];
    	}
    	
    	array_multisort($no_unanswered, SORT_ASC, $data[0]);

    	return $data[0];
    }

     //STEP1
    public function GetMedian()
    {
    	$med_col = array();

    	foreach ($this->sortUnanswered() as $key => $datum) 
    	{
    		$no_of_questions = $datum['no_of_questions'];
    		array_push($med_col, $no_of_questions);
    	}

    	return $median = collect($med_col)->median();
    }

    public function PointsPosting() // for posting
    {
    	$median = $this->GetMedian();

    	$higher = 0;
    	$lower = 0;
    	$status = '';
    	$data = $this->sortUnanswered();

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
		$unanswered = '';

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
	    			if($datum['status'] == 'Higher')
	    			{
						$val = $currentValue - $higherPointsDiff;
						$unanswered = $datum['no_unanswered'];
	    			}
	    			else
	    			{
	    				if($currentStatus != "Lower")
	    				{
							$val = 2;
							$unanswered = $datum['no_unanswered'];
	    				}
	    				else
	    				{
							$val = $currentValue - $lowerPointsDiff;
							$unanswered = $datum['no_unanswered'];
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

   

    public function PointsAnswering() // points for answering 
    {

    	$median = $this->GetMedian();

    	$higher = 0;
    	$lower = 0;
    	$status = '';
    	$unanswered = '';
    	$data = $this->sortUnanswered();

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
					$val = $currentValue;
					$unanswered = $datum['no_unanswered'];
	    		}
	    		else
	    		{
	    			if($datum['status'] == 'Lower')
	    			{
						$val = $lowerPointsDiff + $currentValue;
						$unanswered = $datum['no_unanswered'];
	    			}
	    			else
	    			{
	    				if($currentStatus != "Higher")
	    				{
							$val = 5;
							$unanswered = $datum['no_unanswered'];
	    				}
	    				else
	    				{
							$val = $currentValue + $higherPointsDiff;
							$unanswered = $datum['no_unanswered'];
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


    public function GetPoints($action, $questionType, $categoryType)
    {
		// dd($data);
    	if($action === "answer")
    	{
    		$data = $this->PointsAnswering();
    	}
    	elseif($action === "post")
    	{
    		$data = $this->PointsPosting();
    	}
    	else
    	{
    		echo "Invalid type of action!";	
    	}
    	
    	$points = 0;
    	foreach ($data as $key => $datum) 
    	{
    		$category_code =  $datum['category_code'];
    		$Identification =  $datum['Identification'];
    		$MultipleChoice =  $datum['MultipleChoice'];
    		$Coding =  $datum['Coding'];
    		$value =  $datum['value'];

    		if($category_code == $categoryType)
    		{
    			if($questionType === "IDENTIFICATION")
    			{
    				$points = $Identification;
    			}
    			elseif($questionType === "MULTIPLE_CHOICE")
    			{
    				$points = $MultipleChoice;
    			}
    			elseif($questionType === "CODING")
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
	
	// public function studentRanking($data){	
	// 	$result = $array();
	// 	$studentAnswer = DB::table('answers as a')
	// 		->where ('question_code',$data['question_code'])
	// 		->get();

	// 	$student = DB::table('students')
	// 		->count();
	// 	$result['student_count'] = $student->count()+1;
	// 	$result['student_rank'] = $studentAnswer->count();
		
	// 	return $result;
	
	// }

	public function getPointsAnswerPerStudent($data) {
		$students = array();

		$studentAnswer = DB::table('answers as a')
			->where ('question_code',$data['question_code']);

		$students['student_count'] = DB::table('students')->count();
		$students['student_rank'] = $studentAnswer->count();
		
		$x = $this->GetPoints('answer',$data['type_code'],$data['category_code']);
		$i = ($students['student_count'] - $students['student_rank']) / $students['student_count'];
		$points = $x * $i;
		return ($points) > 8 ? 8 : $points;
	}

}
