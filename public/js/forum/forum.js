(function(){
    'use strict';
    angular
        .module('eApp')
        .controller('ForumCtrl', ForumCtrl)
        .controller('ForumCreateTopicCtrl', ForumCreateTopicCtrl)
        .controller('ModalInfoInstanceCtrl',ModalInfoInstanceCtrl)
        .factory('ForumSrvcs', ForumSrvcs)

        ForumCtrl.$inject = ['$scope', 'ForumSrvcs', '$stateParams', '$window'];
        function ForumCtrl($scope, ForumSrvcs, $stateParams, $window) {

            var vm = this;

            vm.onLoad = function(){
                var data = {}
                ForumSrvcs.get(data)
                .then (function (response) {
                    if (response.data.status == 200) {
                        vm.forumList = response.data.data;
                    }
                },function(){ alert("Bad Request!")})

            }();

            vm.showComment = function(data) {
                angular.forEach(vm.forumList, function(v,k){
                    if (v.forum_id != data.forum_id) {
                        v.show_comment= false;                        
                    }
                });
                data.show_comment = (data.show_comment) ? false : true;
                data.comment = '';
            };
            
            vm.submitComment = function(data, forumId, student_id){
                vm.display = {
                    loading:true
                };

                if (vm.frmComment.$valid) {
                    var dataCopy = angular.copy(data);
                    dataCopy.forumId = forumId;
                    dataCopy.student_id = student_id;

                    var formData = angular.toJson(dataCopy);
                    ForumSrvcs.saveComment(formData)
                    .then(function(response){
                        if (response.data.status == 200) {
                            data.comment = '';
                            ForumSrvcs.get(dataCopy)
                            .then (function (responseComments) {
                                if (responseComments.data.status == 200) {
                                    angular.forEach(vm.forumList, function(v,k){
                                        if (v.forum_id == dataCopy.forumId) {
                                            var latest = responseComments.data.data[0];
                                            v.comments_count = latest.comments_count;
                                            v.comments = latest.comments;
                                        }
                                    })
                                    
                                }
                            },function(){ alert("Bad Request!")})
                            vm.display.loading = false;
                        }
                    }, function () {
                        alert('Something went wrong.')
                    });
                } else {
                    vm.frmComment.withError = true;
                }
            };
        }

        ForumCreateTopicCtrl = ['$scope','ForumSrvcs', '$stateParams', '$window' ,'$uibModal']
        function ForumCreateTopicCtrl($scope, ForumSrvcs, $stateParams, $window, $uibModal) {
            var vm = this;
            vm.submit = function(data){
                vm.display = {
                    loading:true
                };

                if (vm.frmForum.$valid) {
                    var dataCopy = angular.copy(data);

                    var formData = angular.toJson(dataCopy);
                    ForumSrvcs.save(formData)
                    .then(function(response){
                        if (response.data.status == 200) {
                            var modalInstance = $uibModal.open({
                                controller:'ModalInfoInstanceCtrl',
                                templateUrl:'shared.modal.info',
                                controllerAs: 'vm',
                                resolve :{
                                formData: function () {
                                    return {
                                        title:'Forum Creation',
                                        message:response.data.message
                                    };
                                }
                                }
                            });
                            modalInstance.result.then(function (e){
                                $window.location.href = '/forum/index';                            
                            }, function () {
                                alert('Something went wrong.')
                            });
                            vm.display.loading = false;
                        }
                    });
                } else {
                    vm.frmForum.withError = true;
                }
            };

            vm.goBack = function() {
                $window.location.href = '/forum/index';
            };
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

        ForumSrvcs.$inject = ['$http'];
        function ForumSrvcs ($http){
            return {
                get: function(data) {
                    return $http({
                        method: 'GET',
                        url: '/api/v1/forum/get?forumId='+data['forumId'],
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                save: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/api/v1/forum/save',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                saveComment: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/api/v1/forum/savecomment',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                }
            };
        }
})();