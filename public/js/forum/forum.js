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
                vm.forumList = [
                    {title:'1234567890-1234567890-1234567890-1234567890-1234567890-1234567890-1234567890-1234567890-1234567890-1234567890-1234567890-1234567890-1234567890-1234567890-',desc:'This is desc',count:2, created_at:'1/1/2017',show_comment:false,
                        comments:[
                            {name:'Penaflor, Rommel A.', comment:'This is a sample comment'},
                            {name:'Penaflor, Rommel A.', comment:'This is a sample comment2'},
                            {name:'Penaflor, Rommel A.', comment:'This is a sample comment3'},
                            {name:'Penaflor, Rommel A.', comment:'This is a sample comment4'}
                        ]
                    },
                    {title:'How to one?',count:2, created_at:'1/1/2017'},
                    {title:'How to one?',count:2, created_at:'1/1/2017'},
                    {title:'How to one?',count:2, created_at:'1/1/2017'},
                    {title:'How to one?',count:2, created_at:'1/1/2017'},
                    {title:'How to one?',count:2, created_at:'1/1/2017'}
                ];

                // ForumSrvcs.get().then(function(response){
                //     if(response.data.status == 200)
                //     {
                //         vm.forumList = response.data.data;
                        
                //         console.log(response.data);
                //     }
                // }, function() { alert('Bad Request!!!') })
            }();

            vm.showComment = function(data) {
                data.show_comment = (data.show_comment) ? false : true;
            };
            
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
                get: function(data) {
                    return $http({
                        method: 'GET',
                        url: '/api/v1/forum/get',
                        headers: {'Content-Type': 'application/json'}
                    })
                }
            };
        }
})();