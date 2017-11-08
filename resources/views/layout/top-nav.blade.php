<nav class="navbar navbar-toggleable-md navbar-light bg-faded fixed-top" ng-controller="TopNavCtrl as tc">
    <a class="navbar-brand" href="">CQV E-Learning</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon border border-primary"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" ng-click="tc.routeTo('/question/view')">Questions </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" ng-click="tc.routeTo('/stockmarket/view')">Stock Market    <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link"  href="">Leaderboards </a>
            </li>
            <li class="nav-item">
                <a class="nav-link"  href="">Rewards</a>
            </li>
        </ul>

        <div>
            <a class="nav-link"> Hi @if(!empty(Session::get('elearning_sess_name')))
                                    {{ Session::get('elearning_sess_name') }} 
                                    @endif </a>
        </div>

        <div id="iconHeaderMargin">
            <a ng-click="tc.routeTo('/profile/index')" href="" data-toggle="tooltip" data-placement="bottom" title="Profile">
                <img src="/assets/png/person-3x.png">
            </a>
        </div>

        <div id="iconHeaderMargin">
            <a href="" data-toggle="tooltip" data-placement="bottom" title="Rewards">
                <img src="/assets/png/badge-3x.png">
            </a>
        </div>

        <div id="iconHeaderMargin">
            <a ng-click="tc.routeTo('/logout')" data-placement="bottom" title="Logout">
                <img src="/assets/png/account-logout-2x.png">
            </a>
        </div>
    </div>
</nav>