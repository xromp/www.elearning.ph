(function(){
    'use strict';
    angular
        .module('eApp')
        .controller('ForumCtrl', ForumCtrl)
        .factory('ForumSrvcs', ForumSrvcs)

        ForumCtrl.$inject = ['$scope', 'ForumSrvcs', '$stateParams', '$window'];
        function ForumCtrl($scope, ForumSrvcs, $stateParams, $window) {

            var vm = this;
            vm.onLoad = function(){
<<<<<<< HEAD
                
                ForumSrvcs.get().then(function(response){
=======

                ForumSrvcs.ForumList().then(function(response){
>>>>>>> 628070d120e3e80b0a09d8862b95db978984f564
                    if(response.data.status == 200)
                    {
                        vm.forumList = response.data.data;
                        console.log(response.data);
                    }
                }, function() { alert('Bad Request!!!') })
<<<<<<< HEAD
=======
                
>>>>>>> 628070d120e3e80b0a09d8862b95db978984f564
            }();

            
            $scope.search = function(name)
            {
                ForumSrvcs.FindUsers({fName:name}).then (function (response) {
                    if(response.data.status == 200 && response.data.data != null)
                    {
                        vm.UserData = response.data.data;
                        console.log(vm.UserData);
                    }
                    else
                    {
                        alert("No records found!");
                        ForumSrvcs.Users().then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.UserData = response.data.data;
                            }
                        }, function (){ alert('Bad Request!!!') })
                    }

                }, function (){ alert('Bad Request!!!') })
            }

            vm.routeTo = function(route){
                $window.location.href = route;
            };
        }

        ForumSrvcs.$inject = ['$http'];
        function ForumSrvcs ($http){
            return {
<<<<<<< HEAD
                get: function(data) {
                    return $http({
                        method: 'GET',
                        url: '/api/v1/forum/get',
=======
                ForumList: function(data) {
                    return $http({
                        method: 'GET',
                        url: '/api/v1/forums/list',
                        data: null,
>>>>>>> 628070d120e3e80b0a09d8862b95db978984f564
                        headers: {'Content-Type': 'application/json'}
                    })
                }
            };
        }
})();