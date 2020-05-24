(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .factory('SuppliersSrvcs', SuppliersSrvcs)

        SuppliersSrvcs.$inject = ['$http'];
        function SuppliersSrvcs($http) {
            return {
            	suppliers: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: 'api/v1/suppliers?supplierCode='+data.supplierCode,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                save: function(data) {
                    return $http({
                        method: 'POST',
                        url: 'api/v1/supplier/save',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                update: function(data) {
                    return $http({
                        method: 'POST',
                        url: 'api/v1/supplier/update',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
            };
        }
})();