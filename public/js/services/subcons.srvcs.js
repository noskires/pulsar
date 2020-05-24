(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .factory('SubConsSrvcs', SubConsSrvcs)

        SubConsSrvcs.$inject = ['$http'];
        function SubConsSrvcs($http) {
            return {
                funds: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: 'api/v1/subcons?subconCode='+data.subconCode,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                save: function(data) {
                    return $http({
                        method: 'POST',
                        url: 'api/v1/subcon/save',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                update: function(data) {
                    return $http({
                        method: 'POST',
                        url: 'api/v1/subcon/update',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                }
            };
        }
})();