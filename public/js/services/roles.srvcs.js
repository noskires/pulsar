(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .factory('RolesSrvcs', RolesSrvcs)

        RolesSrvcs.$inject = ['$http'];
        function RolesSrvcs($http) {
            return {
                list: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: '/api/v1/roles?roleCode='+data.roleCode,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                save: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/api/v1/role/save',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                update: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/api/v1/role/update',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                }
            };
        }
})();