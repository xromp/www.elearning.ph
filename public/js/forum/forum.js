(function(){
    'use strict';
    angular
        .module('eApp')
        .controller('ForumCtrl', ForumCtrl)
        .factory('ForumSrvcs', ForumSrvcs)

        ForumCtrl.$inject = ['$scope', 'ForumSrvcs', '$stateParams', '$window'];
        function ForumCtrl($scope, ForumSrvcs, $stateParams, $window) {
            var vm = this;
            // alert($stateParams.id);
            vm.onLoad = function(){
                alert('forum');
                
                $scope.question_ans = true;
                $scope.posted_questions = true;
                $scope.answered_questions = false;

                ForumSrvcs.LeaderBoard().then(function(response){
                    if(response.data.status == 200)
                    {
                        vm.leaderBoardList = response.data.data;
                        console.log(response.data);
                    }
                }, function() { alert('Bad Request!!!') })

                //get other user data
                ForumSrvcs.Users().then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.UserData = response.data.data;
                    }
                }, function (){ alert('Bad Request!!!') })
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
                Users: function(data) {
                    return $http({
                        method: 'GET',
                        url: '/api/v1/leaderboard/users',
                        data: null,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                LeaderBoard: function(data) {
                    return $http({
                        method: 'GET',
                        url: '/api/v1/leaderboard/topScorers',
                        data: null,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                FindUsers: function(data){
                    return $http({
                        method: 'POST',
                        url: '/api/v1/leaderboard/find',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                }
            };
        }
})();