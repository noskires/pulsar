(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .factory('ClientsSrvcs', ClientsSrvcs)

        ClientsSrvcs.$inject = ['$http'];
        function ClientsSrvcs($http) {
            return {
                clients: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: 'api/v1/clients?clientCode='+data.clientCode,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                save: function(data) {
                    return $http({
                        method: 'POST',
                        url: 'api/v1/client/save',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                update: function(data) {
                    return $http({
                        method: 'POST',
                        url: 'api/v1/client/update',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
            };
        }
})();