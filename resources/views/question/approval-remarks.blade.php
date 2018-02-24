<div class="modal-header">
  <h5 class="modal-title" id="exampleModalLabel">Declining Question</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
  </button>

</div>
  <div class="modal-body">
    <div class="form-group">
        <label for="exampleFormControlSelect1">Remarks</label>
        <textarea class="form-control" rows="4" cols="50" ng-model="vm.questionDet.remarks" required></textarea>
    </div>
    <div class="form-group" ng-show="vm.response.message">
        <div ng-class="{'alert alert-success':vm.response.status == 200,'alert alert-danger':vm.response.status != 200}"  ng-bind="vm.response.message"></div>
    </div>
</div>

<div class="modal-footer">
	<button type="button" class="btn btn-success" data-dismiss="modal" ng-click="vm.submit(vm.questionDet)">Submit</button>
</div>

