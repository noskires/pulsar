(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .factory('ModulesSrvcs', ModulesSrvcs)

        ModulesSrvcs.$inject = ['$http'];
        function ModulesSrvcs($http) {
            return {
                list: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: '/api/v1/modules?moduleCode='+data.moduleCode,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                save: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/api/v1/module/save',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                update: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/api/v1/module/update',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                delete: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/api/v1/module/delete',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
            };
        }
})();