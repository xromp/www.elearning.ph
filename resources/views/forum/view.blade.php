<div class="container" id="mainDiv">

   <div class="row">
        <div class="col-sm-12 blog-main">
            <div class="row">
                <div class="col-sm-12 blog-main">
                 <div class="form-group">
                    <form>
                        <div class="form-group" ng-class="">
                            <label>Question Category</label>
                            <select name="category" class="form-control is-valid" ng-model="" required>
                                <option ng-repeat="category in aqc.categoryList" ng-bind="category.description" ng-value="category.category_code"></option>
                            </select>
                            <small class="text-danger" ng-show="aqc.frmQuestion.category.$invalid && aqc.frmQuestion.withError">Category is required field.</small>
                        </div>

                        <label for="">Title: </label>
                        <textarea ng-model="title" class="form-control"></textarea>
                        <input type="submit" value="Post" class="btn btn-success btn-success-sm" style="margin-top:3px;" ng-click="create(title)">
                    </form>
                  </div>
                </div>
            </div> 

            <div class="row">
                <div class="col-sm-12 blog-main">
                    <div class="list-group" ng-repeat="forum in fc.forumList">
                        <a href="" class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1"><i class="fa fa-check-circle-o" aria-hidden="true"></i> <%forum.title%></h5>
                                <small>Add Comment</small>
                            </div> 
                            <medium>Comments:</medium>
                            <div class="row">
                                <div class="col-sm-12 blog-main" ng-repeat="comment in forum.comments ">
                                    <%comment.comment%>
                                </div>
                            </div>   
                        </a>
                        <br/>
                    </div>
                </div>
            </div>
        </div>
   </div>

</div>