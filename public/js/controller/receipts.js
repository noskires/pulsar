(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .controller('ReceiptsCtrl', ReceiptsCtrl)
        // .controller('ReceiptItemsCtrl', ReceiptItemsCtrl)
        .controller('ReceiptsModalInstanceCtrl', ReceiptsModalInstanceCtrl)
        .controller('ReceiptEditModalInstanceCtrl', ReceiptEditModalInstanceCtrl)
        .controller('ReceiptDeleteModalInstanceCtrl', ReceiptDeleteModalInstanceCtrl)

        ReceiptsCtrl.$inject = ['$state', '$stateParams', 'ReceiptSrvcs', 'RequisitionsSrvcs', 'EmployeesSrvcs', 'SuppliersSrvcs', 'BanksSrvcs', 'AssetsSrvcs', 'JobOrdersSrvcs', 'PurchaseOrdersSrvcs', '$window', '$uibModal'];
        function ReceiptsCtrl($state, $stateParams, ReceiptSrvcs, RequisitionsSrvcs, EmployeesSrvcs, SuppliersSrvcs, BanksSrvcs, AssetsSrvcs, JobOrdersSrvcs, PurchaseOrdersSrvcs, $window, $uibModal){
            var vm = this;
            var data = {};
            
            // alert($stateParams.receiptCode)

            vm.payeeType = "SUPPLIER";
            vm.supplierStatus = true;

            SuppliersSrvcs.suppliers({supplierCode:''}).then(function(response){
                if (response.data.status == 200) {
                    vm.suppliers = response.data.data;
                }
                else {
                    alert(response.data.message);
                }
                console.log(response.data);
            });

            if($stateParams.receiptCode)
            {
                vm.receiptCode = $stateParams.receiptCode;
                // alert(vm.receiptCode);

                vm.receiptDetails = {
                    receiptCode:vm.receiptCode, 
                    receiptDate:'', 
                    payeeType:'', 
                    payee:'', 
                    voucherCode:'', 
                    voucherStatus:'', 
                    poCode:'', 
                    poStatus:'',
                    isWarehouse:'',
                }

                ReceiptSrvcs.receipts(vm.receiptDetails).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.receipt = response.data.data[0];
                        console.log(vm.receipt)

                        if(vm.receipt.payee_type != "SUPPLIER")
                        { 
                            var modalInstance = $uibModal.open({
                                controller:'ReceiptsModalInstanceCtrl',
                                templateUrl:'receiptInfo2.modal',
                                controllerAs: 'vm',
                                backdrop: 'static',
                                keyboard: false,
                                resolve :{
                                  formData: function () {
                                    return {
                                        title:'Receipt Controller',
                                        message:response.data.message,
                                        receipt: vm.receipt
                                    };
                                  }
                                }
                            });
                        }
                        else
                        {
                            var modalInstance = $uibModal.open({
                                controller:'ReceiptsModalInstanceCtrl',
                                templateUrl:'receiptInfo.modal',
                                controllerAs: 'vm',
                                backdrop: 'static',
                                keyboard: false,
                                resolve :{
                                  formData: function () {
                                    return {
                                        title:'Receipt Controller',
                                        message:response.data.message,
                                        receipt: vm.receipt
                                    };
                                  }
                                },
                                size: 'xlg'
                            });
                        }
                    }
                }, function (){ alert('Bad Request!!!') })
            }


            if($stateParams.receiptCodeEdit)
            {
                vm.receiptCode = $stateParams.receiptCodeEdit;

       

                vm.receiptDetails = {
                    receiptCode:vm.receiptCode, 
                    receiptDate:'', 
                    payeeType:'', 
                    payee:'', 
                    voucherCode:'', 
                    voucherStatus:'', 
                    poCode:'', 
                    poStatus:'',
                    isWarehouse:''
                }
    
                ReceiptSrvcs.receipts(vm.receiptDetails).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.receipt = response.data.data[0];
                        console.log(vm.receipt)

                        var modalInstance = $uibModal.open({
                            controller:'ReceiptEditModalInstanceCtrl',
                            templateUrl:'receipt-edit.modal',
                            controllerAs: 'vm',
                            backdrop: 'static',
                            keyboard: false,
                            resolve :{
                              formData: function () {
                                return {
                                    title:'Receipt Controller',
                                    message:response.data.message,
                                    receipt: vm.receipt
                                };
                              }
                            },
                            size: 'lg'
                        });
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            if($stateParams.receiptCodeDelete)
            {
                vm.receiptCode = $stateParams.receiptCodeDelete;

           

                vm.receiptDetails = {
                    receiptCode:vm.receiptCode, 
                    receiptDate:'', 
                    payeeType:'', 
                    payee:'', 
                    voucherCode:'', 
                    voucherStatus:'', 
                    poCode:'', 
                    poStatus:'',
                    isWarehouse:''
                }
    
                ReceiptSrvcs.receipts(vm.receiptDetails).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.receipt = response.data.data[0];
                        console.log(vm.receipt)

                        var modalInstance = $uibModal.open({
                            controller:'ReceiptDeleteModalInstanceCtrl',
                            templateUrl:'receipt-delete.modal',
                            controllerAs: 'vm',
                            backdrop: 'static',
                            keyboard: false,
                            resolve :{
                              formData: function () {
                                return {
                                    title:'RIS Controller',
                                    message:response.data.message,
                                    receipt: vm.receipt
                                };
                              }
                            },
                            size: 'lg'
                        });
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            vm.receiptDetails = {
                receiptCode:'', 
                receiptDate:'', 
                payeeType:'', 
                payee:'', 
                voucherCode:'', 
                voucherStatus:'', 
                poCode:'', 
                poStatus:'',
                isWarehouse:''
            }

            vm.loader_status = true;
            ReceiptSrvcs.receipts(vm.receiptDetails).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.receipts = response.data.data;
                    console.log(vm.receipts)
                    vm.loader_status = false;
                }
            }, function (){ alert('Bad Request!!!') })

            ReceiptSrvcs.receiptTypes().then (function (response) {
                if(response.data.status == 200)
                {
                    vm.receiptTypes = response.data.data;
                    console.log(vm.receiptTypes)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.newReceipt = function(data){

                console.log(data);
                ReceiptSrvcs.save(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);

                        // vm.receiptDetails = {
                        //     receiptCode:'', 
                        //     receiptDate:'', 
                        //     payeeType:'', 
                        //     payee:'', 
                        //     voucherCode:'', 
                        //     voucherStatus:'', 
                        //     poCode:'', 
                        //     poStatus:''
                        // }

                        // ReceiptSrvcs.receipts(vm.receiptDetails).then (function (response) {
                        //     if(response.data.status == 200)
                        //     {
                        //         vm.receipts = response.data.data;
                        //         console.log(vm.receipts)
                        //     }
                        // }, function (){ alert('Bad Request!!!') })
                        $state.reload();
                        // $state.go('list-receipt2');
                    }
                    else {
                        alert(response.data.message);
                    }
                    console.log(response.data);
                });
            };

            vm.selectPayeeType = function(payeeType){
                // alert(payeeType)
                // console.log(data);
                vm.payeeType = payeeType;

                if(payeeType=="EMPLOYEE")
                {          
                    EmployeesSrvcs.employees({jobType:''}).then(function(response){
                        if (response.data.status == 200) {
                            vm.employees = response.data.data;
                        }
                        else {
                            alert(response.data.message);
                        }
                        console.log(response.data);
                    });
                }
                else if(payeeType=="SUPPLIER")
                {          
                    SuppliersSrvcs.suppliers({supplierCode:''}).then(function(response){
                        if (response.data.status == 200) {
                            vm.suppliers = response.data.data;
                        }
                        else {
                            alert(response.data.message);
                        }
                        console.log(response.data);
                    });
                }
                else if(payeeType=="BANK")
                {
                    BanksSrvcs.banks({bankCode:''}).then(function(response){
                        if (response.data.status == 200) {
                            vm.banks = response.data.data;
                        }
                        else {
                            alert(response.data.message);
                        }
                        console.log(response.data);
                    });
                }
                else
                {
                    alert("Please select Payee Type!")
                }

            };

            vm.selectPayee = function(payeeType, supplierCode){
                // alert(payee)

                vm.purchaseDetails = {
                    poCode:'', 
                    referenceCode:'', 
                    supplierCode:supplierCode, 
                    poStatus:2, 
                    dateFrom:'', 
                    dateTo:''
                }

                PurchaseOrdersSrvcs.pos(vm.purchaseDetails).then (function (response) { //get all open po status
                    if(response.data.status == 200)
                    {
                        vm.pos = response.data.data;
                        console.log(vm.pos)
                    }
                }, function (){ alert('Bad Request!!!') })


                if(payeeType == "SUPPLIER")
                {
            
                    vm.supplierStatus = true;
                    
                }
                else{
                    vm.supplierStatus = false;

                }
            }

            vm.routeTo = function(route){
                $window.location.href = route;
            }; 

            vm.filterReceipt = function(data){
                console.table(data)

                vm.receiptDetails = {
                    receiptCode:'', 
                    receiptDate:data.date_receipt, 
                    payeeType:data.payee_type, 
                    payee:'', 
                    voucherCode:'', 
                    voucherStatus:data.voucher_status, 
                    poCode:'', 
                    poStatus:'',
                    isWarehouse:data.is_warehouse
                }

                ReceiptSrvcs.receipts(vm.receiptDetails).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.receipts = response.data.data;
                        console.log(vm.receipts)
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            vm.loader_returned_items_status = true;
            ReceiptSrvcs.receiptItems({receiptCode:'', receiptItemCode:'', receiptItemSupplyCode:'',isReturned:'1'}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.returneReceiptItems = response.data.data;
                    vm.loader_returned_items_status = false;
                    console.log(vm.returneReceiptItems)
                }
            }, function (){ alert('Bad Request!!!') })
        }

        ReceiptsModalInstanceCtrl.$inject = ['$stateParams', '$uibModalInstance', 'formData', 'ReceiptSrvcs', 'SuppliesSrvcs', '$window'];
        function ReceiptsModalInstanceCtrl ($stateParams, $uibModalInstance, formData, ReceiptSrvcs, SuppliesSrvcs, $window) {

            var vm = this;
            vm.formData = formData.receipt;
            console.log(vm.formData)
            
            vm.personalDetails = [
            {
                'receipt_code':vm.formData.receipt_code,
                'supply_name':'',
                'supply_desc':'',
                'supply_qty':0,
                'supply_cost':0,
                'supply_unit':'',
                'supply_reorderlvl':'',
                'supply_total':''
            }];

            ReceiptSrvcs.receiptItems({receiptCode:vm.formData.receipt_code, receiptItemCode:'', receiptItemSupplyCode:'',isReturned:'0'}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.receiptItems = response.data.data;
                    console.log(vm.receiptItems)
                }
            }, function (){ alert('Bad Request!!!') })

            ReceiptSrvcs.receiptItems({receiptCode:vm.formData.receipt_code, receiptItemCode:'', receiptItemSupplyCode:'',isReturned:'1'}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.returneReceiptItems = response.data.data;
                    console.log(vm.returneReceiptItems)
                }
            }, function (){ alert('Bad Request!!!') })

            SuppliesSrvcs.supplies({supplyCode:'', supplyCategory:'', quantityStatus:null, isRepair:2, reOrderLevelOutofSupply:3, supplyCategoryCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.supplies = response.data.data;
                    console.log(vm.supplies)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.selectSupply = function(supplyCode){

                SuppliesSrvcs.supplies({supplyCode:supplyCode, supplyCategory:'', quantityStatus:null, isRepair: 2, reOrderLevelOutofSupply:3, supplyCategoryCode:''}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.receiptItemSupply = response.data.data[0];
                        console.log(vm.receiptItemSupply)

                        vm.supplyDetail = {
                            'receipt_code':$stateParams.receiptCode,
                            'supply_name':vm.receiptItemSupply.supply_code,
                            'supply_desc':vm.receiptItemSupply.description,
                            'supply_unit':vm.receiptItemSupply.stock_unit_name,
                            'supply_quantity':vm.receiptItemSupply.quantity
                        }

                        // angular.forEach(vm.personalDetails, function(v, k){
                        //     if(index == k)
                        //     {
                        //         v.supply_desc = vm.receiptItemSupply.description; 
                        //         v.supply_unit = vm.receiptItemSupply.stock_unit_name;
                        //     }
                        // })
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            vm.computeTotalPerSupply = function(supply_qty, supply_cost){

                
                vm.supplyDetail.supply_total = supply_qty*supply_cost;
                
                // angular.forEach(vm.personalDetails, function(v, k){
                //     if(index == k)
                //     {
                //         v.supply_total = supply_qty*supply_cost;
                //     }
                // })
            }

            vm.addNew = function(){
                vm.personalDetails.push({ 
                'receipt_code':$stateParams.receiptCode,
                'supply_name':"",
                'supply_desc':"",
                'supply_qty':0,
                'supply_cost':0,
                'supply_unit':"",
                'supply_reorderlvl':"",
                'total':""
                });
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

            vm.removeSupplyBtn = function(receiptItemCode, receiptItemQuantity, supplyCode){
                
                vm.supplyGrandTotal = 0;
                ReceiptSrvcs.deleteReceiptItems({receiptItemCode:receiptItemCode, receiptItemQuantity:receiptItemQuantity, supplyCode:supplyCode}).then (function (response) {
                    console.log(response.data.data)
                    alert(response.data.message)
                    ReceiptSrvcs.receiptItems({receiptCode:vm.formData.receipt_code, receiptItemCode:'', receiptItemSupplyCode:'',isReturned:0}).then (function (response) {
                        if(response.data.status == 200)
                        {
                            vm.receiptItems = response.data.data;
                            console.log(vm.receiptItems)
                        }
                    }, function (){ alert('Bad Request!!!') })

                    vm.supplyGrandTotalReturned = 0;
                    ReceiptSrvcs.receiptItems({receiptCode:vm.formData.receipt_code, receiptItemCode:'', receiptItemSupplyCode:'',isReturned:1}).then (function (response) {
                        if(response.data.status == 200)
                        {
                            vm.returneReceiptItems = response.data.data;
                            console.log(vm.returneReceiptItems)
                        }
                    }, function (){ alert('Bad Request!!!') })
                }, function (){ alert('Bad Request!!!') })
            };

            vm.returnSupplyBtn = function(receiptItemCode, receiptItemQuantity, supplyCode){
                
                vm.supplyGrandTotal = 0;
                ReceiptSrvcs.returnReceiptItems({receiptItemCode:receiptItemCode, receiptItemQuantity:receiptItemQuantity, supplyCode:supplyCode}).then (function (response) {
                    console.log(response.data.data)
                    alert(response.data.message)
                    ReceiptSrvcs.receiptItems({receiptCode:vm.formData.receipt_code, receiptItemCode:'', receiptItemSupplyCode:'',isReturned:0}).then (function (response) {
                        if(response.data.status == 200)
                        {
                            vm.receiptItems = response.data.data;
                            console.log(vm.receiptItems)
                        }
                    }, function (){ alert('Bad Request!!!') })

                    vm.supplyGrandTotalReturned = 0;
                    ReceiptSrvcs.receiptItems({receiptCode:vm.formData.receipt_code, receiptItemCode:'', receiptItemSupplyCode:'',isReturned:1}).then (function (response) {
                        if(response.data.status == 200)
                        {
                            vm.returneReceiptItems = response.data.data;
                            console.log(vm.returneReceiptItems)
                        }
                    }, function (){ alert('Bad Request!!!') })

                }, function (){ alert('Bad Request!!!') })
            };

            vm.removeReturnedSupplyBtn = function(receiptItemCode, receiptItemQuantity, supplyCode){
                
                vm.supplyGrandTotal = 0;
                ReceiptSrvcs.deleteReturnedReceiptItems({receiptItemCode:receiptItemCode, receiptItemQuantity:receiptItemQuantity, supplyCode:supplyCode}).then (function (response) {
                    console.log(response.data.data)
                    alert(response.data.message)
                    ReceiptSrvcs.receiptItems({receiptCode:vm.formData.receipt_code, receiptItemCode:'', receiptItemSupplyCode:'',isReturned:0}).then (function (response) {
                        if(response.data.status == 200)
                        {
                            vm.receiptItems = response.data.data;
                            console.log(vm.receiptItems)
                        }
                    }, function (){ alert('Bad Request!!!') })

                    vm.supplyGrandTotalReturned = 0;
                    ReceiptSrvcs.receiptItems({receiptCode:vm.formData.receipt_code, receiptItemCode:'', receiptItemSupplyCode:'',isReturned:1}).then (function (response) {
                        if(response.data.status == 200)
                        {
                            vm.returneReceiptItems = response.data.data;
                            console.log(vm.returneReceiptItems)
                        }
                    }, function (){ alert('Bad Request!!!') })

                }, function (){ alert('Bad Request!!!') })
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

            vm.addReceiptItems = function(data){
                console.log(data)
                data['is_warehouse'] = vm.formData.is_warehouse;
                ReceiptSrvcs.saveReceiptItems(data).then (function (response) {
                    if(response.data.status == 200)
                    {
                        
                        alert(response.data.message);
                        // vm.personalDetails = [
                        // {
                        //     'receipt_code':vm.formData.receipt_code,
                        //     'supply_name':'',
                        //     'supply_desc':'',
                        //     'supply_qty':'',
                        //     'supply_unit':0,
                        //     'supply_cost':0,
                        //     'supply_reorderlvl':'',
                        //     'supply_total':''
                        // }];

                        vm.supplyDetail = {
                            'receipt_code':$stateParams.receiptCode,
                            'supply_name':'',
                            'supply_desc':'',
                            'supply_qty':0,
                            'supply_unit':'',
                            'supply_cost':0,
                            'supply_reorderlvl':'',
                            'supply_total':''
                        };

                        SuppliesSrvcs.supplies({supplyCode:'', supplyCategory:'', poStatus:0, isRepair:2, reOrderLevelOutofSupply:3, supplyCategoryCode:''}).then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.supplies = response.data.data;
                                console.log(vm.supplies)
                            }
                        });

                        vm.supplyGrandTotal = 0;

                        ReceiptSrvcs.receiptItems({receiptCode:vm.formData.receipt_code, receiptItemCode:'', receiptItemSupplyCode:'',isReturned:'0'}).then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.receiptItems = response.data.data;
                                console.log(vm.receiptItems)
                            }
                        }, function (){ alert('Bad Request!!!') })
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            vm.addItems = function(){
                vm.routeTo('receipt/list');
            }

            vm.ok = function() {
                $uibModalInstance.close();
            };
            
            vm.routeTo = function(route){
                $window.location.href = route;
            };

            vm.printReceiptDetails = function(tag){
                vm.url = 'receipt/report/'+tag;
            }
        }

        ReceiptEditModalInstanceCtrl.$inject = ['$state', '$stateParams', 'SuppliersSrvcs', 'PurchaseOrdersSrvcs', 'BanksSrvcs', '$uibModalInstance', 'formData', 'RequisitionsSrvcs', 'EmployeesSrvcs', 'ReceiptSrvcs', 'SuppliesSrvcs', 'OrganizationsSrvcs', 'ProjectsSrvcs', '$window'];
        function ReceiptEditModalInstanceCtrl ($state, $stateParams, SuppliersSrvcs, PurchaseOrdersSrvcs, BanksSrvcs, $uibModalInstance, formData, RequisitionsSrvcs, EmployeesSrvcs, ReceiptSrvcs, SuppliesSrvcs, OrganizationsSrvcs, ProjectsSrvcs, $window) {

            var vm = this;
            vm.formData = formData.receipt;
            console.log(vm.formData)

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

            SuppliersSrvcs.suppliers({supplierCode:''}).then(function(response){
                if (response.data.status == 200) {
                    vm.suppliers = response.data.data;
                }
                else {
                    alert(response.data.message);
                }
                console.log(response.data);
            });

            ReceiptSrvcs.receiptTypes().then (function (response) {
                if(response.data.status == 200)
                {
                    vm.receiptTypes = response.data.data;
                    console.log(vm.receiptTypes)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.selectPayeeType = function(payeeType){
                // alert(payeeType)
                // console.log(data);
                vm.payeeType = payeeType;

                if(payeeType=="EMPLOYEE")
                {          
                    EmployeesSrvcs.employees({jobType:''}).then(function(response){
                        if (response.data.status == 200) {
                            vm.employees = response.data.data;
                        }
                        else {
                            alert(response.data.message);
                        }
                        console.log(response.data);
                    });
                }
                else if(payeeType=="SUPPLIER")
                {
                    SuppliersSrvcs.suppliers({supplierCode:''}).then(function(response){
                        if (response.data.status == 200) {
                            vm.suppliers = response.data.data;
                        }
                        else {
                            alert(response.data.message);
                        }
                        console.log(response.data);
                    });
                }
                else if(payeeType=="BANK")
                {
                    BanksSrvcs.banks({bankCode:''}).then(function(response){
                        if (response.data.status == 200) {
                            vm.banks = response.data.data;
                        }
                        else {
                            alert(response.data.message);
                        }
                        console.log(response.data);
                    });
                }
                else
                {
                    alert("Please select Payee Type!")
                }

            };


            vm.purchaseDetails = {
                poCode:'', 
                referenceCode:'', 
                supplierCode:vm.formData.payee, 
                poStatus:2, 
                dateFrom:'', 
                dateTo:'' 
            }

            PurchaseOrdersSrvcs.pos(vm.purchaseDetails).then (function (response) { //get all open po status
                if(response.data.status == 200)
                {
                    vm.pos = response.data.data;
                    console.log(vm.pos)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.selectPayee = function(payeeType, supplierCode){
                // alert(payee)

                alert(supplierCode)

                vm.purchaseDetails = {
                    poCode:'', 
                    referenceCode:'', 
                    supplierCode:supplierCode, 
                    poStatus:2, 
                    dateFrom:'', 
                    dateTo:''
                }

                PurchaseOrdersSrvcs.pos(vm.purchaseDetails).then (function (response) { //get all open po status
                    if(response.data.status == 200)
                    {
                        vm.pos = response.data.data;
                        console.log(vm.pos)
                    }
                }, function (){ alert('Bad Request!!!') })


                if(payeeType == "SUPPLIER")
                {
            
                    vm.supplierStatus = true;
                    
                }
                else{
                    vm.supplierStatus = false;

                }
            }

            vm.updateReceipt = function(data){
                console.log(data)

                ReceiptSrvcs.update(data).then (function (response) {
                    console.log(response.data)
                    if(response.data.status == 200)
                    {
                        alert(response.data.message);
                    
                        $state.go('list-receipt2');
                        vm.ok();
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            vm.ok = function() {
                $uibModalInstance.close();
            };
        }

        ReceiptDeleteModalInstanceCtrl.$inject = ['$state', '$stateParams', '$uibModalInstance', 'formData', 'RequisitionsSrvcs', 'EmployeesSrvcs', 'ReceiptSrvcs', 'SuppliesSrvcs', 'OrganizationsSrvcs', 'ProjectsSrvcs', '$window'];
        function ReceiptDeleteModalInstanceCtrl ($state, $stateParams, $uibModalInstance, formData, RequisitionsSrvcs, EmployeesSrvcs, ReceiptSrvcs, SuppliesSrvcs, OrganizationsSrvcs, ProjectsSrvcs, $window) {

            var vm = this;
            vm.formData = formData.receipt;
            console.log(vm.formData)
            // alert(vm.formData.asset_name)


            vm.ok = function() {
                $uibModalInstance.close();
            };

            
            vm.deleteReceipt = function(receipt_code){

                ReceiptSrvcs.delete({receipt_code:receipt_code}).then (function (response) {
                        console.log(response.data)
                        if(response.data.status == 200)
                        {
                            alert(response.data.message);
                            
                            $state.go('list-receipt2');
                            vm.ok();
                        }
                    }, function (){ alert('Bad Request!!!') })
                }
        }
})();

