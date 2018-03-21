(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .factory('EmployeesSrvcs', EmployeesSrvcs)

        EmployeesSrvcs.$inject = ['$http'];
        function EmployeesSrvcs($http) {
            return {
            	employees: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: '/api/v1/employees?jobType='+data.jobType,
                        headers: {'Content-Type': 'application/json'}
                    })
                }
            };
        }
})();