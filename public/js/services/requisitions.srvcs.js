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
                RequisitionSlipItems: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: '/api/v1/requisition-slip-items?requisitionCode='+data.requisitionCode+'&requisitionSlipItemCode='+data.requisitionSlipItemCode+'&supplyCode='+data.supplyCode,
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
                },
                SaveRequisitionSlipItems: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/api/v1/requisition-slip-items/save',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                DeleteRequisitionSlipItems: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/api/v1/requisition-slip-items/delete',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                UpdateRequisition: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/api/v1/requisitions/update',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
            };
        }
})();