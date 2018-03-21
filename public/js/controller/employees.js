(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .controller('EmployeesCtrl', EmployeesCtrl) 

        EmployeesSrvcs.$inject = ['EmployeesSrvcs', '$window'];
        function EmployeesCtrl(EmployeesSrvcs, $window){
            var vm = this;
            var data = {}; 

            EmployeesSrvcs.employees().then (function (response) {
                if(response.data.status == 200)
                {
                    vm.employees = response.data.data;
                    console.log(vm.employees)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.routeTo = function(route){
                $window.location.href = route;
            };
        }
})();