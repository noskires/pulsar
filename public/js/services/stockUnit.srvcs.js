(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .factory('StockUnitsSrvcs', StockUnitsSrvcs)
        
        StockUnitsSrvcs.$inject = ['$http'];
        function StockUnitsSrvcs($http) {
            return {
            	stockUnits: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: '/api/v1/stock-units?stockUnitCode='+data.stockUnitCode,
                        headers: {'Content-Type': 'application/json'}
                    })
                }
            };
        }
})();