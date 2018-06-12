(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .controller('BanksCtrl', BanksCtrl)
        .controller('BanksModalInstanceCtrl', BanksModalInstanceCtrl)

        BanksCtrl.$inject = ['$stateParams', 'BanksSrvcs', 'SuppliesSrvcs', 'ReceiptSrvcs', 'StockUnitsSrvcs', 'RequisitionsSrvcs', 'AssetsSrvcs', 'JobOrdersSrvcs', '$window', '$uibModal'];
        function BanksCtrl($stateParams, BanksSrvcs, SuppliesSrvcs, ReceiptSrvcs, StockUnitsSrvcs, RequisitionsSrvcs, AssetsSrvcs, JobOrdersSrvcs, $window, $uibModal){
            var vm = this;
            var data = {};

            if($stateParams.bankCode)
            {
                vm.bankCode = $stateParams.bankCode;

                BanksSrvcs.banks({bankCode:vm.bankCode}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.bank = response.data.data[0];
                        console.log(vm.bank)

                        var modalInstance = $uibModal.open({
                            controller:'BanksModalInstanceCtrl',
                            templateUrl:'bankInfo.modal',
                            controllerAs: 'vm',
                            resolve :{
                                formData: function () {
                                    return {
                                        title:'Bank Controller',
                                        message:response.data.message,
                                        bank: vm.bank
                                    };
                                }
                            },
                            size: 'lg'
                        });
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            BanksSrvcs.banks({bankCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.banks = response.data.data;
                    console.log(vm.banks)
                }
            }, function (){ alert('Bad Request!!!') })

            // StockUnitsSrvcs.stockUnits({stockUnitCode:''}).then (function (response) {
            //     if(response.data.status == 200)
            //     {
            //         vm.stockUnits = response.data.data;
            //         console.log(vm.stockUnits)
            //     }
            // }, function (){ alert('Bad Request!!!') })

            // SuppliesSrvcs.supplies({supplyCode:''}).then (function (response) {
            //     if(response.data.status == 200)
            //     {
            //         vm.supplies = response.data.data;
            //         console.log(vm.supplies)
            //     }
            // }, function (){ alert('Bad Request!!!') })

            // AssetsSrvcs.asset_categories({assetCategory:'Supplies'}).then (function (response) {
            //     if(response.data.status == 200)
            //     {
            //         vm.assetCategories = response.data.data;
            //         console.log(vm.assetCategories)
            //     }
            // }, function (){ alert('Bad Request!!!') })

            vm.newBank = function(data){
                BanksSrvcs.save(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);
                        // vm.routeTo('bank/list');
                        vm.ok();
                    }
                    else {
                        alert(response.data.message);
                    }
                    console.log(response.data);
                });
            };

            vm.ok = function(){
                $uibModalInstance.close();
            };

            vm.routeTo = function(route){
                $window.location.href = route;
            }; 
        }

        BanksModalInstanceCtrl.$inject = ['$stateParams', '$uibModalInstance', 'BanksSrvcs', 'formData', 'ReceiptSrvcs'];
        function BanksModalInstanceCtrl ($stateParams, $uibModalInstance, BanksSrvcs, formData, ReceiptSrvcs) {

            var vm = this;
            vm.formData = formData.bank; 

            vm.updateBank = function(data){
                BanksSrvcs.update(data).then (function (response) {
                    if(response.data.status == 200)
                    {
                        alert(response.data.message);
                    }
                    vm.ok();
                }, function (){ alert('Bad Request!!!') })
            }

            vm.ok = function(){
                $uibModalInstance.close();
            };

            vm.routeTo = function(route){
                $window.location.href = route;
            };

        }
})();