(function(){
    'use strict';
    angular
        .module('eApp')
        .controller('ProfileCtrl', ProfileCtrl)
        .factory('ProfileSrvcs', ProfileSrvcs)

        ProfileCtrl.$inject = ['$scope', 'ProfileSrvcs', '$stateParams', '$window'];
        function ProfileCtrl($scope, ProfileSrvcs, $stateParams, $window) {
            var vm = this;
            vm.onLoad = function(){

                vm.questionsWarning = false;
                vm.tabs = [
                    {"id":2, "title":"Posted Questions", "status":"active", "code":"PostedQuestions", "isSelf":true},
                    {"id":3, "title":"Answered Questions", "status":null, "code":"AnsweredQuestions", "isSelf":false},
                    {"id":1, "title":"Rewards", "status":null, "code":"Rewards", "isSelf":true}
                ];

                vm.dataView = "PostedQuestions";
            }();
 
            vm.routeTo = function(qc) {
                $window.location.href ='/question/answerquestion/'+qc;
            };

            $scope.tabs = function(value)
            {
                // alert(value);
                angular.forEach(vm.tabs, function(v, k){
                    v.status = null;
                    if(v.id == value)
                    {
                        v.status = "active";
                        vm.dataView = v.code;
                    }
                })
            }

            ProfileSrvcs.OtherUser({hashedID:$stateParams.id}).then (function (response) {
                 
                if(response.data.status == 200)
                {
                    vm.UserData = response.data.data;
                    vm.UserName = vm.UserData.fName + " " + vm.UserData.lName;

                    ProfileSrvcs.Rewards({student_id:vm.UserData.student_id}).then (function (response) {
                        if(response.data.status == 200)
                        {
                            vm.students = response.data.data;
                            // console.log(vm.students[0])
                        }
                    }, function (){ alert('Bad Request!!!') })
        
                    //points
                    ProfileSrvcs.Points({student_id:vm.UserData.student_id}).then (function (response) {
                        if(response.data.status == 200)
                        {
                            vm.points = response.data.data;
                            // console.log(vm.points)
                        }
                    }, function (){ alert('Bad Request!!!') })

                    ProfileSrvcs.AnsweredQuestions({studentId:vm.UserData.student_id}).then (function (response) {
                        // console.log(response.data)
                        if(response.data.status == 200)
                        {
                            vm.isSelf = true;
                            vm.answeredQuestionList = response.data.data;
                            vm.tabs[1].isSelf = true;
                            // console.log(vm.answeredQuestionList)
                        }
                        else if(response.data.status == 403)
                        {
                            vm.isSelf = false;
                            vm.tabs[1].isSelf = false;
                        }

                    }, function(){ alert('Bad Request!')})

                }
            }, function (){alert('Bad Request!!!')})
          



            ProfileSrvcs.PostedQuestions({hashedID:$stateParams.id}).then (function (response) {
                // 

                if(response.data.status == 200)
                {
                    vm.questionList = response.data.data;
                    console.log(response.data.data)

                    if(Object.keys(vm.questionList).length == 0)
                    {
                        vm.questionsWarning = true;
                    }

                    console.log(vm.questionsWarning)
                    
                }
            }, function(){ alert('Bad Request!')})

            //get achievements
            ProfileSrvcs.Achievements({hashedID:$stateParams.id}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.achievements = response.data.data;
                    // console.log(vm.achievements)
                }
            }, function (){ alert('Bad Request!!!') })
        }

        ProfileSrvcs.$inject = ['$http', '$stateParams'];
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
                AnsweredQuestions: function(data) {
                    return $http({
                        method: 'GET',
                        url: '/api/v1/answer/getAnsweredBySelf?studentId='+data.studentId,
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
                },
                Rewards: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: '/api/v1/achievements/get?studentId='+data.student_id,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                Points: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: '/api/v1/points/getStudentTotalPoints?studentId='+data.student_id,
                        headers: {'Content-Type': 'application/json'}
                    })
                }

            };
        }


})();