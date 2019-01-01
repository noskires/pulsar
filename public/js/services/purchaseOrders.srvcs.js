(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .factory('PurchaseOrdersSrvcs', PurchaseOrdersSrvcs)

        PurchaseOrdersSrvcs.$inject = ['$http'];
        function PurchaseOrdersSrvcs($http) {
            return {
            	pos: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: '/api/v1/purchase-orders?poCode='+data.poCode+'&supplierCode='+data.supplierCode+'&status='+data.status,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                save: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/api/v1/purchase-order/save',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                update: function(data) {
                    return $http({ 
                        method: 'POST',
                        url: '/api/v1/purchase-order/update',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                poItems: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: '/api/v1/purchase-order-items?poCode='+data.poCode+'&poItemCode='+data.poItemCode,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                savePoItems: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/api/v1/purchase-order-items/save',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                removePoItems: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/api/v1/purchase-order-items/remove',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
            };
        }
})();