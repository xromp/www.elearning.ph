<div class="container" id="mainDiv" ng-cloak>
    <div class="row">
        <div class="col-sm-8">
            <h3>Most Recent Questions</h3>
            <form>
                <div class="input-group">
                    <input type="text" class="form-control" ng-model="qc.searchDet.search_title" placeholder="Search for title ...">
                    <span>
                    <div class="input-group">
                        <select class="custom-select text-success" id="inputGroupSelect01" ng-model="qc.searchDet.search_type">
                            <option value="ALL" selected>All</option>
                            <option value="UNANSWERED">Unanswered</option>
                            <option value="ANSWERED">Answered</option>
                            <option value="SELF">Own Question(s)</option>
                        </select>
                    </div>
                    </span>

                    <span class="input-group-btn">
                        <button class="btn btn-secondary btn-success" ng-click="qc.search(qc.searchDet)" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </span>                
                </div>
            </form>
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
                        <h5 class="mb-1">
                            <i class="fa fa-info-circle" aria-hidden="true" ng-show="question.is_approved == null" style="color:yellow;"></i>                        
                            <i class="fa fa-check-circle-o" aria-hidden="true" ng-show="question.student_info.has_answered" style="color:green;"></i> 
                            <i class="fa fa fa-thumbs-up" aria-hidden="true" style="color:green;" ng-show="question.is_approved && question.student_info.is_admin"></i>
                            <i class="fa fa fa-thumbs-down" aria-hidden="true" style="color:red;" ng-show="question.is_approved == 0 && question.student_info.is_admin"></i>
                            <i class="fa fa-user-circle-o" aria-hidden="true" ng-show="question.student_info.is_self" style="color:blue;"></i>
                            <%question.title%>
                        </h5>
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
                            <td ng-bind="leaderBoard.position + '.'"></td>
                            <td><a ng-click="qc.routeTo('/profile/'+leaderBoard.hashedID)" href=""><%leaderBoard.name%></a></td>
                            <td ng-bind="leaderBoard.total_points"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div ng-show="qc.searchDet.totalItems > qc.searchDet.rowPerPage">
            <ul uib-pagination total-items="qc.searchDet.totalItems" ng-model="qc.searchDet.currentPage" max-size="qc.searchDet.rowPerPage" class="pagination-m" boundary-link-numbers="true" ng-change="qc.search(qc.searchDet)"></ul>
        </div>
        
    </div>
</div>
<script>
$().ready(function(){
    $('.material-icons').each(function(i){
        if (i == 0) {$(this).text('Prev');}
        if (i == 1) {$(this).text('Next');}
    });
});
</script>