<div class="container" id="mainDiv" ng-cloak>

   <!-- <div class="row"> -->
        <div class="row">
            <div class="col-sm-12 blog-main">
                <p class="pull-right"><a class="btn btn-large btn-outline-primary" href="/forum/createtopic">Raise a Topic</a></p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 blog-main">
                <div class="">
                    <ul class="list-group">
                        <div class="forum-list" ng-repeat="forum in fc.forumList">
                            <li class="list-group-item  list-group-item-action justify-content-between" ng-click="fc.showComment(forum)" ng-hide="forum.show_comment">
                                <p style="text-overflow: ellipsis;white-space: nowrap;overflow: hidden;width:95%; " ng-bind="forum.title"></p>
                                <span class="badge badge-default badge-pill" ng-bind="forum.comments_count"></span>
                            </li>
                            <div class="show-comment" ng-show="forum.show_comment">
                                <div class="card" ng-click="fc.showComment(forum)">
                                        <div class="card-block">
                                            <h4 class="card-title" ng-bind="forum.title"></h4>
                                            <p class="card-text" ng-bind="forum.desc"></p>
                                        </div>
                                    <div class="card-footer">
                                        <small class="text-muted" ng-bind="forum.student_name"></small>
                                        <small class="text-muted pull-right"><time am-time-ago="forum.updated_at"></time></small>
                                    </div>
                                </div>
                                <div class="" style="padding:1% 3%">
                                    <div class="list-group">
                                        <a class="list-group-item flex-column align-items-start" ng-repeat="comment in forum.comments">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h6 class="mb-1" ng-bind="comment.student_name"></h6>
                                                <small class="text-muted"><time am-time-ago="comment.updated_at"></time></small>
                                            </div>
                                            <p class="mb-1" ng-bind="comment.comment"></p>
                                        </a>
                                        <form name="fc.frmComment" ng-submit="fc.submitComment(fc.forumDetails, forum.forum_id, forum.student_id)" novalidate>
                                            <div class="input-group">
                                                    <input type="text" class="form-control" name="comment" ng-model="fc.forumDetails.comment" placeholder="Write a comment" required/>
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-sm btn-success" type"submit"><i class="fa fa-send-o"></i></button>
                                                    </span>
                                            </div>
                                        </form>
                                        
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
        </div>
   <!-- </div> -->

</div>