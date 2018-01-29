(function(){
    'use strict';
    angular
        .module('eApp')
        .controller('LeaderboardCtrl', LeaderboardCtrl)
        .factory('LeaderboardSrvcs', LeaderboardSrvcs)

        LeaderboardCtrl.$inject = ['$scope', 'LeaderboardSrvcs', '$stateParams', '$window'];
        function LeaderboardCtrl($scope, LeaderboardSrvcs, $stateParams, $window) {
            var vm = this;
            // alert($stateParams.id);
            vm.onLoad = function(){

                $scope.question_ans = true;
                $scope.posted_questions = true;
                $scope.answered_questions = false;

                // LeaderboardSrvcs.LeaderBoard().then(function(response){
                //     if(response.data.status == 200)
                //     {
                //         vm.leaderBoardList = response.data.data;
                //         console.log(response.data);
                //     }
                // }, function() { alert('Bad Request!!!') })

                LeaderboardSrvcs.TopStudents().then(function(response){
                    if(response.data.status == 200)
                    {
                        vm.leaderBoardList = response.data.data;
                        console.log(response.data);
                    }
                }, function() { alert('Bad Request!!!') })

                //get other user data
                LeaderboardSrvcs.Users().then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.UserData = response.data.data;
                    }
                }, function (){ alert('Bad Request!!!') })


                LeaderboardSrvcs.Rewards().then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.students = response.data.data;
                        console.log(vm.students)
                    }
                }, function (){ alert('Bad Request!!!') })

            }();

            
            vm.search = function(data)
            {
                var dataCopy = angular.copy(data);

                LeaderboardSrvcs.FindUsers(dataCopy).then (function (response) {
                    if(response.data.status == 200 && response.data.data != null)
                    {
                        vm.students = response.data.data;
                        console.log(vm.students);
                    }
                    else
                    {
                        alert("No records found!");
                        LeaderboardSrvcs.Users().then (function (response) {
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

        LeaderboardSrvcs.$inject = ['$http'];
        function LeaderboardSrvcs ($http){
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
                        method: 'GET',
                        url: '/api/v1/achievements/get?search_name='+data.name,
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                Rewards: function(){
                    return $http({
                        method: 'GET',
                        url: '/api/v1/achievements/get',
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                TopStudents: function(){
                    return $http({
                        method: 'GET',
                        url: '/api/v1/top10/get',
                        headers: {'Content-Type': 'application/json'}
                    })
                }
            };
        }
})();