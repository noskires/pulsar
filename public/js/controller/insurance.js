(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .controller('InsuranceCtrl', InsuranceCtrl)
        .controller('InsuranceModalInstanceCtrl', InsuranceModalInstanceCtrl)

        InsuranceCtrl.$inject = ['$stateParams', 'InsuranceSrvcs', 'BanksSrvcs', 'SuppliesSrvcs', 'ReceiptSrvcs', 'StockUnitsSrvcs', 'RequisitionsSrvcs', 'AssetsSrvcs', 'JobOrdersSrvcs', '$window', '$uibModal'];
        function InsuranceCtrl($stateParams, InsuranceSrvcs, BanksSrvcs, SuppliesSrvcs, ReceiptSrvcs, StockUnitsSrvcs, RequisitionsSrvcs, AssetsSrvcs, JobOrdersSrvcs, $window, $uibModal){
            var vm = this;
            var data = {};

            if($stateParams.insuranceCode)
            {
                vm.insuranceCode = $stateParams.insuranceCode;

                BanksSrvcs.banks({insuranceCode:vm.insuranceCode}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.insurance = response.data.data[0];
                        console.log(vm.bank)

                        var modalInstance = $uibModal.open({
                            controller:'InsuranceModalInstanceCtrl',
                            templateUrl:'insuranceInfo.modal',
                            controllerAs: 'vm',
                            resolve :{
                                formData: function () {
                                    return {
                                        title:'Insurance Controller',
                                        message:response.data.message,
                                        insurance: vm.bank
                                    };
                                }
                            },
                            size: 'lg'
                        });
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            InsuranceSrvcs.insurance({insuranceCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.insurance = response.data.data;
                    console.log(vm.banks)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.newInsurance = function(data){
                console.log(data)

                InsuranceSrvcs.save(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);
                        // vm.routeTo('bank/list');
                        vm.ok();
                    }
                    else {
                        alert(response.data.message);
                    }
                    console.log(response.data);
                });
            };

            vm.ok = function(){
                $uibModalInstance.close();
            };

            vm.routeTo = function(route){
                $window.location.href = route;
            }; 
        }

        InsuranceModalInstanceCtrl.$inject = ['$stateParams', '$uibModalInstance', 'BanksSrvcs', 'formData', 'ReceiptSrvcs'];
        function InsuranceModalInstanceCtrl ($stateParams, $uibModalInstance, BanksSrvcs, formData, ReceiptSrvcs) {
            alert('insurance model')
            var vm = this;
            vm.formData = formData.insurance; 

            vm.updateBank = function(data){
                BanksSrvcs.update(data).then (function (response) {
                    if(response.data.status == 200)
                    {
                        alert(response.data.message);
                    }
                    vm.ok();
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