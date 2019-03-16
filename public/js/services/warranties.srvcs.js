(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .factory('WarrantiesSrvcs', WarrantiesSrvcs)

        WarrantiesSrvcs.$inject = ['$http'];
        function WarrantiesSrvcs($http) {
            return {
            	warranties: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: '/api/v1/warranties?assetCode='+data.assetCode,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                save: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/api/v1/warranty/save',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                update: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/api/v1/warranty/update',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
            };
        }
})();