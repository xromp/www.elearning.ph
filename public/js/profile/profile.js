(function(){
    'use strict';
    angular
        .module('eApp')
        .controller('ProfileCtrl', ProfileCtrl)
        .factory('ProfileSrvcs', ProfileSrvcs)

        ProfileCtrl.$inject = ['ProfileSrvcs', '$stateParams'];
        function ProfileCtrl(ProfileSrvcs, $stateParams) {

            if($stateParams.id)
            {
                // alert($stateParams.id);
            }

            var vm = this;

            vm.categoryList = [
                {category_code:'ADAPTER',description:'Adapter',answer_count:10, unanswer_count:2},
                {category_code:'COMPOSITE',description:'Composite',answer_count:12, unanswer_count:4},
                {category_code:'DECORATOR',description:'Decorator',answer_count:2, unanswer_count:3}
            ];

            vm.onLoad = function(){
                
            }();
        }

        ProfileSrvcs.$inject = ['$http'];
        function ProfileSrvcs ($http){
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