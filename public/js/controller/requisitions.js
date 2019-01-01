(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .controller('RequisitionCtrl', RequisitionCtrl)
        .controller('RequisitionProjectCtrl', RequisitionProjectCtrl)
        .controller('RequisitionAssetCtrl', RequisitionAssetCtrl)
        .controller('RequisitionOfficetCtrl', RequisitionOfficetCtrl)
        .controller('RequisitionSlipModalInstanceCtrl', RequisitionSlipModalInstanceCtrl)

        RequisitionCtrl.$inject = ['$stateParams', 'RequisitionsSrvcs', 'EmployeesSrvcs', 'AssetsSrvcs', 'JobOrdersSrvcs', '$window', '$uibModal'];
        function RequisitionCtrl($stateParams, RequisitionsSrvcs, EmployeesSrvcs, AssetsSrvcs, JobOrdersSrvcs, $window, $uibModal){
            var vm = this;
            var data = {};

            // alert($stateParams.requisitionSlipCode)

            if($stateParams.requisitionSlipCode)
            {
                vm.requisitionSlipCode = $stateParams.requisitionSlipCode;
                // alert(vm.receiptCode);

                RequisitionsSrvcs.requisitions({requisitionCode:$stateParams.requisitionSlipCode}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.requisition = response.data.data[0];
                        console.log(vm.requisition)

                        var modalInstance = $uibModal.open({
                            controller:'RequisitionSlipModalInstanceCtrl',
                            templateUrl:'requisitionSlipInfo.modal',
                            controllerAs: 'vm',
                            resolve :{
                              formData: function () {
                                return {
                                    title:'RIS Controller',
                                    message:response.data.message,
                                    requisition: vm.requisition
                                };
                              }
                            },
                            size: 'xlg'
                        });
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            RequisitionsSrvcs.requisitions({requisitionCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.requisitions = response.data.data;
                    console.log(vm.requisitions)
                }
            }, function (){ alert('Bad Request!!!') })

            EmployeesSrvcs.employees({jobType:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.employees = response.data.data;
                    console.log(vm.employees)
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

            JobOrdersSrvcs.jobOrders({joCode:$stateParams.jobOrderCode, jobStatus:'', assetTag:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.jobOrders = response.data.data[0];
                    console.log(vm.jobOrders)
                    
                    AssetsSrvcs.assets({tag:vm.jobOrders.tag, name:'', category:'', areCode:'', isAll:false}).then (function (response) {
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

        RequisitionOfficetCtrl.$inject = ['$state', '$stateParams', 'RequisitionsSrvcs', 'ProjectsSrvcs', 'EmployeesSrvcs', 'OrganizationsSrvcs', '$window', '$uibModal'];
        function RequisitionOfficetCtrl($state, $stateParams, RequisitionsSrvcs, ProjectsSrvcs, EmployeesSrvcs, OrganizationsSrvcs, $window, $uibModal){
            var vm = this;
            var data = {};

            ProjectsSrvcs.projects({projectCode:$stateParams.projectCode}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.project = response.data.data[0];
                    
                    console.log(vm.project)
                }
            }, function (){ alert('Bad Request!!!') })

            EmployeesSrvcs.employees({jobType:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.employees = response.data.data;
                    console.log(vm.employees)
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

            vm.newRequisitionSlip = function(data){
                console.log(data);

                // data['projectCode'] = $stateParams.projectCode;
                RequisitionsSrvcs.saveOffice(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);
                        // vm.routeTo('projects/list');
                        $state.go('list-requesition');
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

        RequisitionSlipModalInstanceCtrl.$inject = ['$state', '$stateParams', '$uibModalInstance', 'formData', 'RequisitionsSrvcs', 'EmployeesSrvcs', 'ReceiptSrvcs', 'SuppliesSrvcs', '$window'];
        function RequisitionSlipModalInstanceCtrl ($state, $stateParams, $uibModalInstance, formData, RequisitionsSrvcs, EmployeesSrvcs, ReceiptSrvcs, SuppliesSrvcs, $window) {

            var vm = this;
            vm.formData = formData.requisition;
            // console.log(vm.formData)
            alert(vm.formData.request_type)

            vm.personalDetails = [
            {
                'requisition_slip_code':vm.formData.requisition_slip_code,
                'supply_name':'',
                'supply_desc':'',
                'supply_qty':0,
                'supply_cost':0,
                'supply_unit':'',
                'supply_reorderlvl':'',
                'supply_total':''
            }];

            RequisitionsSrvcs.RequisitionSlipItems({requisitionCode:vm.formData.requisition_slip_code, requisitionSlipItemCode:'', supplyCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.requisitionSlipItems = response.data.data;
                    console.log(vm.requisitionSlipItems)
                }
            }, function (){ alert('Bad Request!!!') })

            SuppliesSrvcs.supplies({supplyCode:'', supplyCategory:vm.formData.request_type, quantityStatus:1}).then (function (response) {
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

            vm.withdrawal = function(data){

                data['requisition_slip_code'] = $stateParams.requisitionSlipCode;
                RequisitionsSrvcs.UpdateRequisition(data).then (function (response) {
                    console.log(response.data)
                    if(response.data.status == 200)
                    {
                        alert(response.data.message);
                        vm.ok();
                        $state.go('list-requesition');
                    }
                }, function (){ alert('Bad Request!!!') })
                console.log(data)
            }

            vm.selectSupply = function(index, supplyCode){
                alert(supplyCode)
                SuppliesSrvcs.supplies({supplyCode:supplyCode, supplyCategory:vm.formData.request_type, quantityStatus:''}).then (function (response) {
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

            vm.computeTotalPerSupply = function(index, supply_qty, supply_cost){
                angular.forEach(vm.personalDetails, function(v, k){
                    if(index == k)
                    {
                        v.supply_total = supply_qty*supply_cost;
                    }
                })
            }

            vm.addNew = function(){
                // vm.personalDetails.push({ 
                // 'receipt_code':vm.formData.receipt_code,
                // 'supply_name':"",
                // 'supply_desc':"",
                // 'supply_qty':0,
                // 'supply_cost':0,
                // 'supply_unit':"",
                // 'supply_reorderlvl':"",
                // 'total':""
                // });
            };

            vm.remove = function(){
                var newDataList=[];
                vm.selectedAll = false;
                angular.forEach(vm.personalDetails, function(selected){
                    if(!selected.selected){
                        newDataList.push(selected);
                    }
                }); 
                vm.personalDetails = newDataList;
            };


            vm.removeRequisitionSlipItem = function(requisitionSlipItemCode, requisitionItemQuantity, requisitionItemSupplyCode){

                RequisitionsSrvcs.DeleteRequisitionSlipItems({'requisition_slip_item_code':requisitionSlipItemCode, 
                                                            'requisition_item_quantity':requisitionItemQuantity,
                                                            'requisition_item_supply_code':requisitionItemSupplyCode
                                                            }).then (function (response) {
                    console.log(response.data)
                    if(response.data.status == 200)
                    {
                        vm.supplyGrandTotal = 0;
                        RequisitionsSrvcs.RequisitionSlipItems({requisitionCode:vm.formData.requisition_slip_code, requisitionSlipItemCode:'', supplyCode:''}).then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.requisitionSlipItems = response.data.data;
                                console.log(vm.requisitionSlipItems)
                            }
                        }, function (){ alert('Bad Request!!!') })
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            vm.checkAll = function () {
                if (!vm.selectedAll) {
                    vm.selectedAll = true;
                } else {
                    vm.selectedAll = false;
                }
                angular.forEach(vm.personalDetails, function(personalDetail) {
                    personalDetail.selected = vm.selectedAll;
                });
            };   

            vm.addRequistionSlipItems = function(data){
                // console.log(data)
                RequisitionsSrvcs.SaveRequisitionSlipItems(data).then (function (response) {
                    console.log(response.data)
                    if(response.data.status == 200)
                    {
                        alert(response.data.message);
                        vm.personalDetails = [
                        {
                            'requisition_slip_code':vm.formData.requisition_slip_code,
                            'supply_name':'',
                            'supply_desc':'',
                            'supply_qty':'',
                            'supply_unit':0,
                            'supply_cost':0,
                            'supply_reorderlvl':'',
                            'supply_total':''
                        }];

                        vm.supplyGrandTotal = 0;

                        RequisitionsSrvcs.RequisitionSlipItems({requisitionCode:vm.formData.requisition_slip_code, requisitionSlipItemCode:'', supplyCode:''}).then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.requisitionSlipItems = response.data.data;
                                console.log(vm.requisitionSlipItems)
                            }
                        }, function (){ alert('Bad Request!!!') })
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            vm.addItems = function(){
                vm.routeTo('requisition/list');
            }

            vm.ok = function() {
                $uibModalInstance.close();
            };
            
            vm.routeTo = function(route){
                $window.location.href = route;
            };

            vm.printRequisitionDetails = function(tag){
                vm.url = 'requisition/report/'+tag;
            }
        }

})();