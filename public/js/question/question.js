(function(){
    'use strict';
    angular
        .module('eApp')
        .controller('QuestionCtrl',QuestionCtrl)
        .controller('AskQuestionCtrl',AskQuestionCtrl)
        .controller('AnswerQuestionCtrl',AnswerQuestionCtrl)
        .controller('ModalInfoInstanceCtrl',ModalInfoInstanceCtrl)
        .factory('QuestionSrvcs',QuestionSrvcs)

        QuestionCtrl.$inject = ['QuestionSrvcs', '$window'];
        function QuestionCtrl(QuestionSrvcs, $window){

            var vm = this;
            var data = {};

            QuestionSrvcs.get(data)
            .then (function (response) {
              if (response.data.status == 200) {
                vm.questionList = response.data.data;
                console.log(vm.questionList)
              }
            },function(){ alert("Bad Request!")})

            vm.leaderBoardList = [
                {uid:'1', name:'John Doe', points:'30', hashedID: '9Vyn2EEQhC1ZFKzMYkqzj'},
                {uid:'2', name:'John Doe2', points:'24', hashedID: 'jJBg8sh3SD251403IGnIa'},
                {uid:'3', name:'John Doe3', points:'51', hashedID: 'mlhcGVXCMI3d1HhiRS57D'},
                {uid:'4', name:'John Doe4', points:'10', hashedID: 'CuNHGncUra4RzKVegJs1U'}
            ];

            QuestionSrvcs.leaderBoard().then(function(response){
                if(response.data.status == 200)
                {
                    vm.leaderBoardList = response.data.data;
                    console.log(response.data);
                }
            }, function() { alert('Bad Request!!!') })

             vm.routeTo = function(route){
                $window.location.href = route;
            };
        }

        AskQuestionCtrl.$inject = ['QuestionSrvcs'];
        function AskQuestionCtrl(QuestionSrvcs){
            var vm = this;

           
            vm.questionDetails = {
                category_code: "ADAPTER",
                type_code:'CODING'
            };

            QuestionSrvcs.getCategory()
            .then (function (response)  {
                if (response.data.status == 200) {
                    vm.categoryList = response.data.data;
                    console.log(vm.categoryList);
                }
            }, function() { alert("Bad Request!")})

            QuestionSrvcs.getType()
            .then (function (response)  {
                if (response.data.status == 200) {
                    vm.typeList = response.data.data;
                    console.log(vm.typeList);
                }
            }, function() { alert("Bad Request!")})

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

            vm.questionDetails = {};
            
            vm.onload = function(){

                if ($stateParams.questionCode) {
                    // load questions
                    var data = {
                        questionCode:$stateParams.questionCode
                    }
                    QuestionSrvcs.get(data)
                    .then(function(response){
                        vm.questionDetails = response.data.data[0];
                        console.log(vm.questionDetails.student_info.is_self);

                         // todo: load notif
                        if (vm.questionDetails.student_info.is_self) {
                            Notification.info({message: 'You are viewing your own question.', positionY: 'bottom', positionX: 'right'});                
                        }
                        if (vm.questionDetails.student_info.has_answered) {
                            Notification.warning({message: 'You\'ve already answered this question.', positionY: 'bottom', positionX: 'right'});                
                        }
                    });
                 } else {
                     return alert('Something went wrong.');
                 }
                
                
                // question description
                $( "#trix-toolbar-1" ).hide();
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
                        resolve :{
                          formData: function () {
                            return dataCopy;
                          }
                        }
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

         // TopNavCtrl.$inject = ['$window'];
         //    function TopNavCtrl($window) {
         //        var vm = this;

         //        vm.routeTo = function(route){
         //            $window.location.href = route;
         //        };
         //    };

        ModalInfoInstanceCtrl.$inject = ['$uibModalInstance', 'formData', 'QuestionSrvcs'];
        function ModalInfoInstanceCtrl ($uibModalInstance, formData, QuestionSrvcs) {
            var vm = this;
            vm.formData = formData;

            vm.close = function() {
                $uibModalInstance.close();
            };
    
            vm.skipSubmit = function(data) {
                vm.formData.rating = '';
                vm.submit(vm.formData);
                // $uibModalInstance.dismiss('cancel');
            };

            vm.rateSubmit = function(data){
                vm.formData.rating = data.rating;
                vm.submit(vm.formData);
            };

            vm.submit = function(data){
                if (data.answer) {
                    var formData = angular.toJson(data);

                    QuestionSrvcs.saveAnswer(formData)
                    .then(function(response){
                        console.log(response);
                    })
                } else {
                    return alert('Something went wrong.');
                }
            }
        }

        QuestionSrvcs.$inject = ['$http'];
        function QuestionSrvcs($http) {
            return {
                save: function(data) {
                  return $http({
                    method:'POST',
                    url: '/api/v1/question/create',
                    data:data,
                    headers: {'Content-Type': 'application/json'}
                    })
                },
                saveAnswer: function(data) {
                    return $http({
                      method:'POST',
                      url: '/api/v1/answer/save',
                      data:data,
                      headers: {'Content-Type': 'application/json'}
                      })
                  },
                get: function(data) {
                  return $http({
                    method:'GET',
                    data:data,
                    url: '/api/v1/question/get?questionCode='+data.questionCode,
                    headers: {'Content-Type': 'application/json'}
                  })
                },
                updateRatings: function(data) {
                    return $http({
                        method:'POST',
                        url:'/api/question/updateRating',
                        data:data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                getCategory: function() {
                    return $http({
                        method:'GET',
                        data:null,
                        url: '/api/v1/category/get',
                        
                    })
                },
                getType: function() {
                    return $http({
                        method:'GET',
                        data:null,
                        url: '/api/v1/type/get',
                        
                    })
                },
                leaderBoard: function(){
                    return $http({
                        method: 'GET',
                        data: null,
                        url: '/api/v1/question/leaderBoard'
                    })
                }
            };
        }
})();