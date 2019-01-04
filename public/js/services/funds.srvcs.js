(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .factory('FundsSrvcs', FundsSrvcs)

        FundsSrvcs.$inject = ['$http'];
        function FundsSrvcs($http) {
            return {
                funds: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: '/api/v1/funds?fundCode='+data.fundCode,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                save: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/api/v1/fund/save',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                update: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/api/v1/fund/update',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                fundItems: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: '/api/v1/fund-items?fundCode='+data.fundCode+'&fundItemCode='+data.fundItemCode,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                saveFundItems: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/api/v1/fund-item/save',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                removeFundItems: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/api/v1/fund-items/remove',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
            };
        }
})();