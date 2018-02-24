<nav class="navbar navbar-toggleable-md navbar-light bg-faded fixed-top" ng-controller="TopNavCtrl as tc" ng-cloak>
    <a ng-click="tc.routeTo('/question/view')"  class="navbar-brand" href="#">CQV E-Learning</a>

    @if(Session::get('account_type') == 1)
    <span class="badge badge-default">
        <i class="fa fa-user-circle"></i> Admin
    </span>        
    @endif
            
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon border border-primary"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" ng-click="tc.routeTo('/question/view')" href="#" title="Questions">Questions </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" ng-click="tc.routeTo('/stockmarket/view')" href="#" title="Stock Market">Stock Market <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" ng-click="tc.routeTo('/leaderboard/index',true)" href="#" title="Leaderboards">Leaderboards </a>
            </li>
            <li class="nav-item">
                <a class="nav-link"  ng-click="tc.routeTo('/forum/index')" href="#" title="Forum">Forum</a>
            </li>
        </ul>
        <div>
            <a class="nav-link" ng-click="tc.routeTo('/profile/{{Session::get('hashedID')}}')" href="#" > {{Session::get('fullname')}}  </a>
        </div>

        <div id="iconHeaderMargin">
            <a ng-click="tc.routeTo('/profile/{{Session::get('hashedID')}}')" href="#" data-toggle="tooltip" data-placement="bottom" title="Profile">
                <img src="/assets/png/person-3x.png">
            </a>
        </div>


        <div id="iconHeaderMargin">
            <a ng-click="tc.routeTo('/logout')" href="#" data-placement="bottom" title="Logout" >
                <img src="/assets/png/account-logout-2x.png" style="margin-top:5px;">
            </a>
        </div>
    </div>
</nav>