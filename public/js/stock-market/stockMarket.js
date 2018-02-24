(function(){
    'use strict';
    angular
        .module('eApp')
        .controller('StockMarketCtrl',StockMarketCtrl)
        .controller('StockMarketCategoryCtrl',StockMarketCategoryCtrl)
        .factory('StockMarketSrvcs',StockMarketSrvcs)

        StockMarketCtrl.$inject = ['StockMarketSrvcs'];
        function StockMarketCtrl(StockMarketSrvcs) {
            var vm = this;

            vm.onLoad = function(){
                // load category
                StockMarketSrvcs.getWithAnswer()
                .then(function(response){
                    vm.categoryList = response.data.data;                    
                },function(error){alert('Something went wrong');})
            }();


        }

        StockMarketCategoryCtrl.$inject = ['StockMarketSrvcs','$state', '$stateParams', '$location', '$window'];
        function StockMarketCategoryCtrl(StockMarketSrvcs, $state, $stateParams, $location, $window){
            var vm = this;

            // vm.categoryDetails = {
            //     description:'Adapter',
            //     list : [
            //         {question_code:'Q0101-001', title:'How to be you po', no_of_answers:10, status:'', is_self:true, student_id:'1', student_name:'Rom', created_at:new Date('10/28/2017 14:00:01'), category:'Composite', type:'Coding'},
            //         {question_code:'Q0101-002', title:'How to be you po', no_of_answers:10, status:'', is_self:false, student_id:'1', student_name:'Rom', created_at:new Date('10/28/2017 10:00:01'), category:'Composite', type:'Multiple Choice'},
            //         {question_code:'Q0101-003', title:'How to be you po', no_of_answers:10, status:'', is_self:true, student_id:'1', student_name:'Rom', created_at:new Date('10/27/2017 14:00:01'), category:'Composite', type:'Coding'}
            //     ]
            // };

            vm.onLoad = function(){
                console.log($stateParams.categoryCode)
                if ($stateParams.categoryCode) {
                    var data = {
                        categoryCode:$stateParams.categoryCode
                    };
                    
                    StockMarketSrvcs.getByCategory(data)
                    .then(function(response){
                        if (response.data.count){
                            vm.categoryDetails = {
                                description: data.categoryCode,
                                list: response.data.data
                            }    
                        } else {
                            // return alert('No record(s) found.');
                        }
                    },function(error){alert('Something went wrong.')});

                } else {
                    return alert('Something went wrong.')
                }
            }();

            vm.askQuestion = function(stateName){
                $window.location.href ='/question/askquestion';
            }
            vm.viewQuestion = function(data){
                $window.location.href ='/question/answerquestion/'+data.question_code;
            }
            
        };

        StockMarketSrvcs.$inject = ['$http'];
        function StockMarketSrvcs ($http){
            return {
                save: function(data) {
                  return $http({
                    method:'POST',
                    url: '/api/question/create',
                    data:data,
                    headers: {'Content-Type': 'application/json'}
                    })
                },
                getWithAnswer: function(data) {
                    return $http({
                      method:'GET',
                      url: '/api/v1/category/getWithAnswer',
                      data:data,
                      headers: {'Content-Type': 'application/json'}
                      })
                },
                getByCategory: function(data) {
                    return $http({
                        method:'GET',
                        url: '/api/v1/question/get?categoryCode='+data.categoryCode,
                        data:data,
                        headers: {'Content-Type': 'application/json'}  
                    })
                }
            }
        }
})();