(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .factory('SupplyCategoriesSrvcs', SupplyCategoriesSrvcs)

        SupplyCategoriesSrvcs.$inject = ['$http'];
        function SupplyCategoriesSrvcs($http) {
            return {
            	SupplyCategories: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: '/api/v1/supplies-category?supplyCategoryCode='+data.supplyCategoryCode,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                save: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/api/v1/supply-category/save',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                update: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/api/v1/supply-category/update',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
            };
        }
})();