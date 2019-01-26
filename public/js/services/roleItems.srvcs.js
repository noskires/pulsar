(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .factory('RoleItemsSrvcs', RoleItemsSrvcs)

        RoleItemsSrvcs.$inject = ['$http'];
        function RoleItemsSrvcs($http) {
            return {
                list: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: '/api/v1/role-items?roleItemCode='+data.roleItemCode+'&roleCode='+data.roleCode,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                save: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/api/v1/role-item/save',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                update: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/api/v1/role-item/update',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                delete: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/api/v1/role-item/delete',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
            };
        }
})();