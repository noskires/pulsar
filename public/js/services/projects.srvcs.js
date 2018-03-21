(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .factory('ProjectsSrvcs', ProjectsSrvcs)

        ProjectsSrvcs.$inject = ['$http'];
        function ProjectsSrvcs($http) {
            return {
            	projects: function() {
                    return $http({
                        method: 'GET',
                        // data: data,
                        url: '/api/v1/projects',
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
                }
            };
        }
})();