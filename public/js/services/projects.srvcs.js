(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .factory('ProjectsSrvcs', ProjectsSrvcs)

        ProjectsSrvcs.$inject = ['$http'];
        function ProjectsSrvcs($http) {
            return {
            	projects: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: '/api/v1/projects?projectCode='+data.projectCode,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                save: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/api/v1/projects/save',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                update: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/api/v1/projects/update',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                delete: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/api/v1/projects/delete',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                }
            };
        }
})();