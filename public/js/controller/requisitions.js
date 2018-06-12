(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .controller('RequisitionCtrl', RequisitionCtrl)
        .controller('RequisitionProjectCtrl', RequisitionProjectCtrl)
        .controller('RequisitionAssetCtrl', RequisitionAssetCtrl)
        .controller('RequisitionSlipModalInstanceCtrl', RequisitionSlipModalInstanceCtrl)

        RequisitionCtrl.$inject = ['$stateParams', 'RequisitionsSrvcs', 'AssetsSrvcs', 'JobOrdersSrvcs', '$window', '$uibModal'];
        function RequisitionCtrl($stateParams, RequisitionsSrvcs, AssetsSrvcs, JobOrdersSrvcs, $window, $uibModal){
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

        RequisitionSlipModalInstanceCtrl.$inject = ['$uibModalInstance', 'formData', 'RequisitionsSrvcs', 'ReceiptSrvcs', 'SuppliesSrvcs', '$window'];
        function RequisitionSlipModalInstanceCtrl ($uibModalInstance, formData, RequisitionsSrvcs, ReceiptSrvcs, SuppliesSrvcs, $window) {

            var vm = this;
            vm.formData = formData.requisition;
            console.log(vm.formData)
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

            SuppliesSrvcs.supplies({supplyCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.supplies = response.data.data;
                    console.log(vm.supplies)
                }
            }, function (){ alert('Bad Request!!!') })

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
        }

})();