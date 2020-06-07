(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .controller('Eula', Eula)

        Eula.$inject = ['$stateParams', '$window', '$uibModal'];
        function Eula($stateParams, $window, $uibModal){
            var vm = this;
            var data = {};

            vm.ok = function(){
                $uibModalInstance.close();
            };

            vm.routeTo = function(route){
                $window.location.href = route;
            }; 
        }

})();