<?php 

namespace App\Traits;

use DB;

use App\Student;
use App\Question;
use App\Question_Choices;
use App\Answer;
use App\Category;
use App\Achievements;

trait AchievementsTrait
{	
	public function isEmpty($question){
        return (!isset($question) || trim($question)===''|| $question ==='undefined');
	}
	
    public function isAchivementExists($formData) {
        $isExists = DB::table('achievements as a')
            -> where('achievement_code',$formData['code'])
            -> where('student_id',$formData['student_id'])
            -> count();
        
        return ($isExists >= 1);
    }
    // ANSWER Achievements
    public function isFirstAnswer($data) {

        if ($this->isEmpty($data['student_id'])) {
            return 'No student_id supplied';
        }
        
        $answers_count = DB::table('answers as a')
            -> where('student_id',$data['student_id'])
            -> count();
        
        $isFirstAnswer = ($answers_count == 1);

        if ($isFirstAnswer){
            $transaction = DB::transaction(function($data) use($data) {
                
                $formData = array (
                    'code'=> 'ANS-02',
                    'student_id'=>$data['student_id']

                );

                if ($this->isAchivementExists($formData)){
                    return response()->json([
                        'status'=> 200,
                        'data'=>'',
                        'message'=>'Achievement Code '.$formData['code'].' has already exists.'
                    ]);   
                }

                $achivements = new Achievements;
                $achivements->achievement_code = $formData['code'];
                $achivements->student_id = $data['student_id'];
                $achivements->is_achieved = true;

                $achivements->save();

                $this->onLoadAchieved($data);
    
                if ($achivements->id){
    
                    return response()->json([
                        'status'=> 200,
                        'data'=>'',
                        'message'=>'Sucessfully saved.'
                    ]);    
                } else {
                    throw new \Exception("Error Processing Request");
                }
            });
            return $transaction;
        }
	}
	
	public function isFirstCorrectAnswer($data) {

        if ($this->isEmpty($data['student_id'])) {
            return 'No student_id supplied';
        }
        
        $answers_count = DB::table('answers as a')
			-> where('student_id',$data['student_id'])
			-> where('is_correct',true)
            -> count();
        
        $isFirstAnswer = ($answers_count == 1);

        if ($isFirstAnswer){
            $transaction = DB::transaction(function($data) use($data) {
                
                $formData = array (
                    'code'=> 'ANS-03',
                    'student_id'=>$data['student_id']

                );

                if ($this->isAchivementExists($formData)){
                    return response()->json([
                        'status'=> 200,
                        'data'=>'',
                        'message'=>'Achievement Code '.$formData['code'].' has already exists.'
                    ]);   
                }

                $achivements = new Achievements;
                $achivements->achievement_code = $formData['code'];
                $achivements->student_id = $data['student_id'];
                $achivements->is_achieved = true;

                $achivements->save();
                $this->onLoadAchieved($data);
    
                if ($achivements->id){
    
                    return response()->json([
                        'status'=> 200,
                        'data'=>'',
                        'message'=>'Sucessfully saved.'
                    ]);    
                } else {
                    throw new \Exception("Error Processing Request");
                }
            });
            return $transaction;
        }
	}
	
	public function isFirst5Rated($data) {
        
		$answers = DB::table('questions as q')
			->leftJoin( DB::raw( 
				"(SELECT answers.question_code, answers.rating FROM answers WHERE answers.rating = 5) as a"), 
                'q.question_code', '=', 'a.question_code' )
            ->where('q.question_code',$data['question_code']);
        
        $answers_count = $answers-> count();
        $answers_det = $answers-> first();

        $isFirstAnswer = ($answers_count == 1);

        if ($isFirstAnswer){
            $data['student_id'] = $answers_det->student_id;

            $transaction = DB::transaction(function($data) use($data) {
                
                $formData = array (
                    'code'=> 'ARQ-01',
                    'student_id'=>$data['student_id']

                );

                if ($this->isAchivementExists($formData)){
                    return response()->json([
                        'status'=> 200,
                        'data'=>'',
                        'message'=>'Achievement Code '.$formData['code'].' has already exists.'
                    ]);   
                }

                $achivements = new Achievements;
                $achivements->achievement_code = $formData['code'];
                $achivements->student_id = $formData['student_id'];
                $achivements->is_achieved = true;

                $achivements->save();
                $this->onLoadAchieved($data);

                if ($achivements->id){
    
                    return response()->json([
                        'status'=> 200,
                        'data'=>'',
                        'message'=>'Sucessfully saved.'
                    ]);    
                } else {
                    throw new \Exception("Error Processing Request");
                }
            });
            return $transaction;
        }
	}

