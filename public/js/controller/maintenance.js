(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .controller('OperationCtrl', OperationCtrl)
        .controller('ListOperatingCtrl', ListOperatingCtrl)
        .factory('MainSrvcs',MainSrvcs)
        
        OperationCtrl.$inject = ['MainSrvcs', '$window'];
        function OperationCtrl(MainSrvcs, $window){
            alert('a');
            var vm = this;
            var data = {};

            // alert('this is main controller')
            
            vm.routeTo = function(route){
                $window.location.href = route;
            }; 
        }
        
        ListOperatingCtrl.$inject = ['MainSrvcs', '$window'];
        function ListOperatingCtrl(MainSrvcs, $window){
            var vm = this;
            var data = {};
            
            // alert('this is list controller')
            
            vm.routeTo = function(route){
                $window.location.href = route;
            }; 
        }

        MainSrvcs.$inject = ['$http'];
        function MainSrvcs($http) {
            return {
            };
        }
})();