<div class="container" id="mainDiv">
    <div class="row">
        <div class="col-sm-8">
            <h3><%scc.categoryDetails.description%> Question(s)</h3>
        </div>
        <div class="col-sm-4 text-right">
            <p><a class="btn btn-large btn-outline-primary" ng-click="scc.askQuestion()">Ask a Question</a></p>
        </div>
    </div>
    <!-- List of recent questions -->

    <div class="row">
        <div class="col-sm-12 blog-main">
            <div class="list-group" ng-repeat="question in scc.categoryDetails.list">
                <a class="list-group-item list-group-item-action flex-column align-items-start" ng-click="scc.viewQuestion(question)">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1" ng-bind="question.title"></h5>
                        <small><% (question.is_self) == true ? "You posted this question ": "Asked " %><time am-time-ago="question.created_at"></time></small>
                    </div>

                    <small>This question was answered by <%question.no_of_answers%> student(s)</small>                          
                    <div>
                        <span class="badge badge-default" ng-bind="question.category"></span>
                        <span class="badge badge-default" ng-bind="question.type"></span>
                    </div>
                </a>
                <br/>
            </div>
        </div>
    </div>
</div>