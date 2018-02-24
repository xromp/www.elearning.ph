<div class="container" id="mainDiv">
    <form name="ftc.frmForum" novalidate>
        <div class="form-group" ng-class="{'text-danger': ftc.frmForum.title.$invalid && ftc.frmForum.withError }">
            <label>Title</label>
            <input type="text" name="title" class="form-control" ng-model="ftc.forumDetails.title" placeholder="Title of the topic" required>
            <small class="text-danger" ng-show="ftc.frmForum.title.$invalid && ftc.frmForum.withError">Title is required field.</small>
        </div>
        <div class="form-group" ng-class="{'text-danger': ftc.frmForum.desc.$invalid && ftc.frmForum.withError }">
            <label>Description</label>
            <textarea class="form-control" name="desc" ng-model="ftc.forumDetails.description" rows="4" required></textarea>
            <small class="text-danger" ng-show="ftc.frmForum.desc.$invalid && ftc.frmForum.withError">Description is required field.</small>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                <button class="btn btn-primary" ng-click="ftc.submit(ftc.forumDetails)" ng-disabled="ftc.display.loading">
                    <i class="fa fa-spinner fa-spin" ng-show="ftc.display.loading"></i>
                    Submit Question
                </button>
                <button class="btn btn-default" ng-click="ftc.goBack()">
                    Go Back
                </button>

            </div>
        </div>
    </form>
</div>