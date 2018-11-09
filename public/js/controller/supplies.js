(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .controller('SuppliesCtrl', SuppliesCtrl)
        .controller('SuppliesModalInstanceCtrl', SuppliesModalInstanceCtrl)

        SuppliesCtrl.$inject = ['$stateParams', 'SuppliesSrvcs', 'ReceiptSrvcs', 'StockUnitsSrvcs', 'RequisitionsSrvcs', 'AssetsSrvcs', 'JobOrdersSrvcs', '$window', '$uibModal'];
        function SuppliesCtrl($stateParams, SuppliesSrvcs, ReceiptSrvcs, StockUnitsSrvcs, RequisitionsSrvcs, AssetsSrvcs, JobOrdersSrvcs, $window, $uibModal){
            var vm = this;
            var data = {};

            if($stateParams.supplyCode)
            {
                vm.supplyCode = $stateParams.supplyCode;
                // alert(vm.receiptCode);

                SuppliesSrvcs.supplies({supplyCode:vm.supplyCode}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.supply = response.data.data[0];
                        console.log(vm.supply)

                        var modalInstance = $uibModal.open({
                            controller:'SuppliesModalInstanceCtrl',
                            templateUrl:'supplyInfo.modal',
                            controllerAs: 'vm',
                            resolve :{
                              formData: function () {
                                return {
                                    title:'Supply Controller',
                                    message:response.data.message,
                                    supply: vm.supply
                                };
                              }
                            },
                            size: 'xlg'
                        });
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            StockUnitsSrvcs.stockUnits({stockUnitCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.stockUnits = response.data.data;
                    console.log(vm.stockUnits)
                }
            }, function (){ alert('Bad Request!!!') })

            SuppliesSrvcs.supplies({supplyCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.supplies = response.data.data;
                    console.log(vm.supplies)
                }
            }, function (){ alert('Bad Request!!!') })

            AssetsSrvcs.asset_categories({assetCategory:'Supplies'}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.assetCategories = response.data.data;
                    console.log(vm.assetCategories)
                }
            }, function (){ alert('Bad Request!!!') })



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

        SuppliesModalInstanceCtrl.$inject = ['$uibModalInstance', 'formData', 'ReceiptSrvcs'];
        function SuppliesModalInstanceCtrl ($uibModalInstance, formData, ReceiptSrvcs) {

            var vm = this;
            vm.formData = formData.supply;
            console.log(vm.formData)
            ReceiptSrvcs.receiptItems({receiptCode:'', receiptItemCode:'', receiptItemSupplyCode:vm.formData.supply_code}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.receiptItems = response.data.data;
                    console.log(vm.receiptItems)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.ok = function() {
                $uibModalInstance.close();
            };
            
            vm.routeTo = function(route){
                $window.location.href = route;
            };

            vm.printSupplyDetails = function(tag){
                vm.url = 'supply/report/'+tag;
            }
        }
})();