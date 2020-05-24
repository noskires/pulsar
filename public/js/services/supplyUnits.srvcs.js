(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .factory('SupplyUnitsSrvcs', SupplyUnitsSrvcs)

        SupplyUnitsSrvcs.$inject = ['$http'];
        function SupplyUnitsSrvcs($http) {
            return {
            	supplyUnits: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: 'api/v1/supply-unit?supplyUnitCode='+data.supplyUnitCode,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                save: function(data) {
                    return $http({
                        method: 'POST',
                        url: 'api/v1/supply-unit/save',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                update: function(data) {
                    return $http({
                        method: 'POST',
                        url: 'api/v1/supply-unit/update',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
            };
        }
})();