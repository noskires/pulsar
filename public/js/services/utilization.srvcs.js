(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .factory('UtilizationsSrvcs', UtilizationsSrvcs)

        UtilizationsSrvcs.$inject = ['$http'];
        function UtilizationsSrvcs($http) {
            return {
            	utilizations: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: 'api/v1/utilizations?utilizationCode='+data.utilizationCode+'&status='+data.status,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                save: function(data) {
                    return $http({
                        method: 'POST',
                        url: 'api/v1/utilization/save',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                update: function(data) {
                    return $http({ 
                        method: 'POST',
                        url: 'api/v1/utilization/update',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                utilizationItems: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: 'api/v1/utilization-items?utilizationCode='+data.utilizationCode+'&utilizationItemCode='+data.utilizationItemCode,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                saveUtilizationItems: function(data) {
                    return $http({
                        method: 'POST',
                        url: 'api/v1/utilization-item/save',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                removeUtilizationItems: function(data) {
                    return $http({
                        method: 'POST',
                        url: 'api/v1/utilization-item/remove',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
            };
        }
})();