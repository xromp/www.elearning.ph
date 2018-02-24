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
                $data['achievement_code'] = $formData['code'];

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
                $data['achievement_code'] = $formData['code'];

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

    public function isFirstCorrectCodingAnswer($data) {

        if ($this->isEmpty($data['student_id'])) {
            return 'No student_id supplied';
        }
        
        $answers_count = DB::table('answers as a')
            -> leftJoin( DB::raw( "(SELECT questions.question_code, questions.type_code FROM questions 
                WHERE questions.type_code='CODING'
                AND questions.question_code='".$data['question_code']."'
                GROUP BY questions.question_code, questions.type_code) as q"), 
                'a.question_code', '=', 'q.question_code' )			
            -> where('q.type_code','CODING')
            -> where('a.student_id',$data['student_id'])
			-> where('is_correct',true)
            -> count();

        $isFirstAnswer = ($answers_count == 1);

        if ($isFirstAnswer){
            $transaction = DB::transaction(function($data) use($data) {
                $formData = array (
                    'code'=> 'ANS-04',
                    'student_id'=>$data['student_id'],
                    'category_code'=>$data['category_code']

                );
                $data['achievement_code'] = $formData['code'];
                $formData['achievement_code'] = $formData['code'];
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
                $this->onLoadAchieved($formData);

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
                "(SELECT answers.question_code, answers.rating FROM answers 
                WHERE answers.rating = 5
                AND answers.question_code='".$data['question_code']."' 
                ) as a"), 
                'q.question_code', '=', 'a.question_code' )
            ->where('q.question_code',$data['question_code'])
            ->where('a.rating','5');
        
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
                $data['achievement_code'] = $formData['code'];
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
                $data['achievement_code'] = $formData['code'];
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
        // echo($this->getTotalPointPerCategory($data)['total_points']);
        // dd($this->getTotalPointPerCategory($data)['total_points']);
        $this->isReachingPoints($data);
        $this->isAllAchievement($data);
        $this->isMasterAllCategory($data);

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
                $data['achievement_code'] = $formData['code'];
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
                // event logs
                $logsData = array(
                    'student_id'=>$data['student_id'],
                    'category'=>$data['code']
                );
                $this->masteredLogs($logsData);

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
        $rewardsCount = DB::table('rewards as r')
            ->select('achievement_code', 
                'active', 
                'entity2')
            ->where('entity2', 'CATEGORYGROUP')
            ->where('achievement_code','<>', 'PTP-01')
            ->where('active','1')
            ->count();

        $achievedCount = DB::table('achievements as a')
            -> JOIN( DB::raw( "(SELECT rewards.achievement_code, rewards.active, entity2 FROM rewards
                WHERE entity2 = 'CATEGORYGROUP' AND
                rewards.achievement_code <> 'PTP-01' AND
                active = 1
                GROUP BY achievement_code, active, entity2) as r"), 
                'a.achievement_code', '=', 'r.achievement_code' )
            -> WHERE('a.is_achieved',true)
            -> WHERE('a.student_id',$data['student_id'])
            -> count();
        print_r($achievedCount);
        dd($achievedCount);
        if ($achievedCount == $rewardsCount) {
            $transaction = DB::transaction(function($data) use($data) {
                
                $formData = array (
                    'code'=> 'PTP-01',
                    'student_id'=>$data['student_id']

                );
                $data['achievement_code'] = $formData['code'];
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
                $data['achievement_code'] = $formData['code'];
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

    // ASK
    public function isFirstQuestion($data) {

        if ($this->isEmpty($data['student_id'])) {
            return 'No student_id supplied';
        }
        
        $questions_count = DB::table('questions as q')
            -> where('student_id',$data['student_id'])
            -> count();
        // echo($questions_count);
        // dd($questions_count);
        $isFirstQuestion = ($questions_count == 1);

        if ($isFirstQuestion){
            $transaction = DB::transaction(function($data) use($data) {
                
                $formData = array (
                    'code'=> 'ASK-02',
                    'student_id'=>$data['student_id']

                );
                
                $data['achievement_code'] = $formData['code'];

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

    public function isFirstApprovedQuestion($data) {

        if ($this->isEmpty($data['student_id'])) {
            return 'No student_id supplied';
        }
        
        $questions_count = DB::table('questions as q')
            -> where('is_approved',true)
            -> where('student_id',$data['student_id'])
            -> count();
        
        $isFirstQuestion = ($questions_count == 1);

        if ($isFirstQuestion){
            $transaction = DB::transaction(function($data) use($data) {
                
                $formData = array (
                    'code'=> 'ASK-03',
                    'student_id'=>$data['student_id']

                );
                $data['achievement_code'] = $formData['code'];

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

    public function isHaving20QuestionsApproved($data) {

        if ($this->isEmpty($data['student_id'])) {
            return 'No student_id supplied';
        }
        
        $questions_count = DB::table('questions as q')
            -> where('is_approved',true)
            -> where('student_id',$data['student_id'])
            -> count();
        $isFirst20Question = ($questions_count == 20);

        if ($isFirst20Question){
            $transaction = DB::transaction(function($data) use($data) {
                
                $formData = array (
                    'code'=> 'ASK-04',
                    'student_id'=>$data['student_id']

                );
                $data['achievement_code'] = $formData['code'];

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
                $data['achievement_code'] = $formData['code'];

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

    // SOCIAL
    public function is5Replies($data) {
        
		$replies = DB::table('forums as f')
            -> select(
                'f.forum_id',
                'f.student_id',
                'fc.comments_count',
                'f.created_at')
            -> leftJoin( DB::raw( "(SELECT forum_id, COUNT( forum_id ) as comments_count 
                FROM forums_comments 
                WHERE student_id <> ".$data['owner_id']."
                GROUP BY forum_id
                HAVING COUNT(forum_id) >= 5
                ) as fc"), 
                'fc.forum_id', '=', 'f.for
                um_id' )
            -> where('f.forum_id',$data['forum_id'])
            -> get();   
        
        $repliesCount = $replies->count();
        $replies_det = $replies-> first();
        
        if ($repliesCount){
            $data['student_id'] = $replies_det->student_id;

            $transaction = DB::transaction(function($data) use($data) {
                
                $formData = array (
                    'code'=> 'SCA-01',
                    'student_id'=>$data['student_id']

                );
                $data['achievement_code'] = $formData['code'];

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

    public function isPosted5Forum($data) {
        
		$forum = DB::table('forums as f')
                ->select('student_id','student_id',DB::raw('count(student_id) as topicCount'))
                ->where('student_id',$data['student_id'])
                ->groupBy('student_id')
                ->havingRaw('count(student_id) >= 5')
                ->get();

        $forumCount = $forum->count();
        $forum_det = $forum-> first();
        
        if ($forumCount){
            $data['student_id'] = $forum_det->student_id;

            $transaction = DB::transaction(function($data) use($data) {
                
                $formData = array (
                    'code'=> 'SCA-02',
                    'student_id'=>$data['student_id']

                );
                $data['achievement_code'] = $formData['code'];

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
            ->select(DB::raw('count(achievement_code) as total'))
            ->where('active',true)
            ->where('achievement_code','<>','FNA-02')
            ->groupBy('active', 'achievement_code')
            ->get();

        $achievements_count = DB::table('achievements as a')
            ->select(DB::raw('count(achievement_code) as total'))
            ->where('is_achieved',true)
            ->where('student_id',$data['student_id'])
            ->groupBy('is_achieved', 'student_id','achievement_code')
            ->get();

        $isGetAll = (count($rewards_count) == count($achievements_count));
        // print_r(count($rewards_count).'-'.count($achievements_count));
        // print_r($isGetAll);
        if ($isGetAll){

            $transaction = DB::transaction(function($data) use($data) {
                
                $formData = array (
                    'code'=> 'FNA-02',
                    'student_id'=>$data['student_id']

                );
                $data['achievement_code'] = $formData['code'];

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

    public function isReachingPoints($data){
        $points = $this->getTotalPointPerStudent($data);
        // print_r($points);
        // dd();
        $isValid = false;
        if ($points['total_points'] >= 25 ) {
            $isValid = true;
            $data['code'] = 'PTP-10';
        } 
        if ($points['total_points'] >= 50) {
            $isValid = true;
            $data['code'] = 'PTP-11';
        } 
        if ($points['total_points'] >= 100) {
            $isValid = true;
            $data['code'] = 'PTP-12';
        } 
        if ($points['total_points'] >= 150) {
            $isValid = true;
            $data['code'] = 'PTP-13';
        } 
        if ($points['total_points'] >= 200) {
            $isValid = true;
            $data['code'] = 'PTP-14';
        } 
        if ($points['total_points'] >= 500) {
            $isValid = true;
            $data['code'] = 'PTP-15';
        }

        if ($isValid) {
            $transaction = DB::transaction(function($data) use($data) {
                
                $formData = array (
                    'code'=> $data['code'],
                    'student_id'=>$data['student_id']

                );
                $data['achievement_code'] = $formData['code'];
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
                $data['achievement_code'] = $formData['code'];
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
                $data['achievement_code'] = $formData['code'];
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

        //event logs for has badget
        $this->hasBadgeLogs($data);
    }

    // public function getTotalPoints
}