(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .controller('RequisitionsAddCtrl', RequisitionsAddCtrl)
        .factory('MainSrvcs',MainSrvcs)
        
    
        RequisitionsAddCtrl.$inject = ['$stateParams', 'RequisitionsSrvcs', 'AssetsSrvcs', 'EmployeesSrvcs', 'OrganizationsSrvcs', 'AddressesSrvcs', 'ProjectsSrvcs', 'JobOrdersSrvcs', '$window', '$uibModal'];
        function RequisitionsAddCtrl($stateParams, RequisitionsSrvcs, AssetsSrvcs, EmployeesSrvcs, OrganizationsSrvcs, AddressesSrvcs, ProjectsSrvcs, JobOrdersSrvcs, $window, $uibModal){
            var vm = this;
            var data = {};

            // alert($stateParams.jobOrderCode);

            JobOrdersSrvcs.jobOrders({joCode:$stateParams.jobOrderCode}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.jobOrders = response.data.data[0];

                    AssetsSrvcs.assets({tag:vm.jobOrders.tag, name:'', category:''}).then (function (response) {
                        if(response.data.status == 200)
                        {
                            vm.asset = response.data.data[0];
                            console.log(vm.asset)
                        }
                    }, function (){ alert('Bad Request!!!') })
                }
            }, function (){ alert('Bad Request!!!') })

            vm.newRequisitionSlip = function(data){
                console.log(data);
                RequisitionsSrvcs.save(data).then(function(response){
                    // if (response.data.status == 200) {
                    //     alert(response.data.message);
                    //     vm.routeTo('asset/new');
                    // }
                    // else {
                    //     alert(response.data.message);
                    // }
                    console.log(response.data);
                });
            };

            vm.routeTo = function(route){
                $window.location.href = route;
            };

        }

        MainSrvcs.$inject = ['$http'];
        function MainSrvcs($http) {
            return {
            };
        }
})();