(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .controller('PurchaseOrdersCtrl', PurchaseOrdersCtrl)
        .controller('PurchaseOrdersModalInstanceCtrl', PurchaseOrdersModalInstanceCtrl)
        .controller('PurchaseOrderEditModalInstanceCtrl', PurchaseOrderEditModalInstanceCtrl)
        .controller('PurchaseOrderDeleteModalInstanceCtrl', PurchaseOrderDeleteModalInstanceCtrl)
        .controller('PurchaseItemStatusModalInstanceCtrl', PurchaseItemStatusModalInstanceCtrl)
        

        PurchaseOrdersCtrl.$inject = ['$stateParams', '$state', 'PurchaseOrdersSrvcs', 'AresSrvcs', 'EmployeesSrvcs', 'SuppliersSrvcs', 'RequisitionsSrvcs', 'ReceiptSrvcs', 'StockUnitsSrvcs', 'AssetsSrvcs', 'OrganizationsSrvcs', 'ProjectsSrvcs', '$window', '$uibModal'];
        function PurchaseOrdersCtrl($stateParams, $state, PurchaseOrdersSrvcs, AresSrvcs, EmployeesSrvcs, SuppliersSrvcs, RequisitionsSrvcs, ReceiptSrvcs, StockUnitsSrvcs, AssetsSrvcs, OrganizationsSrvcs, ProjectsSrvcs, $window, $uibModal){
            var vm = this;
            var data = {};

            // alert($stateParams.poCode)

            if($stateParams.poCode)
            {
                vm.poCode = $stateParams.poCode; 
                // alert(vm.poCode)
                PurchaseOrdersSrvcs.pos({poCode:vm.poCode, referenceCode:'', supplierCode:'', poStatus:'', dateFrom: '', dateTo:''}).then (function (response) {
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

            if($stateParams.poCodeEdit)
            {
                vm.poCode = $stateParams.poCodeEdit; 
                // alert(vm.poCode)
                PurchaseOrdersSrvcs.pos({poCode:vm.poCode, referenceCode:'', supplierCode:'', poStatus:'', dateFrom: '', dateTo:''}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.po = response.data.data[0];
                        console.log(vm.po)

                        var modalInstance = $uibModal.open({
                            controller:'PurchaseOrderEditModalInstanceCtrl',
                            templateUrl:'po-edit.modal',
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

            if($stateParams.poCodeDelete)
            {
                vm.poCode = $stateParams.poCodeDelete; 
                // alert(vm.poCode)
                PurchaseOrdersSrvcs.pos({poCode:vm.poCode, referenceCode:'', supplierCode:'', poStatus:'', dateFrom: '', dateTo:''}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.po = response.data.data[0];
                        console.log(vm.po)

                        var modalInstance = $uibModal.open({
                            controller:'PurchaseOrderDeleteModalInstanceCtrl',
                            templateUrl:'po-delete.modal',
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
                            // size: 'sm'
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


            vm.purchaseDetails = {
                poCode:'', 
                referenceCode:'', 
                supplierCode:'', 
                poStatus:3, 
                dateFrom: '', 
                dateTo:''
            }

            PurchaseOrdersSrvcs.pos(vm.purchaseDetails).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.pos = response.data.data;
                    console.log(vm.pos)
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

            vm.risDetails = {
                requisitionCode:'',
                requisitionStatus:'1',
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

            vm.selectPurchaseOrders = function(referenceCode){

                vm.purchaseDetails = {
                    poCode:'', 
                    referenceCode:referenceCode, 
                    supplierCode:'', 
                    poStatus:2, 
                    dateFrom: '', 
                    dateTo:''
                }
                PurchaseOrdersSrvcs.pos(vm.purchaseDetails).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.pos = response.data.data;
                        console.log(vm.pos)
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            vm.newPoBtn = function(data){
                console.log(data)
                
                PurchaseOrdersSrvcs.save(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);

                        vm.purchaseDetails = {
                            poCode:'', 
                            referenceCode:'', 
                            supplierCode:'', 
                            poStatus:2, 
                            dateFrom: '', 
                            dateTo:''
                        }
                        PurchaseOrdersSrvcs.pos(vm.purchaseDetails).then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.pos = response.data.data;
                                console.log(vm.pos)
                            }
                        }, function (){ alert('Bad Request!!!') })
                    }
                    else {
                        alert(response.data.message);
                    }
                    console.log(response.data);
                });
            };

            vm.newPoBtn2 = function(data){
                console.log(data)
                PurchaseOrdersSrvcs.save(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);

                        vm.purchaseDetails = {
                            poCode:'', 
                            referenceCode:'', 
                            supplierCode:'', 
                            poStatus:3, 
                            dateFrom: '', 
                            dateTo:''
                        }
                        PurchaseOrdersSrvcs.pos(vm.purchaseDetails).then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.pos = response.data.data;
                                // vm.routeTo("/purchase-orders2/list")
                                // alert('aa')
                                vm.poDetails = {
                                    'reference_code':'',
                                    'date_requested':'',
                                    'request_type':false,
                                    'requisition_slip_code':false,
                                    'supplier_code':false,
                                    'requesting_employee':false,
                                    'old_reference':''
                                };

                                // vm.poDetails.request_type=false;
                                // $('.select2').val('')

                                // vm.poDetails.$setPristine();
                                // vm.form_po.$setPristine();
                                // vm.form_po.$setUntouched();
                                // console.log(vm.pos)
                                $state.go('list-po2');
                            }
                        }, function (){ alert('Bad Request!!!') })
                    }
                    else {
                        alert(response.data.message);
                    }
                    console.log(response.data);
                });
            };

            vm.filterPoBtn = function(data){
                console.table(data)

                vm.purchaseDetails = {
                    poCode:'', 
                    referenceCode:'', 
                    supplierCode:data.supplier_code, 
                    poStatus:data.poStatus, 
                    dateFrom:data.dateFrom, 
                    dateTo:data.dateTo
                }

                // PurchaseOrdersSrvcs.pos({poCode:'', referenceCode:'', supplierCode:data.supplier_code, poStatus:data.status, dateFrom: data.dateFrom, dateTo:data.dateTo}).then (function (response) {
                PurchaseOrdersSrvcs.pos(vm.purchaseDetails).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.pos = response.data.data;
                        console.log(vm.pos)
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            vm.printPurchaseOrderOfficeDetails = function(data){
                console.log(data)
                if(!data.request_type){
                    alert('Please select request type!');
                }
                else if(!data.reference_code){
                    alert('Please select reference nanme!');
                }
                else if(!data.purchase_order_code){
                    alert('Please select Purchase Order Code!');
                }
                else{

                    vm.url = 'purchase-order-office/report?purchase_order_code='+data.purchase_order_code+'&date_from='+data.date_from+'&date_to='+data.date_to;
                }
            }

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

            SuppliesSrvcs.supplies({supplyCode:'', supplyCategory:'', poStatus:0, isRepair:2, reOrderLevelOutofSupply:3, supplyCategoryCode:''}).then (function (response) {
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

            vm.addPoItems = function(data){
                console.log(data)
                PurchaseOrdersSrvcs.savePoItems(data).then (function (response) {
                    console.log(response.data)
                    if(response.data.status == 200)
                    {
                        alert(response.data.message);
                        // vm.personalDetails = [
                        // {
                        //     'po_code':vm.poCode,
                        //     'supply_name':'',
                        //     'supply_desc':'',
                        //     'supply_qty':0,
                        //     'supply_unit':'',
                        // }];

                        vm.supplyDetail = {
                            'po_code':vm.poCode,
                            'supply_name':'',
                            'supply_desc':'',
                            'supply_qty':0,
                            'supply_unit':'',
                        };

                        SuppliesSrvcs.supplies({supplyCode:'', supplyCategory:'', poStatus:0, isRepair:2, reOrderLevelOutofSupply:3, supplyCategoryCode:''}).then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.supplies = response.data.data;
                                console.log(vm.supplies)
                            }
                        }, function (){ alert('Bad Request!!!') })

                        PurchaseOrdersSrvcs.poItems({poCode:vm.poCode, poItemCode:'', supplyCode:''}).then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.poItems = response.data.data;
                                console.log(vm.poItems)
                            }
                        }, function (){ alert('Bad Request!!!') })



                        // $state.go('list-po2');
                        // vm.ok();
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            vm.selectSupply = function(supplyCode){

                SuppliesSrvcs.supplies({supplyCode:supplyCode, supplyCategory:'', poStatus:'', isRepair:2, reOrderLevelOutofSupply:3, supplyCategoryCode:''}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.poItemSupply = response.data.data[0];
                        console.log(vm.poItemSupply)

                        vm.supplyDetail = {
                            'po_code':$stateParams.poCode,
                            'supply_name':vm.poItemSupply.supply_code,
                            'supply_desc':vm.poItemSupply.description,
                            'supply_unit':vm.poItemSupply.stock_unit_name,
                            'supply_quantity':vm.poItemSupply.quantity
                        }

                        // angular.forEach(vm.personalDetails, function(v, k){
                        //     if(index == k)
                        //     {
                        //         v.supply_desc = vm.receiptItemSupply.description; 
                        //         v.supply_unit = vm.receiptItemSupply.stock_unit_name;
                        //         v.supply_quantity = vm.receiptItemSupply.quantity;
                        //     }
                        // })
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            vm.updatePo = function(data){

                data['po_code'] = vm.poCode;
                data['is_open'] = 0;

                PurchaseOrdersSrvcs.update(data).then (function (response) {
                    console.log(response.data)
                    if(response.data.status == 200)
                    {
                        alert(response.data.message);
                        $state.go('list-po2');
                        vm.ok();
                    }
                }, function (){ alert('Bad Request!!!') })
                console.log(data)
            }

            vm.updatePoOpen = function(data){

                data['po_code'] = vm.poCode;
                data['is_open'] = 1;

                PurchaseOrdersSrvcs.update(data).then (function (response) {
                    console.log(response.data)
                    if(response.data.status == 200)
                    {
                        alert(response.data.message);
                        $state.go('list-po2');
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

            vm.printPurchaseOrderDetails = function(tag){
                vm.url = 'purchase-order/report/'+tag;
            }

        }

        PurchaseOrderEditModalInstanceCtrl.$inject = ['$state', '$stateParams', '$uibModalInstance', 'PurchaseOrdersSrvcs', 'RequisitionsSrvcs', 'SuppliesSrvcs', 'SuppliersSrvcs', 'EmployeesSrvcs', 'AssetsSrvcs', 'InsuranceSrvcs', 'BanksSrvcs', 'OrganizationsSrvcs', 'ProjectsSrvcs', 'formData', 'ReceiptSrvcs'];
        function PurchaseOrderEditModalInstanceCtrl ($state, $stateParams, $uibModalInstance, PurchaseOrdersSrvcs, RequisitionsSrvcs, SuppliesSrvcs, SuppliersSrvcs, EmployeesSrvcs, AssetsSrvcs, InsuranceSrvcs, BanksSrvcs, OrganizationsSrvcs, ProjectsSrvcs, formData, ReceiptSrvcs) {
            // alert('insurance model')
            var vm = this;
            vm.formData = formData.po;
            console.log(vm.formData.supplier_code) 

            vm.poCode = $stateParams.poCodeEdit;

            SuppliersSrvcs.suppliers({supplierCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.suppliers = response.data.data;
                    console.log(vm.suppliers)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.purchaseDetails = {
                poCode:'', 
                referenceCode:'', 
                supplierCode:'', 
                poStatus:3, 
                dateFrom: '', 
                dateTo:''
            }
            PurchaseOrdersSrvcs.pos(vm.purchaseDetails).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.pos = response.data.data;
                    console.log(vm.pos)
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

            vm.risDetails = {
                requisitionCode:'',
                requisitionStatus:'1',
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

            vm.ok = function(){
                $uibModalInstance.close();
            };

            vm.updatePoBtn = function(data){
                // console.log(data)

                PurchaseOrdersSrvcs.update2(data).then (function (response) {
                    console.log(response.data)
                    if(response.data.status == 200)
                    {
                        alert(response.data.message);
                        

                        vm.purchaseDetails = {
                            poCode:'', 
                            referenceCode:'', 
                            supplierCode:'', 
                            poStatus:3, 
                            dateFrom: '', 
                            dateTo:''
                        }
                        PurchaseOrdersSrvcs.pos(vm.purchaseDetails).then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.pos = response.data.data;
                                console.log(vm.pos)
                            }
                        }, function (){ alert('Bad Request!!!') })
                        
                        $state.go('list-po2');
                        vm.ok();
                    }
                }, function (){ alert('Bad Request!!!') })
            }
        }

        PurchaseOrderDeleteModalInstanceCtrl.$inject = ['$state', '$stateParams', '$uibModalInstance', 'PurchaseOrdersSrvcs', 'RequisitionsSrvcs', 'SuppliesSrvcs', 'SuppliersSrvcs', 'formData', 'ReceiptSrvcs'];
        function PurchaseOrderDeleteModalInstanceCtrl ($state, $stateParams, $uibModalInstance, PurchaseOrdersSrvcs, RequisitionsSrvcs, SuppliesSrvcs, SuppliersSrvcs, formData, ReceiptSrvcs) {
            // alert('insurance model')
            var vm = this;
            vm.formData = formData.po;
            console.log(vm.formData.supplier_code) 

            vm.poCode = $stateParams.poCodeDelete;

            vm.ok = function(){
                $uibModalInstance.close();
            };

            vm.deletePoBtn = function(po_code){

                PurchaseOrdersSrvcs.update_record_status({po_code:po_code}).then (function (response) {
                    console.log(response.data)
                    if(response.data.status == 200)
                    {
                        alert(response.data.message);
                        
                        vm.purchaseDetails = {
                            poCode:'', 
                            referenceCode:'', 
                            supplierCode:'', 
                            poStatus:3, 
                            dateFrom: '', 
                            dateTo:''
                        }
                        PurchaseOrdersSrvcs.pos(vm.purchaseDetails).then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.pos = response.data.data;
                                console.log(vm.pos)
                            }
                        }, function (){ alert('Bad Request!!!') })
                        
                        $state.go('list-po2');
                        vm.ok();
                    }
                }, function (){ alert('Bad Request!!!') })
            }
        }

        PurchaseItemStatusModalInstanceCtrl.$inject = ['$state', '$stateParams', 'PurchaseOrdersSrvcs', 'EmployeesSrvcs', 'ReceiptSrvcs', 'SuppliesSrvcs', 'OrganizationsSrvcs', 'ProjectsSrvcs', '$window'];
        function PurchaseItemStatusModalInstanceCtrl ($state, $stateParams, PurchaseOrdersSrvcs, EmployeesSrvcs, ReceiptSrvcs, SuppliesSrvcs, OrganizationsSrvcs, ProjectsSrvcs, $window) {

            var vm = this;
 
            PurchaseOrdersSrvcs.poItems2().then (function (response) {
                if(response.data.status == 200)
                {
                    vm.poItems = response.data.data;
                    console.log(vm.poItems)
                }
            }, function (){ alert('Bad Request!!!') })
            
        }
})();