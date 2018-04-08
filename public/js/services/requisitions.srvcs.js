(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .factory('RequisitionsSrvcs', RequisitionsSrvcs)

        RequisitionsSrvcs.$inject = ['$http'];
        function RequisitionsSrvcs($http) {
            return {
            	requisitions: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: '/api/v1/requisitions?requisitionCode='+data.requisitionCode,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                jobOrders: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/api/v1/requisition-issue-slip/save',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                saveAsset: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/api/v1/requisition-issue-slip/asset/save',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                saveProject: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/api/v1/requisition-issue-slip/project/save',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                }
            };
        }
})();