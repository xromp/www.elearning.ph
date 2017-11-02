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

            vm.categoryList = [
                {category_code:'ADAPTER',description:'Adapter',answer_count:10, unanswer_count:2},
                {category_code:'COMPOSITE',description:'Composite',answer_count:12, unanswer_count:4},
                {category_code:'DECORATOR',description:'Decorator',answer_count:2, unanswer_count:3}
            ];

            vm.onLoad = function(){

            }();

        }

        StockMarketCategoryCtrl.$inject = ['StockMarketSrvcs','$state', '$location', '$window'];
        function StockMarketCategoryCtrl(StockMarketSrvcs, $state, $location, $window){
            var vm = this;

            vm.categoryDetails = {
                description:'Adapter',
                list : [
                    {question_code:'Q0101-001', title:'How to be you po', no_of_answers:10, status:'', is_self:true, student_id:'1', student_name:'Rom', created_at:new Date('10/28/2017 14:00:01'), category:'Composite', type:'Coding'},
                    {question_code:'Q0101-002', title:'How to be you po', no_of_answers:10, status:'', is_self:false, student_id:'1', student_name:'Rom', created_at:new Date('10/28/2017 10:00:01'), category:'Composite', type:'Multiple Choice'},
                    {question_code:'Q0101-003', title:'How to be you po', no_of_answers:10, status:'', is_self:true, student_id:'1', student_name:'Rom', created_at:new Date('10/27/2017 14:00:01'), category:'Composite', type:'Coding'}
                ]
            };

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
                }
            };
        }
})();