	public function isFirstRated($data) {
        
		$answers = DB::table('questions as q')
			->leftJoin( DB::raw( 
				"(SELECT answers.question_code, answers.rating FROM answers WHERE rating <> '') as a"), 
                'q.question_code', '=', 'a.question_code' )
            ->where('q.question_code',$data['question_code']);
        
        $answers_count = $answers-> count();
        $answers_det = $answers-> first();

        $isFirstAnswer = ($answers_count == 1);
        if ($isFirstAnswer){
            $data['student_id'] = $answers_det->student_id;

            $transaction = DB::transaction(function($data) use($data) {
                
                $formData = array (
                    'code'=> 'ARQ-02',
                    'student_id'=>$data['student_id']

                );

                if ($this->isAchivementExists($formData)){
                    return response()->json([
                        'status'=> 200,
                        'data'=>'',
                        'message'=>'Achievement Code '.$formData['code'].' has already exists.'
                    ]);   
                }

                $achivements = new Achievements;
                $achivements->achievement_code = $formData['code'];
                $achivements->student_id = $formData['student_id'];
                $achivements->is_achieved = true;

                $achivements->save();
                $this->onLoadAchieved($data);
    
                if ($achivements->id){
    
                    return response()->json([
                        'status'=> 200,
                        'data'=>'',
                        'message'=>'Sucessfully saved.'
                    ]);    
                } else {
                    throw new \Exception("Error Processing Request");
                }
            });
            return $transaction;
        }
    }

    public function isMasterAchievedByCategory($data) {
        if ($this->getTotalPointPerCategory($data)['total_points'] >= 12) {
            $achievedCode = DB::table('rewards as r')
                ->where('entity1',$data['category_code'])
                ->first();
            
            $data['code'] = $achievedCode->achievement_code;

            $transaction = DB::transaction(function($data) use($data) {
            
                $formData = array (
                    'code'=> $data['code'],
                    'student_id'=>$data['student_id']
    
                );
    
                if ($this->isAchivementExists($formData)){
                    return response()->json([
                        'status'=> 200,
                        'data'=>'',
                        'message'=>'Achievement Code '.$formData['code'].' has already exists.'
                    ]);   
                }
    
                $achivements = new Achievements;
                $achivements->achievement_code = $formData['code'];
                $achivements->student_id = $formData['student_id'];
                $achivements->is_achieved = true;
    
                $achivements->save();
                $this->onLoadAchieved($data);
    
                if ($achivements->id){
    
                    return response()->json([
                        'status'=> 200,
                        'data'=>'',
                        'message'=>'Sucessfully saved.'
                    ]);    
                } else {
                    throw new \Exception("Error Processing Request");
                }
            });
            return $transaction;
        }

    }

    public function isMasterAllCategory($data){
        
        $unAchievedCount = DB::table('achievements as a')
            -> LEFTJOIN( DB::raw( "(SELECT rewards.achievement_code, rewards.active, entity2 FROM rewards
                WHERE entity2 = 'CATEGORYGROUP' AND
                active = 1
                GROUP BY achievement_code, active, entity2) as r"), 
                'a.achievement_code', '=', 'r.achievement_code' )
            -> WHERE('a.is_achieved',false)
            -> WHERE('a.student_id',$data['student_id'])
            -> count();
        
        if ($unAchievedCount > 1) {
            $transaction = DB::transaction(function($data) use($data) {
                
                $formData = array (
                    'code'=> 'PTP-01',
                    'student_id'=>$data['student_id']

                );

                if ($this->isAchivementExists($formData)){
                    return response()->json([
                        'status'=> 200,
                        'data'=>'',
                        'message'=>'Achievement Code '.$formData['code'].' has already exists.'
                    ]);   
                }

                $achivements = new Achievements;
                $achivements->achievement_code = $formData['code'];
                $achivements->student_id = $formData['student_id'];
                $achivements->is_achieved = true;

                $achivements->save();
                $this->onLoadAchieved($data);
    
                if ($achivements->id){
    
                    return response()->json([
                        'status'=> 200,
                        'data'=>'',
                        'message'=>'Sucessfully saved.'
                    ]);    
                } else {
                    throw new \Exception("Error Processing Request");
                }
            });
            return $transaction;
        }
    }

