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
            // alert($stateParams.insuranceCode)
            if($stateParams.insuranceCode)
            {
                vm.insuranceCode = $stateParams.insuranceCode;

                InsuranceSrvcs.insurance({insuranceCode:vm.insuranceCode}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.insurance = response.data.data[0];
                        console.log(vm.insurance)

                        var modalInstance = $uibModal.open({
                            controller:'InsuranceModalInstanceCtrl',
                            templateUrl:'insuranceInfo.modal',
                            controllerAs: 'vm',
                            resolve :{
                                formData: function () {
                                    return {
                                        title:'Insurance Controller',
                                        message:response.data.message,
                                        insurance: vm.insurance
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
                        InsuranceSrvcs.insurance({insuranceCode:''}).then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.insurance = response.data.data;
                                console.log(vm.banks)
                            }
                        }, function (){ alert('Bad Request!!!') })
                        vm.ok();
                        vm.state = false;
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
        }

        InsuranceModalInstanceCtrl.$inject = ['$stateParams', '$uibModalInstance', 'InsuranceSrvcs', 'BanksSrvcs', 'formData', 'ReceiptSrvcs'];
        function InsuranceModalInstanceCtrl ($stateParams, $uibModalInstance, InsuranceSrvcs, BanksSrvcs, formData, ReceiptSrvcs) {
            // alert('insurance model')
            var vm = this;
            vm.formData = formData.insurance; 
            // console.log(vm.formData)

            vm.updateInsurance = function(data){
                InsuranceSrvcs.update(data).then (function (response) {
                    if(response.data.status == 200)
                    {
                        alert(response.data.message);
                        vm.ok();
                    }
                    else
                    {
                        alert(response.data.message);
                    }
                    
                }, function (){ alert('Bad Request!!!') })
            }

            InsuranceSrvcs.insuranceItems({insuranceCode:$stateParams.insuranceCode, insuranceItemCode:'',assetCode:'', insuranceItemStatus:1}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.associatedAssets = response.data.data;
                    console.log(vm.associatedAssets)
                }
            }, function (){ alert('Bad Request!!!') })

            InsuranceSrvcs.insuranceItems({insuranceCode:'', insuranceItemCode:'',assetCode:'', insuranceItemStatus:2}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.availableAssets = response.data.data;
                    console.log(vm.availableAssets)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.addInsuranceItems = function(assetTag){
                // alert(assetTag)

                // data = {insuranceCode:$stateParams.insuranceCode, assetTag:assetTag};

                InsuranceSrvcs.saveInsuranceItems({insurance_code:$stateParams.insuranceCode, asset_code:assetTag}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        alert(response.data.message);

                        InsuranceSrvcs.insuranceItems({insuranceCode:$stateParams.insuranceCode, insuranceItemCode:'',assetCode:'', insuranceItemStatus:1}).then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.associatedAssets = response.data.data;
                                console.log(vm.associatedAssets)
                            }
                        }, function (){ alert('Bad Request!!!') })

                        InsuranceSrvcs.insuranceItems({insuranceCode:'', insuranceItemCode:'',assetCode:'', insuranceItemStatus:2}).then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.availableAssets = response.data.data;
                                console.log(vm.availableAssets)
                            }
                        }, function (){ alert('Bad Request!!!') })
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            vm.removeInsuranceItems = function(insuranceItemCode){

                InsuranceSrvcs.removeInsuranceItems({insurance_item_code:insuranceItemCode}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        alert(response.data.message);

                        InsuranceSrvcs.insuranceItems({insuranceCode:$stateParams.insuranceCode, insuranceItemCode:'',assetCode:'', insuranceItemStatus:1}).then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.associatedAssets = response.data.data;
                                console.log(vm.associatedAssets)
                            }
                        }, function (){ alert('Bad Request!!!') })

                        InsuranceSrvcs.insuranceItems({insuranceCode:'', insuranceItemCode:'',assetCode:'', insuranceItemStatus:2}).then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.availableAssets = response.data.data;
                                console.log(vm.availableAssets)
                            }
                        }, function (){ alert('Bad Request!!!') })
                    }
                    // console.log(response.data)
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