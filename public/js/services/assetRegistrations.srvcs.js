(function () {
    'use strict';
    angular
        .module('pulsarApp')
        .factory('AssetRegistrationsSrvcs', AssetRegistrationsSrvcs)

    AssetRegistrationsSrvcs.$inject = ['$http'];
    function AssetRegistrationsSrvcs($http) {
        return {
            list: function (data) {
                return $http({
                    method: 'GET',
                    data: data,
                    url: '/api/v1/asset-registrations?assetRegistrationCode='+data.assetRegistrationCode+'&assetCode'+data.assetCode,
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