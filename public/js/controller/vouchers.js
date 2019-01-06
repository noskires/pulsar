(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .controller('VouchersCtrl', VouchersCtrl)
        .controller('VouchersModalInstanceCtrl', VouchersModalInstanceCtrl)

        VouchersCtrl.$inject = ['$stateParams', 'VouchersSrvcs', 'ParticularsSrvcs', 'EmployeesSrvcs', 'SuppliersSrvcs', 'BanksSrvcs', 'ReceiptSrvcs', 'RequisitionsSrvcs', 'AssetsSrvcs', 'JobOrdersSrvcs', 'FundsSrvcs', '$window', '$uibModal'];
        function VouchersCtrl($stateParams, VouchersSrvcs, ParticularsSrvcs, EmployeesSrvcs, SuppliersSrvcs, BanksSrvcs, ReceiptSrvcs, RequisitionsSrvcs, AssetsSrvcs, JobOrdersSrvcs, FundsSrvcs, $window, $uibModal){
            var vm = this;
            var data = {};
            vm.payeeType = "SUPPLIER";

            if($stateParams.voucherCode)
            {
                vm.voucherCode = $stateParams.voucherCode;
                // alert(vm.receiptCode);
                VouchersSrvcs.vouchers({voucherCode:vm.voucherCode }).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.voucher = response.data.data[0];
                        console.log(vm.voucher)

                        var modalInstance = $uibModal.open({
                            controller:'VouchersModalInstanceCtrl',
                            templateUrl:'voucherInfo.modal',
                            controllerAs: 'vm',
                            resolve :{
                              formData: function () {
                                return {
                                    title:'Voucher Controller',
                                    message:response.data.message,
                                    voucher: vm.voucher
                                };
                              }
                            },
                            size: 'lg'
                        });
                    }
                }, function (){ alert('Bad Request!!!') })

            }

            SuppliersSrvcs.suppliers({supplierCode:''}).then(function(response){
                if (response.data.status == 200) {
                    vm.suppliers = response.data.data;
                }
                else {
                    alert(response.data.message);
                }
                console.log(response.data);
            });

            ParticularsSrvcs.particulars({particularCode:''}).then(function(response){
                if(response.data.status == 200)
                {
                    vm.particulars = response.data.data;
                    console.log(vm.particulars)
                }
            }, function (){ alert('Bad Request!!!') })

            VouchersSrvcs.vouchers({voucherCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.vouchers = response.data.data;
                    console.log(vm.vouchers)
                }
            }, function (){ alert('Bad Request!!!') })

            FundsSrvcs.funds({fundCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.funds = response.data.data;
                    console.log(vm.funds)
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

            vm.selectFund = function(fundCode){
                vm.fundCode = fundCode;
                // alert(vm.fundCode)

                FundsSrvcs.fundItems({fundCode:vm.fundCode, fundItemCode:'', filterFundItem:0}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.fundItems = response.data.data;
                        vm.totalFundItems = response.data.totalFundItems;
                        console.log(vm.fundItems)
                    }
                }, function (){ alert('Bad Request!!!') })

            }

            vm.newVoucher = function(data){
                console.log(data);
                VouchersSrvcs.save(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);
                        vm.routeTo('voucher/list');
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


        VouchersModalInstanceCtrl.$inject = ['$uibModalInstance', 'formData', 'ReceiptSrvcs', 'VouchersSrvcs', 'BanksSrvcs', '$window'];
        function VouchersModalInstanceCtrl ($uibModalInstance, formData, ReceiptSrvcs, VouchersSrvcs, BanksSrvcs, $window) {

            var vm = this;
            vm.formData = formData.voucher;
            console.log(vm.formData)

            vm.voucherItemDetails = [];

            VouchersSrvcs.voucherItems({voucherCode:vm.formData.voucher_code, voucherItemCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.voucherItems = response.data.data;
                    console.log(vm.voucherItems)
                }
            }, function (){ alert('Bad Request!!!') })

            ReceiptSrvcs.receipts({receiptCode:'', payeeType:vm.formData.payee_type, payee:vm.formData.payee, voucherCode:vm.formData.voucher_code}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.receipts = response.data.data;
                    console.log(vm.receipts)
                }
            }, function (){ alert('Bad Request!!!') })

            BanksSrvcs.banks({bankCode:''}).then(function(response){
                if (response.data.status == 200) {
                    vm.banks = response.data.data;
                    console.log(vm.banks)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.newItem = function(receiptDetails, active)
            {
                receiptDetails['voucher_code'] = vm.formData.voucher_code;
                if (active)
                {

                    vm.voucherItemDetails.push(receiptDetails);
                }
                else
                {
                    vm.voucherItemDetails.splice(vm.voucherItemDetails.indexOf(receiptDetails), 1);
                }

            }

            vm.newVoucherItem = function(data)
            {
                console.log(data);
                VouchersSrvcs.saveVoucherItems(data).then (function (response) {
                    if(response.data.status == 200)
                    {
                        alert(response.data.message);
                        vm.voucherItemDetails = [];

                        vm.voucherItemGrandTotal = 0;

                        VouchersSrvcs.voucherItems({voucherCode:vm.formData.voucher_code, voucherItemCode:''}).then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.voucherItems = response.data.data;
                                console.log(vm.voucherItems)
                            }
                        }, function (){ alert('Bad Request!!!') })

                        ReceiptSrvcs.receipts({receiptCode:'', payeeType:vm.formData.payee_type, payee:vm.formData.payee, voucherCode:vm.formData.voucher_code}).then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.receipts = response.data.data;
                                console.log(vm.receipts)
                            }
                        }, function (){ alert('Bad Request!!!') })
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            vm.updateVoucher = function(data)
            {
                data['voucherCode'] = vm.formData.voucher_code;
                VouchersSrvcs.update(data).then (function (response) {
                    if(response.data.status == 200)
                    {
                        alert(response.data.message);
                        vm.routeTo('voucher/list');
                    }
                    console.log(response.data)
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

