(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .factory('InsuranceSrvcs', InsuranceSrvcs)

        InsuranceSrvcs.$inject = ['$http'];
        function InsuranceSrvcs($http) {
            return {
            	insurance: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: '/api/v1/insurance?insuranceCode='+data.insuranceCode,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                save: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/api/v1/insurance/save',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                update: function(data) {
                    return $http({ 
                        method: 'POST',
                        url: '/api/v1/insurance/update',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
            };
        }
})();