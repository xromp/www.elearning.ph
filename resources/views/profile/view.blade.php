
<div class="container" id="mainDiv">
    <div class="row">
    	<div class="col-sm-2 blog-main">
    		<img src="{{ url('/') }}/uploads/profile/person-8x.png" style="width:150px;"/> 
    	</div>
        <div class="col-sm-8 blog-main"> 
            <h2><%pc.UserName%></h2>

            <div class="row">
                <div class="col-sm-4 blog-main" style="text-align: center;">
                   <h1> 30 </h1>
                   <h5>Total Points</h5>
                </div>
                <div class="col-sm-4 blog-main" style="text-align: center;">
                   <h1> 15 </h1>
                   <h5>Points - Answering</h5>
                </div>
                <div class="col-sm-4 blog-main" style="text-align: center;">
                   <h1> 15 </h1>
                   <h5>Points - Posting</h5>
                </div>
            </div>
        </div>
  
    </div>

    <br>
    <div class="row">
        <div class="col-sm-12 blog-main" style="text-align: left;">
            <span ng-repeat="student in pc.students"> 
                <span ng-repeat="achievement in student.achievementList">
                    <h5><%achievement.type%> - <%achievement.desc%> </h5>
                    <div class="row">
                        
                        <div class="col-sm-2 blog-main" ng-repeat="list in achievement.list" 
                            ng-if="!list.is_achieved" 
                            style="border: 2px solid #ddd;margin:4px;text-align: center;padding:10px; border-radius: 15px;"" title="<%list.description%>">
                          <img src="{{ url('/') }}/Icons/lock-item.png" style="width:55;" /> 
                            <hr>
                            <span style="color:#8c8c8c;font-size:12px;font-weight: bold;"><%list.title%></span>
                        </div>

                        <div class="col-sm-2 blog-main" ng-repeat="list in achievement.list" 
                            ng-if="list.is_achieved" 
                            style="border: 2px solid #ddd;margin:4px;text-align: center;padding:10px; border-radius: 15px; " title="<%list.description%>">
                           
                              <img src="{{ url('/') }}/Icons/<%list.icon_path%>" style="width:55;" /> 
                            <hr>
                            <span style="color:#8c8c8c;font-size:12px;font-weight: bold;"><%list.title%></span>
                        </div>


                    </div>
                    <br>
                    <br>
                </span>
                <br>
            </span> 
        </div>
    </div>

    <div class="row" style="padding:14px;text-align: center" ng-if="question_ans"> 
		<div class="col-sm-6 blog-main" style="border:1px solid;border-color:#ddd;cursor: pointer;border-radius: 5px;" title="Posted Questions" ng-click="ShowHidQuestionAns(1)">
			<h5>Posted Questions</h5>
		</div>
		<div class="col-sm-6 blog-main" style="border:1px solid;border-color:#ddd;cursor: pointer;border-radius: 5px;" title="Answered Questions" ng-click="ShowHidQuestionAns(0)">
			<h5>Answered Questions</h5>
		</div> 
	</div>
	<div class="row">
		<div class="col-sm-12 blog-main">
            <div class="list-group" ng-repeat="question in pc.questionList" ng-if="posted_questions">
                <a href="\question\answerquestion\<%question.question_code%>" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1"><i class="fa fa-check-circle-o" aria-hidden="true" ng-show="question.student_info.has_answered"></i> <%question.title%></h5>
                        <small ng-show="question.student_info.is_self">You posted this question <time am-time-ago="question.created_at"></time></small>
                        <small ng-hide="question.student_info.is_self">Asked this question <time am-time-ago="question.created_at"></time></small>
                    </div>
                    <%question.question_code%>                    
                    <small>This question was answered by <%question.no_of_answers || '0'%> student(s)</small>                          
                    <div>
                        <span class="badge badge-default" ng-bind="question.category_desc"></span>
                        <span class="badge badge-default" ng-bind="question.type_desc"></span>
                    </div>
                </a>
                <br/>
            </div>

            <div class="list-group" ng-if="answered_questions">
                <h1>Answers here</h1>
            </div>
        </div>
	</div>

</div>