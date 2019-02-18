(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .controller('UtilizationsCtrl', UtilizationsCtrl)
        .controller('UtilizationsModalInstanceCtrl', UtilizationsModalInstanceCtrl)

        UtilizationsCtrl.$inject = ['$stateParams','UtilizationsSrvcs', 'PurchaseOrdersSrvcs', 'AresSrvcs', 'EmployeesSrvcs', 'SuppliersSrvcs', 'ReceiptSrvcs', 'StockUnitsSrvcs', 'AssetsSrvcs', 'OrganizationsSrvcs', 'ProjectsSrvcs', '$window', '$uibModal'];
        function UtilizationsCtrl($stateParams, UtilizationsSrvcs, PurchaseOrdersSrvcs, AresSrvcs, EmployeesSrvcs, SuppliersSrvcs, ReceiptSrvcs, StockUnitsSrvcs, AssetsSrvcs, OrganizationsSrvcs, ProjectsSrvcs, $window, $uibModal){
            var vm = this;
            var data = {};

            // alert($stateParams.poCode)

            if($stateParams.utilizationCode)
            {
                vm.utilizationCode = $stateParams.utilizationCode; 

                // alert(vm.utilizationCode)

                UtilizationsSrvcs.utilizations({utilizationCode:vm.utilizationCode, status:0}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.utilization = response.data.data[0];
                        console.log(vm.utilization)

                        var modalInstance = $uibModal.open({
                            controller:'UtilizationsModalInstanceCtrl',
                            templateUrl:'utilizationInfo.modal',
                            controllerAs: 'vm',
                            resolve :{
                                formData: function () {
                                    return {
                                        title:'Utilization Controller',
                                        message:response.data.message,
                                        utilization: vm.utilization
                                    };
                                }
                            },
                            size: 'lg'
                        });
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            UtilizationsSrvcs.utilizations({utilizationCode:'', status:0}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.utilizations = response.data.data;
                    console.log(vm.utilizations)
                }
            }, function (){ alert('Bad Request!!!') })

            OrganizationsSrvcs.organizations({orgCode:'', nextOrgCode:'', orgType:'', startDate:'', endDate:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.organizations = response.data.data;
                    console.log(vm.organizations)
                }
            }, function (){ alert('Bad Request!!!') })

            ProjectsSrvcs.projects({projectCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.projects = response.data.data;
                    console.log(vm.projects)
                }
            }, function (){ alert('Bad Request!!!') })

            EmployeesSrvcs.employees({jobType:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.employees = response.data.data;
                    console.log(vm.employees)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.newUtilizationBtn = function(data){
                console.log(data)
                UtilizationsSrvcs.save(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);
                        UtilizationsSrvcs.utilizations({utilizationCode:'', status:0}).then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.utilizations = response.data.data;
                                console.log(vm.utilizations)
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

            vm.printUtilizationOfficeDetails = function(data){
                console.log(data)
                if(!data.request_type){
                    alert('Please select request type!');
                }
                else if(!data.reference_code){
                    alert('Please select reference nanme!');
                }
                else{

                    vm.url = 'utilization-office/report?reference_code='+data.reference_code+'&request_type='+data.request_type+'&date_from='+data.date_from+'&date_to='+data.date_to;
                }
            }

        }

        UtilizationsModalInstanceCtrl.$inject = ['$state', '$stateParams', 'UtilizationsSrvcs', '$uibModalInstance', 'PurchaseOrdersSrvcs', 'RequisitionsSrvcs', 'SuppliesSrvcs', 'EmployeesSrvcs', 'AssetsSrvcs', 'InsuranceSrvcs', 'BanksSrvcs', 'formData', 'ReceiptSrvcs'];
        function UtilizationsModalInstanceCtrl ($state, $stateParams, UtilizationsSrvcs, $uibModalInstance, PurchaseOrdersSrvcs, RequisitionsSrvcs, SuppliesSrvcs, EmployeesSrvcs, AssetsSrvcs, InsuranceSrvcs, BanksSrvcs, formData, ReceiptSrvcs) {
            // alert('insurance model')
            var vm = this;
            vm.formData = formData.utilization;
            console.log(vm.formData) 
            // console.log(vm.formData)

            // alert(vm.formData.utilization_code)

            vm.utilizationCode = vm.formData.utilization_code;

             vm.personalDetails = [
            {
                'utilization_code':vm.utilizationCode,
                'supply_name':'',
                'supply_desc':'',
                'supply_qty':0,
                'supply_unit':'',
            }];

            UtilizationsSrvcs.utilizationItems({utilizationCode:vm.utilizationCode, utilizationItemCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.utilizationItems = response.data.data;
                    console.log(vm.utilizationItems)
                }
            }, function (){ alert('Bad Request!!!') })

            SuppliesSrvcs.supplies({supplyCode:'', supplyCategory:'', quantityStatus:0, isRepair: 2}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.supplies = response.data.data;
                    console.log(vm.supplies)
                }
            }, function (){ alert('Bad Request!!!') })

            EmployeesSrvcs.employees({jobType:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.employees = response.data.data;
                    console.log(vm.employees)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.addUtilizationItems = function(data){
                console.log(data)
                UtilizationsSrvcs.saveUtilizationItems(data).then (function (response) {
                    console.log(response.data)
                    if(response.data.status == 200)
                    {
                        alert(response.data.message);
                        vm.personalDetails = [
                        {
                            'utilization_code':vm.utilizationCode,
                            'supply_name':'',
                            'supply_desc':'',
                            'supply_qty':0,
                            'supply_unit':'',
                        }];

                        UtilizationsSrvcs.utilizationItems({utilizationCode:vm.utilizationCode, utilizationItemCode:''}).then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.utilizationItems = response.data.data;
                                console.log(vm.utilizationItems)
                            }
                        }, function (){ alert('Bad Request!!!') })

                        // $state.go('list-utilization');
                        // vm.ok();
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            vm.selectSupply = function(index, supplyCode){

                SuppliesSrvcs.supplies({supplyCode:supplyCode, supplyCategory:'', quantityStatus:'', isRepair:2}).then (function (response) {
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

            vm.removeUtilizationItem = function(utilizationItemCode){
                alert('asdf')
                UtilizationsSrvcs.removeUtilizationItems({'utilization_item_code':utilizationItemCode}).then (function (response) {
                    console.log(response.data)
                    if(response.data.status == 200)
                    {
                        UtilizationsSrvcs.utilizationItems({utilizationCode:vm.utilizationCode, utilizationItemCode:''}).then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.utilizationItems = response.data.data;
                                console.log(vm.utilizationItems)
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

            vm.printUtilizationDetails = function(tag){
                vm.url = 'utilization/report/'+tag;
            }



        }
})();