(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .controller('PurchaseOrdersCtrl', PurchaseOrdersCtrl)
        .controller('PurchaseOrdersModalInstanceCtrl', PurchaseOrdersModalInstanceCtrl)

        PurchaseOrdersCtrl.$inject = ['$stateParams', 'PurchaseOrdersSrvcs', 'AresSrvcs', 'EmployeesSrvcs', 'SuppliersSrvcs', 'ReceiptSrvcs', 'StockUnitsSrvcs', 'AssetsSrvcs', '$window', '$uibModal'];
        function PurchaseOrdersCtrl($stateParams, PurchaseOrdersSrvcs, AresSrvcs, EmployeesSrvcs, SuppliersSrvcs, ReceiptSrvcs, StockUnitsSrvcs, AssetsSrvcs, $window, $uibModal){
            var vm = this;
            var data = {};

            // alert($stateParams.poCode)

            if($stateParams.poCode)
            {
                vm.poCode = $stateParams.poCode; 

                PurchaseOrdersSrvcs.pos({poCode:vm.poCode}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.po = response.data.data[0];
                        console.log(vm.po)

                        var modalInstance = $uibModal.open({
                            controller:'PurchaseOrdersModalInstanceCtrl',
                            templateUrl:'poInfo.modal',
                            controllerAs: 'vm',
                            resolve :{
                                formData: function () {
                                    return {
                                        title:'PO Controller',
                                        message:response.data.message,
                                        po: vm.po
                                    };
                                }
                            },
                            size: 'lg'
                        });
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            SuppliersSrvcs.suppliers({supplierCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.suppliers = response.data.data;
                    console.log(vm.suppliers)
                }
            }, function (){ alert('Bad Request!!!') })

            PurchaseOrdersSrvcs.pos({poCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.pos = response.data.data;
                    console.log(vm.ares)
                }
            }, function (){ alert('Bad Request!!!') })



            vm.newPoBtn = function(data){
                console.log(data)
                PurchaseOrdersSrvcs.save(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);
                        PurchaseOrdersSrvcs.pos({poCode:''}).then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.pos = response.data.data;
                                console.log(vm.ares)
                            }
                        }, function (){ alert('Bad Request!!!') })
                        // vm.ok();
                        // vm.state = false;
                    }
                    else {
                        alert(response.data.message);
                    }
                    console.log(response.data);
                });
            };

            vm.toggle = function () {
                vm.state = !vm.state;
            };

            vm.ok = function(){
                $uibModalInstance.close();
            };

            vm.routeTo = function(route){
                $window.location.href = route;
            }; 
        }

        PurchaseOrdersModalInstanceCtrl.$inject = ['$state', '$stateParams', '$uibModalInstance', 'PurchaseOrdersSrvcs', 'RequisitionsSrvcs', 'SuppliesSrvcs', 'EmployeesSrvcs', 'AssetsSrvcs', 'InsuranceSrvcs', 'BanksSrvcs', 'formData', 'ReceiptSrvcs'];
        function PurchaseOrdersModalInstanceCtrl ($state, $stateParams, $uibModalInstance, PurchaseOrdersSrvcs, RequisitionsSrvcs, SuppliesSrvcs, EmployeesSrvcs, AssetsSrvcs, InsuranceSrvcs, BanksSrvcs, formData, ReceiptSrvcs) {
            // alert('insurance model')
            var vm = this;
            vm.formData = formData.po;
            console.log(vm.formData) 
            // console.log(vm.formData)

            vm.poCode = $stateParams.poCode;

             vm.personalDetails = [
            {
                'po_code':vm.poCode,
                'supply_name':'',
                'supply_desc':'',
                'supply_qty':0,
                'supply_unit':'',
            }];

            PurchaseOrdersSrvcs.poItems({poCode:vm.poCode, poItemCode:'', supplyCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.poItems = response.data.data;
                    console.log(vm.poItems)
                }
            }, function (){ alert('Bad Request!!!') })

            SuppliesSrvcs.supplies({supplyCode:'', quantityStatus:0}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.supplies = response.data.data;
                    console.log(vm.supplies)
                }
            }, function (){ alert('Bad Request!!!') })

            EmployeesSrvcs.employees({jobType:'POS-002'}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.employees = response.data.data;
                    console.log(vm.employees)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.addPoItems = function(data){
                console.log(data)
                PurchaseOrdersSrvcs.savePoItems(data).then (function (response) {
                    console.log(response.data)
                    if(response.data.status == 200)
                    {
                        alert(response.data.message);
                        vm.personalDetails = [
                        {
                            'po_code':vm.poCode,
                            'supply_name':'',
                            'supply_desc':'',
                            'supply_qty':0,
                            'supply_unit':'',
                        }];

                        PurchaseOrdersSrvcs.poItems({poCode:vm.poCode, poItemCode:'', supplyCode:''}).then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.poItems = response.data.data;
                                console.log(vm.poItems)
                            }
                        }, function (){ alert('Bad Request!!!') })

                        $state.go('list-po');
                        // vm.ok();
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            vm.selectSupply = function(index, supplyCode){

                SuppliesSrvcs.supplies({supplyCode:supplyCode}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.receiptItemSupply = response.data.data[0];
                        console.log(vm.receiptItemSupply)

                        angular.forEach(vm.personalDetails, function(v, k){
                            if(index == k)
                            {
                                v.supply_desc = vm.receiptItemSupply.description; 
                                v.supply_unit = vm.receiptItemSupply.stock_unit_name;
                                v.supply_quantity = vm.receiptItemSupply.quantity;
                            }
                        })
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            vm.updatePo = function(data){

                data['po_code'] = vm.poCode;
                PurchaseOrdersSrvcs.update(data).then (function (response) {
                    console.log(response.data)
                    if(response.data.status == 200)
                    {
                        alert(response.data.message);
                        $state.go('list-po');
                        vm.ok();
                    }
                }, function (){ alert('Bad Request!!!') })
                console.log(data)
            }

            vm.removePoItem = function(poItemCode){

                PurchaseOrdersSrvcs.removePoItems({'po_item_code':poItemCode}).then (function (response) {
                    console.log(response.data)
                    if(response.data.status == 200)
                    {
                        PurchaseOrdersSrvcs.poItems({poCode:vm.poCode, poItemCode:'', supplyCode:''}).then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.poItems = response.data.data;
                                // console.log(vm.poItems)
                            }
                        }, function (){ alert('Bad Request!!!') })
                    }
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