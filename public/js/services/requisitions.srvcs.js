(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .factory('RequisitionsSrvcs', RequisitionsSrvcs)

        RequisitionsSrvcs.$inject = ['$http'];
        function RequisitionsSrvcs($http) {
            return {
            	// projects: function() {
             //        return $http({
             //            method: 'GET',
             //            // data: data,
             //            url: '/api/v1/projects',
             //            headers: {'Content-Type': 'application/json'}
             //        })
             //    },
                jobOrders: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/api/v1/requisition-issue-slip/save',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                save: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/api/v1/requisition-issue-slip/save',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                }
            };
        }
})();