(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .controller('SuppliesCtrl', SuppliesCtrl)
        .controller('SuppliesModalInstanceCtrl', SuppliesModalInstanceCtrl)

        SuppliesCtrl.$inject = ['$stateParams', 'SuppliesSrvcs', 'ReceiptSrvcs', 'RequisitionsSrvcs', 'AssetsSrvcs', 'JobOrdersSrvcs', '$window', '$uibModal'];
        function SuppliesCtrl($stateParams, SuppliesSrvcs, ReceiptSrvcs, RequisitionsSrvcs, AssetsSrvcs, JobOrdersSrvcs, $window, $uibModal){
            var vm = this;
            var data = {};

            if($stateParams.supplyCode)
            {

                vm.supplyCode = $stateParams.supplyCode;
                // alert(vm.receiptCode);

                // ReceiptSrvcs.receipts({supplyCode:vm.supplyCode}).then (function (response) {
                //     if(response.data.status == 200)
                //     {
                //         vm.receipt = response.data.data[0];
                //         console.log(vm.receipt)

                //         var modalInstance = $uibModal.open({
                //             controller:'SuppliesModalInstanceCtrl',
                //             templateUrl:'receiptInfo.modal',
                //             controllerAs: 'vm',
                //             resolve :{
                //               formData: function () {
                //                 return {
                //                     title:'Receipt Controller',
                //                     message:response.data.message,
                //                     receipt: vm.receipt
                //                 };
                //               }
                //             }
                //         });
                //     }
                // }, function (){ alert('Bad Request!!!') })

            }

            // SuppliesSrvcs.supplies({receiptCode:''}).then (function (response) {
            //     if(response.data.status == 200)
            //     {
            //         vm.supplies = response.data.data;
            //         console.log(vm.supplies)
            //     }
            // }, function (){ alert('Bad Request!!!') })

            vm.newSupply = function(data){
                SuppliesSrvcs.save(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);
                        vm.routeTo('supply/new');
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

        SuppliesModalInstanceCtrl.$inject = ['$uibModalInstance', 'formData'];
        function SuppliesModalInstanceCtrl ($uibModalInstance, formData) {

            var vm = this;
            vm.formData = formData.receipt;

            vm.ok = function() {
                $uibModalInstance.close();
            };
            
            vm.routeTo = function(route){
                $window.location.href = route;
            };
        }
})();