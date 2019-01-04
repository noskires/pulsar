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
            };
        }
})();