<div class="container" id="mainDiv">

   <div class="row">
        <div class="col-sm-9 blog-main">
            <div class="row">
            <div class="col-sm-4 blog-main">
             <div class="form-group">
                <form>
                    <label for="">Search: </label>
                    <input type="text" class="form-control" ng-model="name" id=""/>
                    <input type="submit" class="btn btn-success btn-success-sm" style="margin-top:3px;" ng-click="search(name)">
                </form>
              </div>
            </div>
            </div>
            <div class="row">
                <div class="col-sm-3 blog-main" ng-repeat="student in lbc.students" style="border: 1px solid #ddd;margin:10px;padding:10px;border-radius: 15px;cursor:ponter" ng-click="lbc.routeTo('/profile/'+student.hashedID)"> 
                    <h5> <%student.name%></h5>
                       
                    <span ng-repeat="achievement in student.achievementList"> 
                            <span class="blog-main" ng-repeat="list in achievement.list" ng-if="list.is_achieved" title="<%list.description%>"> 
                                <img src="{{ url('/') }}/Icons/<%list.icon_path%>" style="width:35;" /> 
                            </span>
                    </span> 
                </div>  
            </div>
            
        </div>
        <div class="col-sm-3 blog-sidebar">
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
                        <tr ng-repeat="leaderBoard in lbc.leaderBoardList | orderBy:'-points'">
                            <td ng-bind="$index+1 + '.'"></td>
                            <td><a ng-click="lbc.routeTo('/profile/'+leaderBoard.hashedID)" href=""><%leaderBoard.name%></a></td>
                            <td ng-bind="leaderBoard.points"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
   </div>

</div>