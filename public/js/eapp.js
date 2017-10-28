(function(){
    'use strict';
    angular
        .module('eApp',['ui.router', 'angularMoment', 'angularTrix'])
        .config(Config)
        
        Config.$inject = ['$stateProvider', '$urlRouterProvider', '$locationProvider', '$controllerProvider', '$compileProvider', '$filterProvider', '$provide', '$interpolateProvider']
        function Config($stateProvider, $urlRouterProvider, $locationProvider, $controllerProvider, $compileProvider, $filterProvider, $provide, $interpolateProvider){
            console.log("eApp here!");
            $interpolateProvider.startSymbol('<%');
            $interpolateProvider.endSymbol('%>');
            
            $locationProvider.html5Mode(true);
            
            $stateProvider
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

            $urlRouterProvider.otherwise('/home');
        }
})();