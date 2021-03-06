<style>
.trix_question {
  pointer-events: none;
}

/* 
trix-toolbar { display: none; } */
</style>
<div class="container" id="mainDiv" ng-cloak>
    <form name="ansqc.frmQuestion" novalidate>
        <div class="row">
            <div class="col-sm-8">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">
                    <i class="fa fa fa-thumbs-up" aria-hidden="true" style="color:green;" ng-show="ansqc.questionDetails.is_approved"></i>
                    <i class="fa fa fa-thumbs-down" aria-hidden="true" style="color:red;" ng-show="ansqc.questionDetails.is_approved == 0"></i>
                    <%ansqc.questionDetails.title%>
                    </h5>
                </div>
                <small><% (ansqc.questionDetails.student_info.is_self) == true ? "You posted this question ": "Asked " %><time am-time-ago="ansqc.questionDetails.created_at"></time></small>
                <div>
                    <span class="badge badge-default" ng-bind="ansqc.questionDetails.category_desc"></span>
                    <span class="badge badge-default" ng-bind="ansqc.questionDetails.type_desc"></span>
                </div>
                <br/> 
            </div>
            <div class="col-sm-4" ng-if="ansqc.questionDetails.student_info.is_admin && ansqc.questionDetails.is_approved == null">
                <div class="pull-right">
                    <button class="btn btn-success" ng-click="ansqc.action(ansqc.questionDetails,'APPROVED')"><i class="fa fa fa-thumbs-up"></i> Approve</button>
                    <button class="btn btn-danger" ng-click="ansqc.action(ansqc.questionDetails,'DECLINED')"><i class="fa fa fa-thumbs-down"></i> Decline</button>
                </div>
            </div>
        </div>

        <div class="form-group" ng-class="{'text-danger': ansqc.frmQuestion.desc.$invalid && ansqc.frmQuestion.withError }">
            <label>Question</label>
            <div>
                <trix-editor ng-model-options="{ updateOn: 'blur' }" spellcheck="false" class="trix-content trix_question" ng-model="ansqc.questionDetails.description" angular-trix trix-initialize="trixInitialize(e, editor);" trix-focus="trixFocus(e, editor);" trix-blur="trixBlur(e, editor);"></trix-editor>
            </div>
        </div>

        <!-- Type of answer -->
        <div class="form-group" ng-if="ansqc.questionDetails.type_code == 'MULTIPLE_CHOICE'">
            <fieldset class="form-group">
                <legend class="col-form-legend">
                    <%ansqc.questionDetails.student_info.is_self ?
                    'Question\'s choices' :
                    'Select the correct answer to the question'
                    %>
                </legend>
                <div class="col-sm-10">

                    <div class="form-check" ng-repeat="choice in ansqc.questionDetails.choiceList">
                        <div class="col-lg-6">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <input type="radio" aria-label="Radio button for following text input" name="choices" ng-model="ansqc.questionDetails.answer" ng-value="choice.choice_code">
                                </span>
                                <input type="text" class="form-control" aria-label="Text input with radio button" name="answerDesc" ng-model="choice.choice_desc" required>
                            </div>
                        </div>
                    </div>

                </div>
            </fieldset>
        </div>
        <div class="form-group" ng-if="ansqc.questionDetails.type_code == 'CODING' && !ansqc.questionDetails.student_info.is_self" ng-hide="ansqc.questionDetails.student_info.answered_correctly">
            <label>Type the code below. <small class="" style="background-color:#eee;">Enclosed with <> tag for code statement</small></label>
            <!-- https://github.com/sachinchoolur/angular-trix -->
            <trix-editor ng-model-options="{ updateOn: 'blur' }" spellcheck="false" class="trix-content" ng-model="ansqc.questionDetails.answer" angular-trix trix-initialize="trixInitialize(e, editor);" trix-change="trixChange(e, editor);" trix-selection-change="trixSelectionChange(e, editor);" trix-focus="trixFocus(e, editor);" trix-blur="trixBlur(e, editor);" trix-file-accept="trixFileAccept(e, editor);" trix-attachment-add="trixAttachmentAdd(e, editor);" trix-attachment-remove="trixAttachmentRemove(e, editor);" placeholder="Write something.."></trix-editor>
        </div>

        <div class="form-group" ng-if="ansqc.questionDetails.type_code == 'IDENTIFICATION'">
            <label>Enter your answer.</label>
            <input type="text" class="form-control" name="identificationAnswer" ng-model="ansqc.questionDetails.answer" ng-disabled="ansqc.questionDetails.student_info.is_self" placeholder="Answer to the question">   
        </div>
        <!-- end Type answ -->        

        <div class="form-group row">
            <div class="col-sm-10">            
                <button type="button" class="btn btn-primary" ng-click="ansqc.submit(ansqc.questionDetails)"  ng-show="(!ansqc.questionDetails.student_info.is_self && !ansqc.questionDetails.student_info.has_answered)" ng-disabled="!ansqc.questionDetails.answer">Submit Answer</button>
                
                <!-- answers with approval -->
                <div class="row" ng-repeat="student in ansqc.questionDetails.students_answered.list" ng-if="ansqc.questionDetails.type_code == 'CODING' && (ansqc.questionDetails.student_info.is_self || ansqc.questionDetails.is_answered_correctly)">
                    <div class="col-md-9">
                        <trix-editor ng-class="{' alert alert-success':student.is_correct}" ng-model-options="{ updateOn: 'blur' }" spellcheck="false" class="trix-content trix_question" ng-model="student.answer" angular-trix trix-initialize="trixInitialize(e, editor);" trix-change="trixChange(e, editor);" trix-selection-change="trixSelectionChange(e, editor);" trix-focus="trixFocus(e, editor);" trix-blur="trixBlur(e, editor);" trix-file-accept="trixFileAccept(e, editor);" trix-attachment-add="trixAttachmentAdd(e, editor);" trix-attachment-remove="trixAttachmentRemove(e, editor);" placeholder="Write something.."></trix-editor>
                        <span class="text-success" ng-hide="!student.is_correct"> <%(ansqc.questionDetails.student_info.answered_correctly) ? 'You have ' : student.name + ' has ' %> answered this correctlly. </span>
                        <br><br>
                    </div>
                    <div class="col-md-3 pulll-right" ng-hide="ansqc.questionDetails.is_answered_correctly">
                        <button class="btn btn-success btn-sm" ng-click="ansqc.actionAnswer(student,'CORRECT',ansqc.questionDetails)"><i class="fa fa-check-circle"></i> Mark as correct</button>
                        <!-- <button class="btn btn-danger btn-sm" ng-click="ansqc.actionAnswer(student,'WRONG')"><i class="fa fa-times-circle"></i> Wrong</button> -->
                    </div>
                </div>
                
                
                <!-- <table class="table table-sm table-responsive" ng-if="ansqc.questionDetails.student_info.is_self">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Answer</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>No. of answer(s): <%ansqc.questionDetails.students_answered.count%></td>
                        </tr>
                        <tr ng-class="{'table-success':student.is_correct}" ng-repeat="student in ansqc.questionDetails.students_answered.list">
                            <td ng-bind="student.name"></td>
                            <td ng-bind="student.answer"></td>
                            <td ng-bind="student.answered_at |  date:'MM/dd/yyyy h:mma'"></td>
                        </tr>
                    </tbody>
                </table> -->
            </div>
        </div>
    </form>
</div>