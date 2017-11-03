(function(){
    'use strict';
    angular
        .module('eApp',['ui.router', 'ui-notification', 'ngSanitize', 'ui.bootstrap', 'angularMoment', 'angularTrix'])
        .config(Config)
        .controller('TopNavCtrl',TopNavCtrl)

        Config.$inject = ['$stateProvider', '$urlRouterProvider', '$locationProvider', '$controllerProvider', '$compileProvider', '$filterProvider', '$provide', '$interpolateProvider']
        function Config($stateProvider, $urlRouterProvider, $locationProvider, $controllerProvider, $compileProvider, $filterProvider, $provide, $interpolateProvider){
            console.log("eApp here!");
            $interpolateProvider.startSymbol('<%');
            $interpolateProvider.endSymbol('%>');
            
            $locationProvider.html5Mode(true);
            
            $stateProvider
            // question
            .state('question-view', {
                url: '/question/view',
                controller: 'QuestionCtrl as qc',
                templateUrl: 'question.view'
            })
            .state('question-ask', {
                url: '/question/askquestion',
                controller: 'AskQuestionCtrl as aqc',
                templateUrl: 'question.ask-question'
            })
            .state('question-answer', {
                url: '/question/answerquestion/:questionCode',
                controller: 'AnswerQuestionCtrl as ansqc',
                templateUrl: 'question.answer-question'
            })
            // stock market
            .state('stockmarket-view', {
                url: '/stockmarket/view',
                controller: 'StockMarketCtrl as sc',
                templateUrl: 'stock-market.view'
            })
            .state('stockmarket-viewCategory', {
                url: '/stockmarket/category/:categorycode',
                controller: 'StockMarketCategoryCtrl as scc',
                templateUrl: 'stock-market.view-category'
            })
            .state('login-view', {
                url: '/login',
                // controller: 'LoginCtrl as lc',
                // templateUrl: 'login'
            })

            $urlRouterProvider.otherwise('/home');
        }


        TopNavCtrl.$inject = ['$window'];
        function TopNavCtrl($window) {
            var vm = this;

            vm.routeTo = function(route){
                $window.location.href = route;
            };
        };
})();