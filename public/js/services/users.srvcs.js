(function () {
    'use strict';
    angular
        .module('pulsarApp')
        .factory('UsersSrvcs', UsersSrvcs)

    UsersSrvcs.$inject = ['$http'];

    function UsersSrvcs($http) {
        return {
            list: function (data) {
                return $http({
                    method: 'GET',
                    data: data,
                    url: '/api/v1/users?userCode=' + data.userCode + '&isSelfOnly=' + data.isSelfOnly,
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
            },
            save: function (data) {
                return $http({
                    method: 'POST',
                    url: '/api/v1/user/save',
                    data: data,
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
            },
            update: function (data) {
                return $http({
                    method: 'POST',
                    url: '/api/v1/user/update',
                    data: data,
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
            },
            resetPassword: function (data) {
                return $http({
                    method: 'POST',
                    url: '/api/v1/user/reset-password',
                    data: data,
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
            }
        };
    }
})();