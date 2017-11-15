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

                ForumSrvcs.ForumList().then(function(response){
                    if(response.data.status == 200)
                    {
                        vm.forumList = response.data.data;
                        console.log(response.data);
                    }
                }, function() { alert('Bad Request!!!') })
                
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
                ForumList: function(data) {
                    return $http({
                        method: 'GET',
                        url: '/api/v1/forums/list',
                        data: null,
                        headers: {'Content-Type': 'application/json'}
                    })
                }
            };
        }
})();