    public function isFirstAchievement($data) {
        
        $achievements_count = DB::table('achievements as a')
            ->where('student_id',$data['student_id'])
            ->count();

        $isFirstAnswer = ($achievements_count == 1);

        if ($isFirstAnswer){

            $transaction = DB::transaction(function($data) use($data) {
                
                $formData = array (
                    'code'=> 'FNA-01',
                    'student_id'=>$data['student_id']

                );

                if ($this->isAchivementExists($formData)){
                    return response()->json([
                        'status'=> 200,
                        'data'=>'',
                        'message'=>'Achievement Code '.$formData['code'].' has already exists.'
                    ]);   
                }

                $achivements = new Achievements;
                $achivements->achievement_code = $formData['code'];
                $achivements->student_id = $formData['student_id'];
                $achivements->is_achieved = true;

                $achivements->save();
                $this->onLoadAchieved($data);
    
                if ($achivements->id){
    
                    return response()->json([
                        'status'=> 200,
                        'data'=>'',
                        'message'=>'Sucessfully saved.'
                    ]);    
                } else {
                    throw new \Exception("Error Processing Request");
                }
            });
            return $transaction;
        }
    }

    // participations
	public function isFirstReject($data) {
        
		$answers = DB::table('questions as q')
            ->where('q.question_code',$data['questionCode'])
            ->where('q.is_approved',false);
        
        $answers_count = $answers-> count();
        $answers_det = $answers-> first();

        $isFirstAnswer = ($answers_count == 1);
        if ($isFirstAnswer){
            $data['student_id'] = $answers_det->student_id;

            $transaction = DB::transaction(function($data) use($data) {
                
                $formData = array (
                    'code'=> 'PTP-16',
                    'student_id'=>$data['student_id']

                );

                if ($this->isAchivementExists($formData)){
                    return response()->json([
                        'status'=> 200,
                        'data'=>'',
                        'message'=>'Achievement Code '.$formData['code'].' has already exists.'
                    ]);   
                }

                $achivements = new Achievements;
                $achivements->achievement_code = $formData['code'];
                $achivements->student_id = $formData['student_id'];
                $achivements->is_achieved = true;

                $achivements->save();
                $this->onLoadAchieved($data);
    
                if ($achivements->id){
    
                    return response()->json([
                        'status'=> 200,
                        'data'=>'',
                        'message'=>'Sucessfully saved.'
                    ]);    
                } else {
                    throw new \Exception("Error Processing Request");
                }
            });
            return $transaction;
        }
    }
    

    public function isAllAchievement($data) {
        
        $rewards_count = DB::table('rewards as r')
            ->where('active',1)
            ->count();
        
        $achievements_count = DB::table('achievements as a')
            ->where('is_achieved',true)
            ->where('student_id',$data['student_id'])
            ->count();

        $isGetAll = ($rewards_count == $achievements_count);

        if ($isGetAll){

            $transaction = DB::transaction(function($data) use($data) {
                
                $formData = array (
                    'code'=> 'FNA-01',
                    'student_id'=>$data['student_id']

                );

                if ($this->isAchivementExists($formData)){
                    return response()->json([
                        'status'=> 200,
                        'data'=>'',
                        'message'=>'Achievement Code '.$formData['code'].' has already exists.'
                    ]);   
                }

                $achivements = new Achievements;
                $achivements->achievement_code = $formData['code'];
                $achivements->student_id = $formData['student_id'];
                $achivements->is_achieved = true;

                $achivements->save();
    
                if ($achivements->id){
    
                    return response()->json([
                        'status'=> 200,
                        'data'=>'',
                        'message'=>'Sucessfully saved.'
                    ]);    
                } else {
                    throw new \Exception("Error Processing Request");
                }
            });
            return $transaction;
        }
    }

