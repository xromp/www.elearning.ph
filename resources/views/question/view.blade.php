<div class="container" id="mainDiv">
    <div class="row">
        <div class="col-sm-8">
            <h3>Most Recent Questions</h3>
        </div>
        <div class="col-sm-4 text-right">
            <p><a class="btn btn-large btn-outline-primary" href="/question/askquestion">Ask a Question</a></p>
        </div>
    </div>
    <!-- List of recent questions -->
    
    <div class="row">
        <div class="col-sm-8 blog-main">
            <div class="list-group" ng-repeat="question in qc.questionList">
                <a href="\question\answerquestion\<%question.question_code%>" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1" ng-bind="$index+1 + ' ' +questions.studID  +'-'+ questions.title"></h5>
                        <small>You posted this question <time am-time-ago="questions.created_at"></time></small>
                    </div>

                    <small>This question was answered by 1 student(s)</small>                          
                    <div>
                        <span class="badge badge-default" ng-bind="question.category"></span>
                        <span class="badge badge-default" ng-bind="question.type"></span>
                    </div>
                </a>
                <br/>
            </div>
        </div>

        <div class="col-sm-3 offset-sm-1 blog-sidebar">
            <hr>
            <div class="sidebar-module">
                <h4 class="text-center">Top 10</h4>
                <div class="list-group">
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Points</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="leaderBoard in qc.leaderBoardList | orderBy:'-points'">
                            <td ng-bind="$index+1 + '.'"></td>
                            <td><a href=""><%leaderBoard.name%></a></td>
                            <td ng-bind="leaderBoard.points"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>