(function(){
    'use strict';
    angular
        .module('eApp')
        .controller('QuestionCtrl',QuestionCtrl)
        .controller('AskQuestionCtrl',AskQuestionCtrl)

        QuestionCtrl.$inject = ['$scope'];
        function QuestionCtrl($scope){
            var vm = this;

            vm.questionList = [
                {title:'How to be you po', noOfAnswers:10, status:'', isSelf:true, createdById:'1', createdByName:'Rom', createdAt:new Date('10/28/2017 14:00:01'), category:'Composite', type:'Coding'},
                {title:'How to be you po', noOfAnswers:10, status:'', isSelf:false, createdById:'1', createdByName:'Rom', createdAt:new Date('10/28/2017 10:00:01'), category:'Composite', type:'Multiple Choice'},
                {title:'How to be you po', noOfAnswers:10, status:'', isSelf:true, createdById:'1', createdByName:'Rom', createdAt:new Date('10/27/2017 14:00:01'), category:'Composite', type:'Coding'}
            ];

            vm.leaderBoardList = [
                {uid:'1', name:'John Doe', points:'30'},
                {uid:'2', name:'John Doe2', points:'24'},
                {uid:'3', name:'John Doe3', points:'51'},
                {uid:'4', name:'John Doe4', points:'10'}
            ];
        }

        AskQuestionCtrl.$inject = [];
        function AskQuestionCtrl(){
            var vm = this;
            vm.questionDetails = {
                categoryId:'1',
                typeId:'1'
            };

            vm.categoryList = [
                {id:'1', desc:'Composite'},
                {id:'2', desc:'Adapter'},
                {id:'3', desc:'Decorator'}
            ];

            vm.typeList = [
                {id:'1', desc:'Multiple Choice'},
                {id:'2', desc:'Coding'},
                {id:'3', desc:'Identification'}
            ];

            vm.questionDetails.choiceList = [
                {'id':1, answerDesc:'', isCorrect:true},
                {'id':2, answerDesc:'', isCorrect:false},
                {'id':5, answerDesc:'', isCorrect:false}
            ];

            vm.changeType = function(data){
                vm.questionDetails.answer = "";

                if (data.typeId == '1') {
                    vm.questionDetails.answer = 1;
                }

            };

            vm.submit = function(data) {
                vm.frmQuestion.withError = true;
                console.log(data);
            };
        }
})();