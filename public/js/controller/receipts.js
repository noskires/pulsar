(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .controller('ReceiptsCtrl', ReceiptsCtrl)
        // .controller('ReceiptItemsCtrl', ReceiptItemsCtrl)
        .controller('ReceiptsModalInstanceCtrl', ReceiptsModalInstanceCtrl)

        ReceiptsCtrl.$inject = ['$stateParams', 'ReceiptSrvcs', 'RequisitionsSrvcs', 'AssetsSrvcs', 'JobOrdersSrvcs', '$window', '$uibModal'];
        function ReceiptsCtrl($stateParams, ReceiptSrvcs, RequisitionsSrvcs, AssetsSrvcs, JobOrdersSrvcs, $window, $uibModal){
            var vm = this;
            var data = {};

            if($stateParams.receiptCode)
            {

                vm.receiptCode = $stateParams.receiptCode;
                // alert(vm.receiptCode);

                ReceiptSrvcs.receipts({receiptCode:vm.receiptCode}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.receipt = response.data.data[0];
                        console.log(vm.receipt)

                        var modalInstance = $uibModal.open({
                            controller:'ReceiptsModalInstanceCtrl',
                            templateUrl:'receiptInfo.modal',
                            controllerAs: 'vm',
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
                }, function (){ alert('Bad Request!!!') })

            }

            ReceiptSrvcs.receipts({receiptCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.receipts = response.data.data;
                    console.log(vm.receipts)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.newReceipt = function(data){
                // console.log(data);
                ReceiptSrvcs.save(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);
                        vm.routeTo('receipt/new');
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

        ReceiptsModalInstanceCtrl.$inject = ['$uibModalInstance', 'formData', 'ReceiptSrvcs'];
        function ReceiptsModalInstanceCtrl ($uibModalInstance, formData, ReceiptSrvcs) {

            var vm = this;
            vm.formData = formData.receipt;
            console.log(vm.formData)
            vm.personalDetails = [
            {
                'receipt_code':vm.formData.receipt_code,
                'supply_name':'',
                'supply_desc':'',
                'supply_qty':'',
                'supply_unit':'',
                'supply_reorderlvl':'',
                'supply_total':''
            }];

            ReceiptSrvcs.receiptItems({receiptCode:vm.formData.receipt_code, receiptItemCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.receiptItems = response.data.data;
                    console.log(vm.receiptItems)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.addNew = function(){
                vm.personalDetails.push({ 
                'receipt_code':vm.formData.receipt_code,
                'supply_name':"",
                'supply_desc':"",
                'supply_qty':"",
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

                ReceiptSrvcs.saveReceiptItems(data).then (function (response) {
                    if(response.data.status == 200)
                    {
                        alert(response.data.message);
                        vm.personalDetails = [
                        {
                            'receipt_code':vm.formData.receipt_code,
                            'supply_name':'',
                            'supply_desc':'',
                            'supply_qty':'',
                            'supply_unit':'',
                            'supply_reorderlvl':'',
                            'supply_total':''
                        }];

                        ReceiptSrvcs.receiptItems({receiptCode:vm.formData.receipt_code, receiptItemCode:''}).then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.receiptItems = response.data.data;
                                console.log(vm.receiptItems)
                            }
                        }, function (){ alert('Bad Request!!!') })
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            vm.ok = function() {
                $uibModalInstance.close();
            };
            
            vm.routeTo = function(route){
                $window.location.href = route;
            };
        }
})();

