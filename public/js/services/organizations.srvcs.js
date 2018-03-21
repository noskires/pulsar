(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .factory('OrganizationsSrvcs', OrganizationsSrvcs)

        OrganizationsSrvcs.$inject = ['$http'];
        function OrganizationsSrvcs($http) {
            return {
            	organizations: function() {
                    return $http({
                        method: 'GET',
                        // data: data,
                        url: '/api/v1/organizations',
                        headers: {'Content-Type': 'application/json'}
                    })
                }
            };
        }
})();