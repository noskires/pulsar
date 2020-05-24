(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .factory('MaintenanceSrvcs', MaintenanceSrvcs)

        MaintenanceSrvcs.$inject = ['$http'];
        function MaintenanceSrvcs($http) {
            return {
            	operations: function(data, joCode) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: 'api/v1/operations?operationCode='+data.operationCode,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                saveOperation: function(data) {
                    return $http({
                        method: 'POST',
                        url: 'api/v1/operation/save',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                update: function(data) {
                    return $http({
                        method: 'POST',
                        url: 'api/v1/operation/update',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                assetsMonitoring: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: 'api/v1/operations/assets-monitoring?assetCode='+data.assetCode,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
            };
        }
})();