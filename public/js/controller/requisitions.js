(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .controller('RequisitionCtrl', RequisitionCtrl)
        .controller('RequisitionProjectCtrl', RequisitionProjectCtrl)
        .controller('RequisitionAssetCtrl', RequisitionAssetCtrl)
        .controller('RequisitionOfficetCtrl', RequisitionOfficetCtrl)
        .controller('RequisitionSlipModalInstanceCtrl', RequisitionSlipModalInstanceCtrl)
        .controller('RequisitionSlipEditModalInstanceCtrl', RequisitionSlipEditModalInstanceCtrl)
        .controller('RequisitionSlipDeleteModalInstanceCtrl', RequisitionSlipDeleteModalInstanceCtrl)
        .controller('RequisitionSlipItemStatusModalInstanceCtrl', RequisitionSlipItemStatusModalInstanceCtrl)

        RequisitionCtrl.$inject = ['$stateParams', 'RequisitionsSrvcs', 'EmployeesSrvcs', 'AssetsSrvcs', 'JobOrdersSrvcs', '$window', '$uibModal'];
        function RequisitionCtrl($stateParams, RequisitionsSrvcs, EmployeesSrvcs, AssetsSrvcs, JobOrdersSrvcs, $window, $uibModal){
            var vm = this;
            var data = {};

            if($stateParams.requisitionSlipCode)
            {
                vm.requisitionSlipCode = $stateParams.requisitionSlipCode;
                // alert(vm.receiptCode);

                
                vm.risDetails = {
                    requisitionCode:$stateParams.requisitionSlipCode,
                    requisitionStatus:'',
                    dateRequested:'',
                    requestType:''
                }
                
                RequisitionsSrvcs.requisitions(vm.risDetails).then (function (response) {
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

            vm.risDetails = {
                requisitionCode:'',
                requisitionStatus:'',
                dateRequested:'',
                requestType:''
            }
            RequisitionsSrvcs.requisitions(vm.risDetails).then (function (response) {
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

        RequisitionAssetCtrl.$inject = ['$state', '$stateParams', 'RequisitionsSrvcs', 'EmployeesSrvcs', 'OrganizationsSrvcs', 'ProjectsSrvcs', 'AssetsSrvcs', 'JobOrdersSrvcs', '$window', '$uibModal'];
        function RequisitionAssetCtrl($state, $stateParams, RequisitionsSrvcs, EmployeesSrvcs, OrganizationsSrvcs, ProjectsSrvcs, AssetsSrvcs, JobOrdersSrvcs, $window, $uibModal){
            var vm = this;
            var data = {};
            JobOrdersSrvcs.jobOrders({joCode:$stateParams.jobOrderCode, joStatus:'', date_started:'', assetCode:'', assetCategory:''}).then (function (response) {
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


            vm.newRequisitionSlip = function(data, employee_code){
                console.log(employee_code);

                data['jobOrderCode'] = $stateParams.jobOrderCode;
                data['employee_code'] = employee_code;
                RequisitionsSrvcs.saveAsset(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);
                        $state.go('list-requesition');
                        // vm.routeTo('job-order/list/'+$stateParams.jobOrderCode);
                    }
                    else {
                        alert(response.data.message);
                    }
                    console.log(response.data);
                });
            };

            vm.createRequisitionSlipBtn = function(data){
                // alert('a')

                data['jobOrderCode'] = $stateParams.jobOrderCode;
                console.log(data);
                RequisitionsSrvcs.saveAsset(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);
                        $state.go('list-requesition2');
                        // vm.routeTo('job-order/list/'+$stateParams.jobOrderCode);
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
            

            vm.itemArray = [
                {id: 1, name: 'first'},
                {id: 2, name: 'second'},
                {id: 3, name: 'third'},
                {id: 4, name: 'fourth'},
                {id: 5, name: 'fifth'},
            ];
        
            vm.selected = { value: vm.itemArray[0] };

            if($stateParams.requisitionSlipCode)
            {
                vm.requisitionSlipCode = $stateParams.requisitionSlipCode;
                // alert(vm.receiptCode);

                vm.risDetails = {
                    requisitionCode:$stateParams.requisitionSlipCode,
                    requisitionStatus:'',
                    dateRequested:'',
                    requestType:''
                }
                
                RequisitionsSrvcs.requisitions(vm.risDetails).then (function (response) {
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

            if($stateParams.requisitionSlipCodeEdit)
            {
                vm.requisitionSlipCode = $stateParams.requisitionSlipCodeEdit;

                // alert(vm.requisitionSlipCode);

                vm.risDetails = {
                    requisitionCode:vm.requisitionSlipCode,
                    requisitionStatus:'',
                    dateRequested:'',
                    requestType:''
                }
                
                RequisitionsSrvcs.requisitions(vm.risDetails).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.requisition = response.data.data[0];
                        console.log(vm.requisition)

                        var modalInstance = $uibModal.open({
                            controller:'RequisitionSlipEditModalInstanceCtrl',
                            templateUrl:'ris-edit.modal',
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
                            size: 'lg'
                        });
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            if($stateParams.requisitionSlipCodeDelete)
            {
                vm.requisitionSlipCode = $stateParams.requisitionSlipCodeDelete;

                // alert(vm.requisitionSlipCode);

                vm.risDetails = {
                    requisitionCode:vm.requisitionSlipCode,
                    requisitionStatus:'',
                    dateRequested:'',
                    requestType:''
                }
                
                RequisitionsSrvcs.requisitions(vm.risDetails).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.requisition = response.data.data[0];
                        console.log(vm.requisition)

                        var modalInstance = $uibModal.open({
                            controller:'RequisitionSlipDeleteModalInstanceCtrl',
                            templateUrl:'ris-delete.modal',
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
                            size: 'lg'
                        });
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            ProjectsSrvcs.projects({projectCode:$stateParams.projectCode}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.project = response.data.data[0];
                    
                    // console.log(vm.project)
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

            vm.risDetails = {
                requisitionCode:'',
                requisitionStatus:'',
                dateRequested:'',
                requestType:''
            }
            RequisitionsSrvcs.requisitions(vm.risDetails).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.requisitions = response.data.data;
                    console.log(vm.requisitions)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.newRequisitionSlip = function(data){
                console.log(data);

                // data['projectCode'] = $stateParams.projectCode;
                RequisitionsSrvcs.saveOffice(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);
                        // vm.routeTo('projects/list');
                        $state.go('list-requesition2');
                    }
                    else {
                        alert(response.data.message);
                    }
                    console.log(response.data);
                });
            };

            vm.newRequisitionSlip2 = function(data){
                console.log(data);

                // data['projectCode'] = $stateParams.projectCode;
                RequisitionsSrvcs.saveOffice(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);

                        vm.risDetails = {
                            requisitionCode:'',
                            requisitionStatus:'',
                            dateRequested:'',
                            requestType:''
                        }

                        RequisitionsSrvcs.requisitions(vm.risDetails).then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.requisitions = response.data.data;
                                console.log(vm.requisitions)

                                vm.risDetails = {
                                    'reference_code':'',
                                    'date_requested':'',
                                    'date_needed':'',
                                    'request_type':"Office",
                                    // 'requesting_employee':false,
                                    'old_reference':''
                                };

                                // alert($('#requestType').select2("val"));
                                // $('#requestType').val("Office");
                                // $('#employeeSelect').select2("val", "");
                            }
                        }, function (){ alert('Bad Request!!!') })
                                    // vm.routeTo('requisition2/list');
                        $state.go('list-requesition2');
                    }
                    else {
                        alert(response.data.message);
                    }
                    console.log(response.data);
                });
            };

            vm.filterRis = function(data){
                console.table(data)

                vm.risDetails = {
                    requisitionCode:'',
                    requisitionStatus:data.requisitionStatus,
                    dateRequested:data.dateRequested,
                    requestType:data.requestType
                }

                RequisitionsSrvcs.requisitions(vm.risDetails).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.requisitions = response.data.data;
                        console.log(vm.requisitions)
                    }
                }, function (){ alert('Bad Request!!!') })
                
            }

            vm.routeTo = function(route){
                $window.location.href = route;
            }; 
        }

        RequisitionSlipModalInstanceCtrl.$inject = ['$state', '$stateParams', '$uibModalInstance', 'formData', 'RequisitionsSrvcs', 'EmployeesSrvcs', 'ReceiptSrvcs', 'SuppliesSrvcs', '$window'];
        function RequisitionSlipModalInstanceCtrl ($state, $stateParams, $uibModalInstance, formData, RequisitionsSrvcs, EmployeesSrvcs, ReceiptSrvcs, SuppliesSrvcs, $window) {

            

            var vm = this;
            vm.formData = formData.requisition;
            // console.log(vm.formData)
            // alert(vm.formData.asset_name)

            if(vm.formData.asset_name!=null){
                vm.isRepair = 1;
            }else{
                vm.isRepair = 0;
            }


            // vm.personalDetails = [
            // {
            //     'requisition_slip_code':vm.formData.requisition_slip_code,
            //     // 'supply_name':'',
            //     'supply_desc':'',
            //     'supply_qty':0,
            //     'supply_qty_requested':0,
            //     'supply_cost':0,
            //     'supply_unit':'',
            //     'supply_reorderlvl':'',
            //     'supply_total':''
            // }];

            vm.supplyDetail  = {
                'requisition_slip_code':vm.formData.requisition_slip_code,
                'supply_desc':'',
                'supply_unit':'',
                'supply_quantity':0
            }

            RequisitionsSrvcs.RequisitionSlipItems({requisitionCode:vm.formData.requisition_slip_code, requisitionSlipItemCode:'', supplyCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.requisitionSlipItems = response.data.data;
                    console.log(vm.requisitionSlipItems)
                }
            }, function (){ alert('Bad Request!!!') })

            SuppliesSrvcs.supplies({supplyCode:'', supplyCategory:vm.formData.request_type, quantityStatus:'', isRepair: vm.isRepair, reOrderLevelOutofSupply:3, supplyCategoryCode:''}).then (function (response) {
                console.log(response.data)
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

            vm.withdrawal = function(data){

                data['requisition_slip_code'] = $stateParams.requisitionSlipCode;
                data['is_open'] = 0;
                
                RequisitionsSrvcs.UpdateRequisition(data).then (function (response) {
                    console.log(response.data)
                    if(response.data.status == 200)
                    {
                        alert(response.data.message);
                        vm.ok();
                        $state.go('list-requesition2');
                    }
                }, function (){ alert('Bad Request!!!') })
                console.log(data)
            }

            vm.withdrawalOpen = function(data){
                
                data['requisition_slip_code'] = $stateParams.requisitionSlipCode;
                data['is_open'] = 1;

                RequisitionsSrvcs.UpdateRequisition(data).then (function (response) {
                    console.log(response.data)
                    if(response.data.status == 200)
                    {
                        alert(response.data.message);
                        vm.ok();
                        $state.go('list-requesition2');
                    }
                }, function (){ alert('Bad Request!!!') })
                console.log(data)
            }

            // vm.selectSupply = function(index, supplyCode){
            //     // alert(supplyCode)
            //     SuppliesSrvcs.supplies({supplyCode:supplyCode, supplyCategory:vm.formData.request_type, quantityStatus:'', isRepair: vm.isRepair, reOrderLevelOutofSupply:3, supplyCategoryCode:''}).then (function (response) {
            //         if(response.data.status == 200)
            //         {
            //             vm.receiptItemSupply = response.data.data[0];
            //             console.log(vm.receiptItemSupply)
            //             console.log(response.data.data)

            //             angular.forEach(vm.personalDetails, function(v, k){
            //                 // alert(index)
            //                 if(index == k)
            //                 {
            //                     v.supply_desc = vm.receiptItemSupply.description; 
            //                     v.supply_unit = vm.receiptItemSupply.stock_unit_name;
            //                     v.supply_quantity = vm.receiptItemSupply.quantity;
            //                 }
            //             })
            //         }
            //     }, function (){ alert('Bad Request!!!') })
            // }

            vm.selectSupply2 = function(supplyCode){
                // alert(supplyCode)
                
                SuppliesSrvcs.supplies({supplyCode:supplyCode, supplyCategory:vm.formData.request_type, quantityStatus:'', isRepair: vm.isRepair, reOrderLevelOutofSupply:3, supplyCategoryCode:''}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.risItemSupply = response.data.data[0];
                        console.log(vm.risItemSupply)
                        console.log(response.data.data)

                        vm.supplyDetail = {
                            'requisition_slip_code':$stateParams.requisitionSlipCode,
                            'supply_name':vm.risItemSupply.supply_code,
                            'supply_desc':vm.risItemSupply.description,
                            'supply_unit':vm.risItemSupply.stock_unit_name,
                            'supply_quantity':vm.risItemSupply.quantity
                        }

                        console.log(vm.supplyDetail)
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            // vm.computeTotalPerSupply = function(index, supply_qty, supply_cost){
            //     angular.forEach(vm.personalDetails, function(v, k){
            //         if(index == k)
            //         {
            //             v.supply_total = supply_qty*supply_cost;
            //         }
            //     })
            // }

            vm.computeTotalPerSupply = function(supply_qty, supply_cost){
                
                vm.supplyDetail.supply_total = supply_qty*supply_cost;
                    
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
                // alert($stateParams.requisitionSlipCode)
                // data['requisition_slip_code'] = $stateParams.requisitionSlipCode;

                RequisitionsSrvcs.SaveRequisitionSlipItems(data).then (function (response) {
                    console.log(response.data)
                    if(response.data.status == 200)
                    {
                        alert(response.data.message);

                        vm.supplyDetail = {
                            'requisition_slip_code':$stateParams.requisitionSlipCode,
                            'supply_name':'',
                            'supply_desc':'',
                            'supply_unit':'',
                            'supply_quantity':'',
                            'supply_cost':0,
                            'supply_unit':'',
                            'supply_reorderlvl':'',
                            'supply_total':''
                        }

                        SuppliesSrvcs.supplies({supplyCode:'', supplyCategory:vm.formData.request_type, quantityStatus:'', isRepair: vm.isRepair, reOrderLevelOutofSupply:3, supplyCategoryCode:''}).then (function (response) {
                            console.log(response.data)
                            if(response.data.status == 200)
                            {
                                vm.supplies = response.data.data;
                                console.log(vm.supplies)
                            }
                        }, function (){ alert('Bad Request!!!') })

                        vm.supplyGrandTotal = 0;

                        RequisitionsSrvcs.RequisitionSlipItems({requisitionCode:vm.formData.requisition_slip_code, requisitionSlipItemCode:'', supplyCode:''}).then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.requisitionSlipItems = response.data.data;
                                console.log(vm.requisitionSlipItems)
                            }
                        }, function (){ alert('Bad Request!!!') })

                        // vm.personalDetails = [
                        //     {
                        //         'requisition_slip_code':vm.formData.requisition_slip_code,
                        //         // 'supply_name':'',
                        //         'supply_desc':'',
                        //         'supply_qty':0,
                        //         'supply_qty_requested':0,
                        //         'supply_cost':0,
                        //         'supply_unit':'',
                        //         'supply_reorderlvl':'',
                        //         'supply_total':''
                        //     }];
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

        RequisitionSlipEditModalInstanceCtrl.$inject = ['$state', '$stateParams', '$uibModalInstance', 'formData', 'RequisitionsSrvcs', 'EmployeesSrvcs', 'ReceiptSrvcs', 'SuppliesSrvcs', 'OrganizationsSrvcs', 'ProjectsSrvcs', '$window'];
        function RequisitionSlipEditModalInstanceCtrl ($state, $stateParams, $uibModalInstance, formData, RequisitionsSrvcs, EmployeesSrvcs, ReceiptSrvcs, SuppliesSrvcs, OrganizationsSrvcs, ProjectsSrvcs, $window) {

            var vm = this;
            vm.formData = formData.requisition;
            console.log(vm.formData)
            // alert(vm.formData.asset_name)

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

            vm.ok = function() {
                $uibModalInstance.close();
            };

            vm.updateRequisitionSlip = function(data){
                console.log(data)

                RequisitionsSrvcs.UpdateRequisition2(data).then (function (response) {
                    console.log(response.data)
                    if(response.data.status == 200)
                    {
                        alert(response.data.message);
                        
                        vm.risDetails = {
                            requisitionCode:'',
                            requisitionStatus:'',
                            dateRequested:'',
                            requestType:''
                        }
                        RequisitionsSrvcs.requisitions(vm.risDetails).then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.requisitions = response.data.data;
                                console.log(vm.requisitions)
                            }
                        }, function (){ alert('Bad Request!!!') })
                        
                        $state.go('list-requesition2');
                        vm.ok();
                    }
                }, function (){ alert('Bad Request!!!') })
            }
        }

        RequisitionSlipDeleteModalInstanceCtrl.$inject = ['$state', '$stateParams', '$uibModalInstance', 'formData', 'RequisitionsSrvcs', 'EmployeesSrvcs', 'ReceiptSrvcs', 'SuppliesSrvcs', 'OrganizationsSrvcs', 'ProjectsSrvcs', '$window'];
        function RequisitionSlipDeleteModalInstanceCtrl ($state, $stateParams, $uibModalInstance, formData, RequisitionsSrvcs, EmployeesSrvcs, ReceiptSrvcs, SuppliesSrvcs, OrganizationsSrvcs, ProjectsSrvcs, $window) {

            var vm = this;
            vm.formData = formData.requisition;
            console.log(vm.formData)
            // alert(vm.formData.asset_name)


            vm.ok = function() {
                $uibModalInstance.close();
            };

            
            vm.deleteRequisitionSlip = function(ris_code){

                RequisitionsSrvcs.update_record_status({requisition_slip_code:ris_code}).then (function (response) {
                        console.log(response.data)
                        if(response.data.status == 200)
                        {
                            alert(response.data.message);
                            
                            vm.risDetails = {
                                requisitionCode:'',
                                requisitionStatus:'',
                                dateRequested:'',
                                requestType:''
                            }
                            RequisitionsSrvcs.requisitions(vm.risDetails).then (function (response) {
                                if(response.data.status == 200)
                                {
                                    vm.requisitions = response.data.data;
                                    console.log(vm.requisitions)
                                }
                            }, function (){ alert('Bad Request!!!') })
                            
                            $state.go('list-requesition2');
                            vm.ok();
                        }
                    }, function (){ alert('Bad Request!!!') })
                }
        }

        RequisitionSlipItemStatusModalInstanceCtrl.$inject = ['$state', '$stateParams', 'RequisitionsSrvcs', 'EmployeesSrvcs', 'ReceiptSrvcs', 'SuppliesSrvcs', 'OrganizationsSrvcs', 'ProjectsSrvcs', '$window'];
        function RequisitionSlipItemStatusModalInstanceCtrl ($state, $stateParams, RequisitionsSrvcs, EmployeesSrvcs, ReceiptSrvcs, SuppliesSrvcs, OrganizationsSrvcs, ProjectsSrvcs, $window) {

            var vm = this;
            
 

            RequisitionsSrvcs.RequisitionSlipItems({requisitionCode:'', requisitionSlipItemCode:'', supplyCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.requisitionSlipItems = response.data.data;
                    console.log(vm.requisitionSlipItems)
                }
            }, function (){ alert('Bad Request!!!') })
            
        }
        

})();