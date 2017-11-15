<div class="modal-header">
  <h5 class="modal-title" id="exampleModalLabel">Rate This Question</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
  </button>

</div>
  <div class="modal-body">
    <div class="form-group">
        <label for="exampleFormControlSelect1">Rate the question. (5 being highest and 1 being lowest)</label>
        <select class="form-control" ng-model="vm.questionDet.rating">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
        </select>
    </div>
    <div class="form-group" ng-show="vm.response.message">
        <div ng-class="{'alert alert-success':vm.response.status == 200,'alert alert-danger':vm.response.status != 200}"  ng-bind="vm.response.message"></div>
    </div>
</div>

<div class="modal-footer">
	<button type="button" class="btn btn-secondary" data-dismiss="modal" ng-click="vm.close(vm.questionDet)">Close</button>
	<button type="button" class="btn btn-secondary" data-dismiss="modal" ng-click="vm.skipSubmit(vm.questionDet)">Skip and Submit</button>
	<button type="submit" class="btn btn-primary" ng-click="vm.rateSubmit(vm.questionDet)">Rate and Submit</button>
</div>

