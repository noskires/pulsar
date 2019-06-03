(function () {
    'use strict';
    angular
        .module('pulsarApp')
        .factory('AssetRegistrationsSrvcs', AssetRegistrationsSrvcs)

    AssetRegistrationsSrvcs.$inject = ['$http'];
    function AssetRegistrationsSrvcs($http) {
        return {
            funds: function (data) {
                return $http({
                    method: 'GET',
                    data: data,
                    url: '/api/v1/asset-registrations?registrationCode=' + data.registrationCode,
                    headers: { 'Content-Type': 'application/json' }
                })
            },
            save: function (data) {
                return $http({
                    method: 'POST',
                    url: '/api/v1/asset-registration/save',
                    data: data,
                    headers: { 'Content-Type': 'application/json' }
                })
            },
            update: function (data) {
                return $http({
                    method: 'POST',
                    url: '/api/v1/asset-registration/update',
                    data: data,
                    headers: { 'Content-Type': 'application/json' }
                })
            }
        };
    }
})();