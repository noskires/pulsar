(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .factory('ReceiptSrvcs', ReceiptSrvcs)

        ReceiptSrvcs.$inject = ['$http'];
        function ReceiptSrvcs($http) {
            return {
            	receipts: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: '/api/v1/receipts?receiptCode='+data.receiptCode,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                save: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/api/v1/receipt/save',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                update: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/api/v1/receipt/update',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                receiptItems: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: '/api/v1/receipt-items?receiptCode='+data.receiptCode+'&receiptItemCode='+data.receiptItemCode,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                saveReceiptItems: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/api/v1/receipt-items/save',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
            };
        }
})();