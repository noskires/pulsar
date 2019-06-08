(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .factory('SuppliesSrvcs', SuppliesSrvcs)

        SuppliesSrvcs.$inject = ['$http'];
        function SuppliesSrvcs($http) {
            return {
            	supplies: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: '/api/v1/supplies?supplyCode='+data.supplyCode+'&quantityStatus='+data.quantityStatus+'&supplyCategory='+data.supplyCategory+'&isRepair='+data.isRepair,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                save: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/api/v1/supply/save',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                update: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/api/v1/supply/update',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
            };
        }
})();