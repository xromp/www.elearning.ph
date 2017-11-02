(function(){
    'use strict';
    angular
        .module('eApp')
        .controller('QuestionCtrl',QuestionCtrl)
        .controller('AskQuestionCtrl',AskQuestionCtrl)
        .controller('AnswerQuestionCtrl',AnswerQuestionCtrl)
        .controller('ModalInfoInstanceCtrl',ModalInfoInstanceCtrl)
        .factory('QuestionSrvcs',QuestionSrvcs)

        QuestionCtrl.$inject = ['QuestionSrvcs'];
        function QuestionCtrl(QuestionSrvcs){

            var vm = this;

            // vm.questionList = [
            //     {title:'How to be you po', noOfAnswers:10, status:'', isSelf:true, createdById:'1', createdByName:'Rom', createdAt:new Date('10/28/2017 14:00:01'), category:'Composite', type:'Coding'},
            //     {title:'How to be you po', noOfAnswers:10, status:'', isSelf:false, createdById:'1', createdByName:'Rom', createdAt:new Date('10/28/2017 10:00:01'), category:'Composite', type:'Multiple Choice'},
            //     {title:'How to be you po', noOfAnswers:10, status:'', isSelf:true, createdById:'1', createdByName:'Rom', createdAt:new Date('10/27/2017 14:00:01'), category:'Composite', type:'Coding'}
            // ];

            var data = {};

            QuestionSrvcs.get(data)
            .then (function (response) {
              if (response.data.status == 200) {
                vm.questionList = response.data.data[0].questions;
                console.log(vm.questionList)
              }
            },function(){ alert("Bad Request!")})

            vm.leaderBoardList = [
                {uid:'1', name:'John Doe', points:'30'},
                {uid:'2', name:'John Doe2', points:'24'},
                {uid:'3', name:'John Doe3', points:'51'},
                {uid:'4', name:'John Doe4', points:'10'}
            ];
        }

        AskQuestionCtrl.$inject = ['QuestionSrvcs'];
        function AskQuestionCtrl(QuestionSrvcs){
            var vm = this;

           
            vm.questionDetails = {
                category_code: 1,
                type_code:'3'
            };

          
            // vm.categoryList = [
            //     {category_id:'1', category_code:'COMPOSITE', desc:'Composite'},
            //     {category_id:'2', category_code:'ADAPTER', desc:'Adapter'},
            //     {category_id:'3', category_code:'DECORATOR', desc:'Decorator'}
            // ];

            QuestionSrvcs.getCategories()
            .then (function (response)  {
                if (response.data.status == 200) {
                    vm.categoryList = response.data.data;
                    console.log(vm.categoryList);
                }
            }, function() { alert("Bad Request!")})

            vm.typeList = [
                {type_id:'1', type_code:'MULTIPLE_CHOICE', desc:'Multiple Choice'},
                {type_id:'2', type_code:'CODING', desc:'Coding'},
                {type_id:'3', type_code:'IDENTIFICATION', desc:'Identification'}
            ];

            vm.questionDetails.choiceList = [
                {'choice_id':1, choice_code:'a', choice_desc:''},
                {'choice_id':2, choice_code:'b', choice_desc:''},
                {'choice_id':3, choice_code:'c', choice_desc:''},
                {'choice_id':4, choice_code:'d', choice_desc:''}
            ];

            vm.changeType = function(data){
                vm.questionDetails.answer = "";

                if (data.typeId == '1') {
                    vm.questionDetails.answer = 1;
                }
            };

            vm.submit = function(data) {
                if (vm.frmQuestion.$valid){
                    var dataCopy = angular.copy(data);

                    // multiple choices
                    if  (dataCopy.type_code == 'MULTIPLE_CHOICE') {
                        angular.forEach(dataCopy.choiceList, function(v,k){
                            if (dataCopy.answer == v.choice_code) {
                                v.is_correct = true;
                            } else {
                                v.is_correct = false;
                            }
                        });    
                    }
                    console.log(dataCopy);
                
                    var formData = angular.toJson(dataCopy);
                    QuestionSrvcs.save(formData)
                    .then(function(response){
                        console.log(response.data);
                    });
                } else {
                    vm.frmQuestion.withError = true;
                }
                
            };
        }

        AnswerQuestionCtrl.$inject = ['QuestionSrvcs', '$stateParams', '$sce', 'Notification', '$uibModal'];
        function AnswerQuestionCtrl(QuestionSrvcs, $stateParams, $sce, Notification, $uibModal){
            var vm = this;

            vm.questionDetails = {
                title:'How to be you po', 
                desc:'<div><!--block-->sdfsdfs<br><br></div><pre><!--block-->var sdfasd</pre>', 
                status:'', 
                student_name:'Rom',
                created_at:new Date('10/28/2017 14:00:01'), 
                category_code:'COMPOSITE', 
                category_desc:'Composite', 
                type_code:'IDENTIFICATION',
                type_desc:'Multiple Choice',
                answer:'B',
                choiceList : [
                    {'choice_id':1, choice_code:'a', choice_desc:'one'},
                    {'choice_id':2, choice_code:'b', choice_desc:'two'},
                    {'choice_id':3, choice_code:'c', choice_desc:'three'},
                    {'choice_id':4, choice_code:'d', choice_desc:'four'}    
                ],
                student_info: {
                    student_id:'1',                 
                    name:'Rom',
                    is_self:false,
                    has_answered:true,
                    students_answered: {
                        count:50,
                        correct_ans_count:10,
                        list : [
                            {'student_id':1, 'name':'Rom', 'answer':'a', is_correct:false, 'answered_at': new Date()},
                            {'student_id':2, 'name':'Mark', 'answer':'b', is_correct:false, 'answered_at': new Date()},
                            {'student_id':3, 'name':'John', 'answer':'a', is_correct:true, 'answered_at': new Date()},
                        ]
                    }                
                }
            };
            
            vm.onload = function(){
                // question description
                $( "#trix-toolbar-1" ).hide();

                // todo: load notif
                if (vm.questionDetails.student_info.is_self) {
                    Notification.info({message: 'You are viewing your own question.', positionY: 'bottom', positionX: 'right'});                
                }
                if (vm.questionDetails.student_info.has_answered) {
                    Notification.warning({message: 'You\'ve already answered this question.', positionY: 'bottom', positionX: 'right'});                
                }

            }();

            vm.submit = function(data){
                console.log(data);
                if(data.answer){
                    var dataCopy = angular.copy(data);

                    var formData = angular.toJson(dataCopy)
                    var modalInstance = $uibModal.open({
                        controller:'ModalInfoInstanceCtrl',
                        templateUrl:'question.question-rating-modal',
                        controllerAs: 'vm',
                        // resolve :{
                        //   formData: function () {
                        //     return {
                        //     //   title: 'Create People',
                        //     //   message: response.data.message
                        //     };
                        //   }
                        // }
                      });
      
                    //   modalInstance.result.then(function (){
                    //   },function (){
                    //   });
                    // QuestionSrvcs.saveAnswer(formData)
                    // .then(function(response){
                        
                    // });
                } else {
                    alert('Unable to submit.')
                }
            }
        }

        QuestionSrvcs.$inject = ['$http'];
        function QuestionSrvcs($http) {
            return {
                save: function(data) {
                  return $http({
                    method:'POST',
                    url: '/api/question/create',
                    data:data,
                    headers: {'Content-Type': 'application/json'}
                    })
                },
                saveAnswer: function(data) {
                    return $http({
                      method:'POST',
                      url: '/api/question/saveAnswer',
                      data:data,
                      headers: {'Content-Type': 'application/json'}
                      })
                  },
                get: function(data) {
                  return $http({
                    method:'GET',
                    data:data,
                    url: '/api/question/get',
                    headers: {'Content-Type': 'application/json'}
                  })
                },
                getCategories: function() {
                    return $http({
                        method:'GET',
                        data:null,
                        url: '/api/question/categories',
                        headers: {'Content-Type': 'application/json'}
                    })
                }
            };
        }
        

        ModalInfoInstanceCtrl.$inject = ['$uibModalInstance'];
        function ModalInfoInstanceCtrl ($uibModalInstance) {
          var vm = this;
          vm.formData = 'formData';
          vm.ok = function() {
            $uibModalInstance.close();
          };
  
          vm.cancel = function() {
            $uibModalInstance.dismiss('cancel');
          };
        }

})();