    public function isReachingPoints($data){
        $points = $this->getTotalPointPerCategory($data);
        $isValid = false;
        if ($points['total_points'] >= 25 ) {
            $isValid = true;
            $data['code'] = 'PTP-10';
        } elseif ($points['total_points'] >= 50) {
            $data['code'] = 'PTP-11';
        } elseif ($points['total_points'] >= 100) {
            $data['code'] = 'PTP-12';
        } elseif ($points['total_points'] >= 150) {
            $data['code'] = 'PTP-13';
        } elseif ($points['total_points'] >= 200) {
            $data['code'] = 'PTP-14';
        } elseif ($points['total_points'] >= 500) {
            $data['code'] = 'PTP-15';
        }

        if ($isValid) {
            $transaction = DB::transaction(function($data) use($data) {
                
                $formData = array (
                    'code'=> $data['code'],
                    'student_id'=>$data['student_id']

                );

                if ($this->isAchivementExists($formData)){
                    return response()->json([
                        'status'=> 200,
                        'data'=>'',
                        'message'=>'Achievement Code '.$formData['code'].' has already exists.'
                    ]);   
                }

                $achivements = new Achievements;
                $achivements->achievement_code = $formData['code'];
                $achivements->student_id = $formData['student_id'];
                $achivements->is_achieved = true;

                $achivements->save();
                $this->onLoadAchieved($data);
    
                if ($achivements->id){
    
                    return response()->json([
                        'status'=> 200,
                        'data'=>'',
                        'message'=>'Sucessfully saved.'
                    ]);    
                } else {
                    throw new \Exception("Error Processing Request");
                }
            });
            return $transaction;
        }

    }

    public function isReaching75PointsAnswering($data){
        $points = $this->getTotalPointPerCategory($data);
        
        if($points['answer_points']>=75){
            $transaction = DB::transaction(function($data) use($data) {
                
                $formData = array (
                    'code'=> 'ANS-01',
                    'student_id'=>$data['student_id']

                );

                if ($this->isAchivementExists($formData)){
                    return response()->json([
                        'status'=> 200,
                        'data'=>'',
                        'message'=>'Achievement Code '.$formData['code'].' has already exists.'
                    ]);   
                }

                $achivements = new Achievements;
                $achivements->achievement_code = $formData['code'];
                $achivements->student_id = $formData['student_id'];
                $achivements->is_achieved = true;

                $achivements->save();
                $this->onLoadAchieved($data);
    
                if ($achivements->id){
    
                    return response()->json([
                        'status'=> 200,
                        'data'=>'',
                        'message'=>'Sucessfully saved.'
                    ]);    
                } else {
                    throw new \Exception("Error Processing Request");
                }
            });
            return $transaction;
        }
    }

    public function isReaching25PointsAsking($data){
        $points = $this->getTotalPointPerCategory($data);
        
        if($points['question_points']>=25){
            $transaction = DB::transaction(function($data) use($data) {
                
                $formData = array (
                    'code'=> 'ASK-01',
                    'student_id'=>$data['student_id']

                );

                if ($this->isAchivementExists($formData)){
                    return response()->json([
                        'status'=> 200,
                        'data'=>'',
                        'message'=>'Achievement Code '.$formData['code'].' has already exists.'
                    ]);   
                }

                $achivements = new Achievements;
                $achivements->achievement_code = $formData['code'];
                $achivements->student_id = $formData['student_id'];
                $achivements->is_achieved = true;

                $achivements->save();
                $this->onLoadAchieved($data);
    
                if ($achivements->id){
    
                    return response()->json([
                        'status'=> 200,
                        'data'=>'',
                        'message'=>'Sucessfully saved.'
                    ]);    
                } else {
                    throw new \Exception("Error Processing Request");
                }
            });
            return $transaction;
        }
    }

    public function onLoadAchieved($data) {
        $this->isFirstAchievement($data);
        $this->isAllAchievement($data);
        $this->isMasterAllCategory($data);
        $this->isReachingPoints($data);
    }

    // public function getTotalPoints
}