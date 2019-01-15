(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .factory('AresSrvcs', AresSrvcs)

        AresSrvcs.$inject = ['$http'];
        function AresSrvcs($http) {
            return {
            	ares: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: '/api/v1/are?areCode='+data.areCode,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                save: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/api/v1/are/save',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                update: function(data) {
                    return $http({ 
                        method: 'POST',
                        url: '/api/v1/are/update',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                areItems: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: '/api/v1/are-items?areCode='+data.areCode+'&areItemCode='+data.areItemCode+'&areItemCode='+data.assetCode,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                saveAreItems: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/api/v1/are-items/save',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                removeAreItems: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/api/v1/are-items/remove',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
            };
        }
})();