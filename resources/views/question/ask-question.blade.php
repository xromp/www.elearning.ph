<div class="container" id="mainDiv">
    <form name="aqc.frmQuestion" novalidate>
        <div class="form-group" ng-class="{'text-danger': aqc.frmQuestion.category.$invalid && aqc.frmQuestion.withError }">
            <label>Question Category</label>
            <select name="category" class="form-control is-valid" ng-model="aqc.questionDetails.category_code" required>
                <option ng-repeat="category in aqc.categoryList" ng-bind="category.description" ng-value="category.category_code"></option>
            </select>
            <small class="text-danger" ng-show="aqc.frmQuestion.category.$invalid && aqc.frmQuestion.withError">Category is required field.</small>
        </div>
        <div class="form-group" ng-class="{'text-danger': aqc.frmQuestion.title.$invalid && aqc.frmQuestion.withError }">
            <label>Title</label>
            <input type="text" name="title" class="form-control" ng-model="aqc.questionDetails.title" placeholder="Title of the question" required>
            <small class="text-danger" ng-show="aqc.frmQuestion.title.$invalid && aqc.frmQuestion.withError">Title is required field.</small>
        </div>
        <div class="form-group" ng-class="{'text-danger': aqc.frmQuestion.desc.$invalid && aqc.frmQuestion.withError }">
            <label>Question</label>
            <!-- https://github.com/sachinchoolur/angular-trix -->
            <trix-editor ng-model-options="{ updateOn: 'blur' }" spellcheck="false" class="trix-content" ng-model="aqc.questionDetails.description" angular-trix trix-initialize="trixInitialize(e, editor);" trix-change="trixChange(e, editor);" trix-selection-change="trixSelectionChange(e, editor);" trix-focus="trixFocus(e, editor);" trix-blur="trixBlur(e, editor);" trix-file-accept="trixFileAccept(e, editor);" trix-attachment-add="trixAttachmentAdd(e, editor);" trix-attachment-remove="trixAttachmentRemove(e, editor);" placeholder="Write something.." required></trix-editor>
            <!-- <textarea type="text" name="desc" class="form-control" rows="4" ng-model="aqc.questionDetails.description" required/> -->
            <small class="text-danger" ng-show="aqc.frmQuestion.desc.$invalid && aqc.frmQuestion.withError">Question is required field.</small>
        </div>
        
        <div class="form-group" ng-class="{'text-danger': aqc.frmQuestion.type.$invalid && aqc.frmQuestion.withError }">
            <label>Type of Question</label>
            <select name="type" class="form-control" ng-model="aqc.questionDetails.type_code" ng-init="aqc.changeType(aqc.questionDetails)" ng-change="aqc.changeType(aqc.questionDetails)" required>
                <option ng-repeat="type in aqc.typeList" ng-bind="type.description" ng-value="type.type_code"></option>
            </select>
            <small class="text-danger" ng-show="aqc.frmQuestion.type.$invalid && aqc.frmQuestion.withError">Type of Question is required field.</small>
        </div>
        <!-- Type of answer -->
        <div class="form-group" ng-if="aqc.questionDetails.type_code == 'MULTIPLE_CHOICE'">
            <fieldset class="form-group">
                <legend class="col-form-legend">Enter four potential answers then select the correct answer to the given question.</legend>
                <div class="col-sm-10">

                    <div class="form-check" ng-repeat="choice in aqc.questionDetails.choiceList">
                        <div class="col-lg-6">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <input type="radio" aria-label="Radio button for following text input" name="choices" ng-model="aqc.questionDetails.answer" ng-value="choice.choice_code">
                                </span>
                                <input type="text" class="form-control" aria-label="Text input with radio button" name="answerDesc" ng-model="choice.choice_desc" required>
                            </div>
                        </div>
                    </div>

                </div>
            </fieldset>
        </div>

        <div class="form-group" ng-if="aqc.questionDetails.type_code == 'CODING'">
        <label>Type the code below. <small class="" style="background-color:#eee;">Enclosed with <> tag for code statement</small></label>
            <!-- https://github.com/sachinchoolur/angular-trix -->
            <trix-editor ng-model-options="{ updateOn: 'blur' }" spellcheck="false" class="trix-content" ng-model="aqc.questionDetails.answer" angular-trix trix-initialize="trixInitialize(e, editor);" trix-change="trixChange(e, editor);" trix-selection-change="trixSelectionChange(e, editor);" trix-focus="trixFocus(e, editor);" trix-blur="trixBlur(e, editor);" trix-file-accept="trixFileAccept(e, editor);" trix-attachment-add="trixAttachmentAdd(e, editor);" trix-attachment-remove="trixAttachmentRemove(e, editor);" placeholder="Write something.."></trix-editor>
        </div>

        <div class="form-group" ng-if="aqc.questionDetails.type_code == 'IDENTIFICATION'">
            <label>Enter the answer to the question.</label>
            <input type="text" class="form-control" name="identificationAnswer" ng-model="aqc.questionDetails.answer" placeholder="Answer to the question">   
        </div>
        <!-- end Type answ -->        

        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary" ng-click="aqc.submit(aqc.questionDetails)">
                    Submit Question
                </button>
            </div>
        </div>
    </form>
</div>