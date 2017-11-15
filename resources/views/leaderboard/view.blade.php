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
                <div class="col-sm-3" ng-repeat="user in lbc.UserData" style="border:1px solid #ddd;padding:10px;margin:10px;cursor:pointer;border-radius: 10px;" ng-click="lbc.routeTo('/profile/'+user.hashedID)">
                    <h5><%user.name%></h5>
                    <b>Points: 100</b>
                    <br>
                    <span ng-repeat="achievement in user.achievements" >
                        <img src="{{ url('/') }}/Icons/<%achievement.Icon%>" style="width:40px;border:3px solid #ddd;padding:3px; cursor:pointer; border-radius: 10px;" title="<%achievement.Desc%>"/> 
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