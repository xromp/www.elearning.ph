(function(){
    'use strict';
    angular
        .module('eApp')
        .controller('ProfileCtrl', ProfileCtrl)
        .factory('ProfileSrvcs', ProfileSrvcs)

        ProfileCtrl.$inject = ['$scope', 'ProfileSrvcs', '$stateParams'];
        function ProfileCtrl($scope, ProfileSrvcs, $stateParams) {
            var vm = this;
            vm.onLoad = function(){

                $scope.question_ans = true;
                $scope.posted_questions = true;
                $scope.answered_questions = false;
            }();
            
            //get user data
            
            //get other user data
            ProfileSrvcs.OtherUser({hashedID:$stateParams.id}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.UserData = response.data.data;
                    vm.UserName = vm.UserData.fName + " " + vm.UserData.lName;
                    console.log("user = "+vm.UserName)
                }
            }, function (){ alert('Bad Request!!!') })

          
            ProfileSrvcs.PostedQuestions({hashedID:$stateParams.id}).then (function (response) {
                console.log(response.data)
                if(response.data.status == 200)
                {
                    if(response.data.isSelf == "true")
                    {
                        vm.questionList = response.data.data;
                        console.log(vm.questionList)
                    }
                    else
                    {
                        $scope.question_ans = false;
                    }
                }
            }, function(){ alert('Bad Request!')})
            
            //get achievements

            ProfileSrvcs.Achievements({hashedID:$stateParams.id}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.achievements = response.data.data;
                    console.log(vm.achievements)
                }
            }, function (){ alert('Bad Request!!!') })


            $scope.ShowHidQuestionAns = function(status)
            {
                if(status == 1)
                {
                    $scope.posted_questions = true;
                    $scope.answered_questions = false;
                }
                else
                {
                    $scope.posted_questions = false;
                    $scope.answered_questions = true;
                }
            }
            
        }

        ProfileSrvcs.$inject = ['$http'];
        function ProfileSrvcs ($http){
            return {
                User: function(data) {
                    return $http({
                        method: 'GET',
                        url: '/api/v1/profile/user',
                        data: null,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                OtherUser: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/api/v1/profile/otherUser',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                PostedQuestions: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/api/v1/profile/postedQuestions',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                Achievements: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/api/v1/achievements/Achievements',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                }

            };
        }
})();