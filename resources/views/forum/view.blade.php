<div class="container" id="mainDiv" ng-cloak>

   <!-- <div class="row"> -->
        <div class="blog-main">
            <div class="">
                <ul class="list-group">
                    <div class="forum-list" ng-repeat="forum in fc.forumList">
                        <li class="list-group-item  list-group-item-action justify-content-between" ng-click="fc.showComment(forum)" ng-hide="forum.show_comment">
                            <p style="text-overflow: ellipsis;white-space: nowrap;overflow: hidden;width:95%; " ng-bind="forum.title"></p>
                            <span class="badge badge-default badge-pill" ng-bind="forum.count"></span>
                        </li>
                        <div class="show-comment" ng-show="forum.show_comment">
                            <div class="card" ng-click="fc.showComment(forum)">
                                    <div class="card-block">
                                        <h4 class="card-title" ng-bind="forum.title"></h4>
                                        <p class="card-text" ng-bind="forum.desc"></p>
                                    </div>
                                <div class="card-footer">
                                    <small class="text-muted"><time am-time-ago="forum.created_at"></time></small>
                                </div>
                            </div>
                            <div class="card">
                                <div class="list-group">
                                    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start" ng-repeat="comment in forum.comments">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1" ng-bind="comment.name"></h6>
                                            <small class="text-muted"><time am-time-ago="comment.created_at"></time></small>
                                        </div>
                                        <p class="mb-1" ng-bind="comment.comment"></p>
                                    </a>
                                    <!-- <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h8 class="mb-1">Penaflor, Rommel A.</h8>
                                            <small>3 days ago</small>
                                        </div>
                                        <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                                        <small>Donec id elit non mi porta.</small>
                                    </a> -->
                                </div>
                            </div>
                        <div>
                    </div>
                    
                </ul>

            </div>
        </div>
   <!-- </div> -->

</div>