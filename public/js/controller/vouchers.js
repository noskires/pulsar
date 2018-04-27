(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .controller('VouchersCtrl', VouchersCtrl)

        VouchersCtrl.$inject = ['$stateParams', 'VouchersSrvcs', 'ParticularsSrvcs', 'EmployeesSrvcs', 'SuppliersSrvcs', 'BanksSrvcs', 'ReceiptSrvcs', 'RequisitionsSrvcs', 'AssetsSrvcs', 'JobOrdersSrvcs', '$window', '$uibModal'];
        function VouchersCtrl($stateParams, VouchersSrvcs, ParticularsSrvcs, EmployeesSrvcs, SuppliersSrvcs, BanksSrvcs, ReceiptSrvcs, RequisitionsSrvcs, AssetsSrvcs, JobOrdersSrvcs, $window, $uibModal){
            var vm = this;
            var data = {};
            vm.payeeType = "SUPPLIER";

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

})();

