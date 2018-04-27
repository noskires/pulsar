(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .factory('ParticularsSrvcs', ParticularsSrvcs)

        ParticularsSrvcs.$inject = ['$http'];
        function ParticularsSrvcs($http) {
            return {
                particulars: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: '/api/v1/particulars?particularCode='+data.particularCode,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                save: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/api/v1/particular/save',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                update: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/api/v1/particular/update',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
            };
        }
})();