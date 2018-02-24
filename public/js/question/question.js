(function(){
    'use strict';
    angular
        .module('eApp')
        .controller('QuestionCtrl',QuestionCtrl)
        .controller('AskQuestionCtrl',AskQuestionCtrl)
        .controller('AnswerQuestionCtrl',AnswerQuestionCtrl)
        .controller('ModalInfoInstanceCtrl',ModalInfoInstanceCtrl)
        .controller('ModalRateInstanceCtrl',ModalRateInstanceCtrl)
        .controller('ModalApprovalRemarksInstanceCtrl',ModalApprovalRemarksInstanceCtrl)
        .factory('QuestionSrvcs',QuestionSrvcs)

        QuestionCtrl.$inject = ['QuestionSrvcs', '$window'];
        function QuestionCtrl(QuestionSrvcs, $window){

            var vm = this;
            var data = {};

            vm.searchDet = {
                search_title:'',
                search_type:'ALL',
                rowPerPage:10,
                currentPage:1,
            };

            // QuestionSrvcs.get(data)
            // .then (function (response) {
            //   if (response.data.status == 200) {
            //     vm.questionList = response.data.data;
            //     // console.log(vm.questionList)
            //   }
            // },function(){ alert("Bad Request!")})

            vm.pageChanged = function(i) {
                console.log('Page changed to: ' + i);
            };

            QuestionSrvcs.TopStudents().then(function(response){
                    if(response.data.status == 200)
                    {
                        vm.leaderBoardList = response.data.data;
                        console.log(response.data);
                    }
                }, function() { alert('Bad Request!!!') })
 

            vm.search = function(data){
                var dataCopy = angular.copy(data);
                
                QuestionSrvcs.getByPage(dataCopy)
                .then (function (response) {
                    if (response.data.status == 200) {
                        vm.questionList = response.data.data;
                        vm.searchDet.totalItems = response.data.page.totalItems;
                    }
                },function(){ alert("Bad Request!")})
            };

            vm.search(data);            

             vm.routeTo = function(route){
                $window.location.href = route;
            }; 
        }

        AskQuestionCtrl.$inject = ['QuestionSrvcs', '$uibModal', '$window', '$location'];
        function AskQuestionCtrl(QuestionSrvcs, $uibModal, $window, $location){
            var vm = this;

           
            vm.questionDetails = {
                category_code: "ADAPTER",
                type_code:'IDENTIFICATION'
            };

            vm.identificationAnsList = [
                {answer:''}
            ];

            vm.defaultQuestionDet = angular.copy(vm.questionDetails);

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
                vm.display = {
                    loaded:false,
                    loading:true
                };

                if (vm.frmQuestion.$valid){
                    var dataCopy = angular.copy(data);
                    
                    var referrerUrl = document.referrer;
                    var i = referrerUrl.split(new $window.URL($location.absUrl()).origin);
                    var x = (i.length==2) ? i[1].split('/') : ['a','a'];
                    var fromUrl = x[1];

                    if (fromUrl == 'stockmarket') {
                        dataCopy['loggedForPlan'] = true;
                    }
                    // multiple choices
                    if  (dataCopy.type_code == 'MULTIPLE_CHOICE') {
                        var hasAnswer = false;
                        angular.forEach(dataCopy.choiceList, function(v,k){
                            if (dataCopy.answer == v.choice_code) {
                                v.is_correct = true;
                                hasAnswer = true;
                            } else {
                                v.is_correct = false;
                            }
                        });    

                        if (!hasAnswer){
                            return alert('Please select the correct answer.');
                        }
                    } else if  (dataCopy.type_code == 'IDENTIFICATION') {
                        dataCopy.answer = [];
                        angular.forEach(vm.identificationAnsList, function(v,k){
                            dataCopy.answer.push(v.answer);
                        });
                    }
                    console.log(dataCopy);
                
                    var formData = angular.toJson(dataCopy);
                    QuestionSrvcs.save(formData)
                    .then(function(response){
                        var modalInstance = $uibModal.open({
                            controller:'ModalInfoInstanceCtrl',
                            templateUrl:'shared.modal.info',
                            controllerAs: 'vm',
                            resolve :{
                              formData: function () {
                                return {
                                    title:'Question Creation',
                                    message:response.data.message
                                };
                              }
                            }
                        });
                        vm.questionDetails = angular.copy(vm.defaultQuestionDet);

                        modalInstance.result.then(function (e){
                            $window.location.href = '/question/view';                            
                        }, function () {
                            alert('Something went wrong.')
                        });
                        vm.display.loading = false;
                    });
                } else {
                    vm.frmQuestion.withError = true;
                }
                
            };

            vm.addAnsIdentif = function(){
                vm.identificationAnsList.push({answer:''});
            };

            vm.removeAnsIdentif = function(i){
                vm.identificationAnsList.splice(i,1);
            };


        }

        AnswerQuestionCtrl.$inject = ['QuestionSrvcs', '$stateParams', '$sce', 'Notification', '$uibModal', '$location','$browser', '$window'];
        function AnswerQuestionCtrl(QuestionSrvcs, $stateParams, $sce, Notification, $uibModal, $location, $browser, $window){
            var vm = this; 
            vm.questionDetails = {};
            
            vm.onload = function(hasNotif = true){

                if ($stateParams.questionCode) {
                    // load questions
                    var data = {
                        questionCode:$stateParams.questionCode
                    }
                    QuestionSrvcs.get(data)
                    .then(function(response){
                        vm.questionDetails = response.data.data[0];

                        if((vm.questionDetails.student_info.is_self || 
                            vm.questionDetails.student_info.has_answered) &&
                            (vm.questionDetails.type_code == 'MULTIPLE_CHOICE' || vm.questionDetails.type_code == 'CODING')){

                            vm.questionDetails.answer = vm.questionDetails.answer[0];
                        }
                        console.log(vm.questionDetails);

                        if (!vm.questionDetails){
                            alert('No record(s) found.');
                        }

                        // todo: load notif
                        if (hasNotif) {
                            if (vm.questionDetails.student_info.is_self) {
                                Notification.info({message: 'You are viewing your own question.', positionY: 'bottom', positionX: 'right'});                
                            }

                            if (vm.questionDetails.student_info.has_answered) {
                                Notification.warning({message: 'You\'ve already answered this question.', positionY: 'bottom', positionX: 'right'});                
                            }
                        }
                    
                    });

                 } else {
                     return alert('Something went wrong.');
                 }
                
                
                // question description
                $( "#trix-toolbar-1" ).hide();
            };
            vm.onload();

            vm.submit = function(data){
                console.log(data);
                if(data.answer){
                    var dataCopy = angular.copy(data);

                    var referrerUrl = document.referrer;
                    var i = referrerUrl.split(new $window.URL($location.absUrl()).origin);
                    var x = i[1].split('/');
                    var fromUrl = x[1];

                    if (fromUrl == 'stockmarket') {
                        dataCopy['loggedForPlan'] = true;
                    }


                    var formData = angular.toJson(dataCopy)
                    var modalInstance = $uibModal.open({
                        controller:'ModalRateInstanceCtrl',
                        templateUrl:'question.question-rating-modal',
                        controllerAs: 'vm',
                        resolve :{
                          formData: function () {
                            return dataCopy;
                          }
                        }
                      });
                    modalInstance.result.then(function (e){
                        $window.location.href = '/question/view';                            
                    }, function () {
                        alert('Something went wrong.')
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
            
            vm.action = function(data,actiontype, remarks){
                var formData = angular.copy(data);
                formData.action = actiontype;
                formData.remarks = remarks;

                var formDataCopy = angular.toJson(formData);

                if (formData.action == 'DECLINED') {
                    var modalInstance = $uibModal.open({
                        controller:'ModalApprovalRemarksInstanceCtrl',
                        templateUrl:'question.approval-remarks',
                        controllerAs: 'vm',
                        resolve :{
                          formData: function () {
                            return {
                                title:'Declining Question',
                                formData:formData
                            };
                          }
                        }
                    });
                    modalInstance.result.then(function (e){
                        $window.location.href = '/question/view';                            
                    }, function () {
                    });
                } else if (formData.action == 'APPROVED') { 
                    QuestionSrvcs.action(formDataCopy)
                    .then(function(response){
                        vm.response = response.data.data;
                        vm.onload();
                        var modalInstance = $uibModal.open({
                            controller:'ModalInfoInstanceCtrl',
                            templateUrl:'shared.modal.info',
                            controllerAs: 'vm',
                            resolve :{
                              formData: function () {
                                return {
                                    title:'Questions for approval',
                                    message:response.data.message
                                };
                              }
                            }
                        });
                        modalInstance.result.then(function (e){
                            $window.location.href = '/question/view';                            
                        }, function () {
                            alert('Something went wrong.')
                        });
                    },function(error){alert('Something went wrong.')});       
                }
            }

            vm.decline = function(data){
                console.log(data);
            }

            vm.actionAnswer = function(data, actionType, questionDet) {
                var formData = angular.copy(data);
                formData.action = actionType;
                formData.category_code = questionDet.category_code;
                formData.type_code = questionDet.type_code;

                var formDataCopy = angular.toJson(formData);
                QuestionSrvcs.actionAnswer(formDataCopy)
                .then(function(response){
                    console.log(response);
                    vm.onload(false);
                });
            }
        }

        ModalInfoInstanceCtrl.$inject = ['$uibModalInstance', 'formData'];
        function ModalInfoInstanceCtrl ($uibModalInstance, formData) {
            var vm = this;
            vm.formData = formData;
            vm.ok = function() {
                $uibModalInstance.close();
            };
            
            vm.close = function() {
                $uibModalInstance.close();
            };
        }


        ModalRateInstanceCtrl.$inject = ['$uibModalInstance', 'formData', 'QuestionSrvcs'];
        function ModalRateInstanceCtrl ($uibModalInstance, formData, QuestionSrvcs) {
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
                vm.ratingStatus = {};

                vm.formData.rating = (data) ? data.rating:null;
                if (vm.formData.rating) {
                    vm.ratingStatus.withError = false;
                    vm.submit(vm.formData);                    
                } else {
                    vm.ratingStatus.withError = true;
                }
            };

            vm.submit = function(data){
                if (data.answer) {
                    var formData = angular.toJson(data);
                    QuestionSrvcs.saveAnswer(formData)
                    .then(function(response){
                        vm.response = response.data;
                        if (vm.response.status == 200){
                            $uibModalInstance.close();
                            vm.close();
                        }
                    })
                } else {
                    return alert('Something went wrong.');
                }
            }
        }

        ModalApprovalRemarksInstanceCtrl.$inject = ['$uibModalInstance', 'formData', 'QuestionSrvcs'];
        function ModalApprovalRemarksInstanceCtrl ($uibModalInstance, formData, QuestionSrvcs) {
            var vm = this;
            vm.formData = formData.formData;
    
            vm.submit = function(data) {
                if(data.remarks){
                    var formDataCopy = angular.copy(vm.formData);
                    formDataCopy.remarks = data.remarks;

                    QuestionSrvcs.action(formDataCopy)
                    .then(function(response){
                        vm.response = response.data;
                        if (vm.response.status == 200) {
                            $uibModalInstance.close();
                            $window.location.href = '/question/view';
                        }
                    });
                }
            };
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
                    url: '/api/v1/question/get?questionCode='+data.questionCode+'&search_type='+data.search_type+'&search_title='+data.search_title,
                    headers: {'Content-Type': 'application/json'}
                  })
                },
                getByPage: function(data) {
                    return $http({
                      method:'GET',
                      data:data,
                      url: '/api/v1/question/getByPage?questionCode='+data.questionCode+'&search_type='+data.search_type+'&search_title='+data.search_title+'&rowPerPage='+data.rowPerPage+'&currentPage='+data.currentPage,
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
                action: function(data) {
                    return $http({
                        method:'POST',
                        data:data,
                        url:'/api/v1/question/action'
                    })
                },
                actionAnswer: function(data) {
                    return $http({
                        method:'POST',
                        data:data,
                        url:'/api/v1/question/actionAnswer'
                    })
                },
                leaderBoard: function(){
                    return $http({
                        method: 'GET',
                        data: null,
                        url: '/api/v1/question/leaderBoard'
                    })
                },
                TopStudents: function(){
                    return $http({
                        method: 'GET',
                        url: '/api/v1/top10/get',
                        headers: {'Content-Type': 'application/json'}
                    })
                },
            };
        }
})();
