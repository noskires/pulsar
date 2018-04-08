(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .controller('RequisitionCtrl', RequisitionCtrl)
        .controller('RequisitionProjectCtrl', RequisitionProjectCtrl)
        .controller('RequisitionAssetCtrl', RequisitionAssetCtrl)

        RequisitionCtrl.$inject = ['$stateParams', 'RequisitionsSrvcs', 'AssetsSrvcs', 'JobOrdersSrvcs', '$window', '$uibModal'];
        function RequisitionCtrl($stateParams, RequisitionsSrvcs, AssetsSrvcs, JobOrdersSrvcs, $window, $uibModal){
            var vm = this;
            var data = {};

            RequisitionsSrvcs.requisitions({requisitionCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.requisitions = response.data.data;
                    console.log(vm.requisitions)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.routeTo = function(route){
                $window.location.href = route;
            }; 

        }

        RequisitionAssetCtrl.$inject = ['$stateParams', 'RequisitionsSrvcs', 'AssetsSrvcs', 'JobOrdersSrvcs', '$window', '$uibModal'];
        function RequisitionAssetCtrl($stateParams, RequisitionsSrvcs, AssetsSrvcs, JobOrdersSrvcs, $window, $uibModal){
            var vm = this;
            var data = {};

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
                data['jobOrderCode'] = $stateParams.jobOrderCode;
                RequisitionsSrvcs.saveAsset(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);
                        vm.routeTo('job-order/list/'+$stateParams.jobOrderCode);
                    }
                    else {
                        alert(response.data.message);
                    }
                    console.log(response.data);
                });
            };


            vm.routeTo = function(route){
                $window.location.href = route;
            }; 

        }

        RequisitionProjectCtrl.$inject = ['$stateParams', 'RequisitionsSrvcs', 'ProjectsSrvcs', '$window', '$uibModal'];
        function RequisitionProjectCtrl($stateParams, RequisitionsSrvcs, ProjectsSrvcs, $window, $uibModal){
            var vm = this;
            var data = {};

            ProjectsSrvcs.projects({projectCode:$stateParams.projectCode}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.project = response.data.data[0];
                    
                    console.log(vm.project)
                }
            }, function (){ alert('Bad Request!!!') })


            vm.newRequisitionSlip = function(data){
                console.log(data);

                data['projectCode'] = $stateParams.projectCode;
                RequisitionsSrvcs.saveProject(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);
                        vm.routeTo('projects/list');
                    }
                    else {
                        alert(response.data.message);
                    }
                    console.log(response.data);
                });
            };

            vm.routeTo = function(route){
                $window.location.href = route;
            }; 
        }

})();