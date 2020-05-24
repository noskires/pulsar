(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .factory('VouchersSrvcs', VouchersSrvcs)

        VouchersSrvcs.$inject = ['$http'];
        function VouchersSrvcs($http) {
            return {
            	vouchers: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: 'api/v1/vouchers?voucherCode='+data.voucherCode,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                save: function(data) {
                    return $http({
                        method: 'POST',
                        url: 'api/v1/voucher/save',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                update: function(data) {
                    return $http({
                        method: 'POST',
                        url: 'api/v1/voucher/update',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                voucherItems: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: 'api/v1/voucher-items?voucherCode='+data.voucherCode+'&voucherItemCode='+data.voucherItemCode,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                saveVoucherItems: function(data) {
                    return $http({
                        method: 'POST',
                        url: 'api/v1/voucher-items/save',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                removeVoucherItems: function(data) {
                    return $http({
                        method: 'POST',
                        url: 'api/v1/voucher-item/remove',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
            };
        }
})();