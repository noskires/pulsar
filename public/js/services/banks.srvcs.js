(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .factory('BanksSrvcs', BanksSrvcs)

        BanksSrvcs.$inject = ['$http'];
        function BanksSrvcs($http) {
            return {
            	banks: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: 'api/v1/banks?bankCode='+data.bankCode,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                save: function(data) {
                    return $http({
                        method: 'POST',
                        url: 'api/v1/bank/save',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                update: function(data) {
                    return $http({ 
                        method: 'POST',
                        url: 'api/v1/bank/update',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
            };
        }
})();