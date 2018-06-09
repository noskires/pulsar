(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .factory('JobOrdersSrvcs', JobOrdersSrvcs)

        JobOrdersSrvcs.$inject = ['$http'];
        function JobOrdersSrvcs($http) {
            return {
            	jobOrders: function(data, joCode) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: '/api/v1/job-orders?joCode='+data.joCode+'&joStatus='+data.joStatus,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                save: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/api/v1/job-order/save',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                update: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/api/v1/job-order/update',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                // modal: function(data) {
                //     return $http({
                //         method: 'POST',
                //         url: '/api/v1/job-order/save',
                //         data: data,
                //         headers: {'Content-Type': 'application/json'}
                //     })
                // }
            };
        }
})();