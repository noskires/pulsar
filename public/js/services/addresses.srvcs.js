(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .factory('AddressesSrvcs', AddressesSrvcs)

        AddressesSrvcs.$inject = ['$http'];
        function AddressesSrvcs($http) {
            return {
            	region: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: '/api/v1/regions',
                        // url: '/api/v1/region?jobType='+data.jobType,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                province: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: '/api/v1/provinces?region_code='+data.region_code,
                        // url: '/api/v1/region?jobType='+data.jobType,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                municipality: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: '/api/v1/municipalities?province_code='+data.province_code,
                        headers: {'Content-Type': 'application/json'}
                    })
                }
            };
        }
})();