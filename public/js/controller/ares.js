(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .controller('AreCtrl', AreCtrl)
        .controller('AreModalInstanceCtrl', AreModalInstanceCtrl)

        AreCtrl.$inject = ['$stateParams','AresSrvcs', 'EmployeesSrvcs', 'InsuranceSrvcs', 'BanksSrvcs', 'SuppliesSrvcs', 'ReceiptSrvcs', 'StockUnitsSrvcs', 'RequisitionsSrvcs', 'AssetsSrvcs', 'JobOrdersSrvcs', '$window', '$uibModal'];
        function AreCtrl($stateParams, AresSrvcs, EmployeesSrvcs, InsuranceSrvcs, BanksSrvcs, SuppliesSrvcs, ReceiptSrvcs, StockUnitsSrvcs, RequisitionsSrvcs, AssetsSrvcs, JobOrdersSrvcs, $window, $uibModal){
            var vm = this;
            var data = {};

            // alert($stateParams.areCode)
            if($stateParams.areCode)
            {
                vm.areCode = $stateParams.areCode;

                AresSrvcs.ares({areCode:vm.areCode}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.are = response.data.data[0];
                        console.log(vm.are)

                        var modalInstance = $uibModal.open({
                            controller:'AreModalInstanceCtrl',
                            templateUrl:'areInfo.modal',
                            controllerAs: 'vm',
                            resolve :{
                                formData: function () {
                                    return {
                                        title:'Are Controller',
                                        message:response.data.message,
                                        are: vm.are
                                    };
                                }
                            },
                            size: 'lg'
                        });
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            EmployeesSrvcs.employees({jobType:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.employees = response.data.data;
                    console.log(vm.employees)
                }
            }, function (){ alert('Bad Request!!!') })

            AresSrvcs.ares({areCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.ares = response.data.data;
                    console.log(vm.ares)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.newAreBtn = function(data){
                console.log(data)
                AresSrvcs.save(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);
                        AresSrvcs.ares({areCode:''}).then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.ares = response.data.data;
                                console.log(vm.ares)
                            }
                        }, function (){ alert('Bad Request!!!') })
                        // vm.ok();
                        // vm.state = false;
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

        AreModalInstanceCtrl.$inject = ['$stateParams', '$uibModalInstance', 'AssetsSrvcs', 'InsuranceSrvcs', 'BanksSrvcs', 'formData', 'ReceiptSrvcs'];
        function AreModalInstanceCtrl ($stateParams, $uibModalInstance, AssetsSrvcs, InsuranceSrvcs, BanksSrvcs, formData, ReceiptSrvcs) {
            // alert('insurance model')
            var vm = this;
            vm.formData = formData.are;
            console.log(vm.formData) 
            // console.log(vm.formData)

            vm.areCode = $stateParams.areCode;

            vm.assetsDetails = {
                tag:'', 
                name:'', 
                category:'', 
                areCode:$stateParams.areCode, 
                status:'',
                isAll:0
            }
            AssetsSrvcs.assets(vm.assetsDetails).then (function (response) { 
                if(response.data.status == 200)
                {
                    vm.assignedAssets = response.data.data;
                    console.log(vm.assignedAssets)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.assetsDetails = {
                tag:'', 
                name:'', 
                category:'', 
                areCode:'', 
                status:'',
                isAll:0
            }
            AssetsSrvcs.assets(vm.assetsDetails).then (function (response) { 
                if(response.data.status == 200)
                {
                    vm.availableAssets = response.data.data;
                    console.log(vm.availableAssets)
                }
            }, function (){ alert('Bad Request!!!') })


            vm.assignAssetBtn =  function(assetTag){
                // alert(assetTag)
                AssetsSrvcs.update({tag:assetTag, areCode:$stateParams.areCode}).then (function (response) {
                    
                    vm.assetsDetails = {
                        tag:'', 
                        name:'', 
                        category:'', 
                        areCode:$stateParams.areCode,
                        status:'',
                        isAll:0
                    }
                    AssetsSrvcs.assets(vm.assetsDetails).then (function (response) { 
                        if(response.data.status == 200)
                        {
                            vm.assignedAssets = response.data.data;
                            console.log(vm.assignedAssets)
                        }
                    }, function (){ alert('Bad Request!!!') })

                    vm.assetsDetails = {
                        tag:'', 
                        name:'', 
                        category:'', 
                        areCode:'',
                        status:'',
                        isAll:0
                    }
                    AssetsSrvcs.assets(vm.assetsDetails).then (function (response) {
                        if(response.data.status == 200)
                        {
                            vm.availableAssets = response.data.data;
                            console.log(vm.availableAssets)
                        }
                    }, function (){ alert('Bad Request!!!') })

                    // AssetsSrvcs.assetEvents({tag:'', name:'', category:'', areCode:'', assetEventCode:''}).then (function (response) {
                    //     if(response.data.status == 200)
                    //     {
                    //         vm.assetEvents = response.data.data;
                    //         console.log(vm.assetEvents)
                    //     }
                    // }, function (){ alert('Bad Request!!!') })

                }, function (){ alert('Bad Request!!!') })
            }
            // AssetsSrvcs.assets({tag:tag, name:'', category:'', areCode:$stateParams.areCode}).then (function (response) {
            //     if(response.data.status == 200)
            //     {
            //         vm.assignedAssets = response.data.data;
            //         console.log(vm.assets)
            //     }
            // }, function (){ alert('Bad Request!!!') })

            // vm.updateInsurance = function(data){
            //     InsuranceSrvcs.update(data).then (function (response) {
            //         if(response.data.status == 200)
            //         {
            //             alert(response.data.message);
            //             vm.ok();
            //         }
            //         else
            //         {
            //             alert(response.data.message);
            //         }
                    
            //     }, function (){ alert('Bad Request!!!') })
            // }

            // InsuranceSrvcs.insuranceItems({insuranceCode:$stateParams.insuranceCode, insuranceItemCode:'',assetCode:'', insuranceItemStatus:1}).then (function (response) {
            //     if(response.data.status == 200)
            //     {
            //         vm.associatedAssets = response.data.data;
            //         console.log(vm.associatedAssets)
            //     }
            // }, function (){ alert('Bad Request!!!') })

            // InsuranceSrvcs.insuranceItems({insuranceCode:'', insuranceItemCode:'',assetCode:'', insuranceItemStatus:2}).then (function (response) {
            //     if(response.data.status == 200)
            //     {
            //         vm.availableAssets = response.data.data;
            //         console.log(vm.availableAssets)
            //     }
            // }, function (){ alert('Bad Request!!!') })

            // vm.addInsuranceItems = function(assetTag){
                // alert(assetTag)

                // data = {insuranceCode:$stateParams.insuranceCode, assetTag:assetTag};

                // InsuranceSrvcs.saveInsuranceItems({insurance_code:$stateParams.insuranceCode, asset_code:assetTag}).then (function (response) {
            //         if(response.data.status == 200)
            //         {
            //             alert(response.data.message);

            //             InsuranceSrvcs.insuranceItems({insuranceCode:$stateParams.insuranceCode, insuranceItemCode:'',assetCode:'', insuranceItemStatus:1}).then (function (response) {
            //                 if(response.data.status == 200)
            //                 {
            //                     vm.associatedAssets = response.data.data;
            //                     console.log(vm.associatedAssets)
            //                 }
            //             }, function (){ alert('Bad Request!!!') })

            //             InsuranceSrvcs.insuranceItems({insuranceCode:'', insuranceItemCode:'',assetCode:'', insuranceItemStatus:2}).then (function (response) {
            //                 if(response.data.status == 200)
            //                 {
            //                     vm.availableAssets = response.data.data;
            //                     console.log(vm.availableAssets)
            //                 }
            //             }, function (){ alert('Bad Request!!!') })
            //         }
            //     }, function (){ alert('Bad Request!!!') })
            // }

            // vm.removeInsuranceItems = function(insuranceItemCode){

            //     InsuranceSrvcs.removeInsuranceItems({insurance_item_code:insuranceItemCode}).then (function (response) {
            //         if(response.data.status == 200)
            //         {
            //             alert(response.data.message);

            //             InsuranceSrvcs.insuranceItems({insuranceCode:$stateParams.insuranceCode, insuranceItemCode:'',assetCode:'', insuranceItemStatus:1}).then (function (response) {
            //                 if(response.data.status == 200)
            //                 {
            //                     vm.associatedAssets = response.data.data;
            //                     console.log(vm.associatedAssets)
            //                 }
            //             }, function (){ alert('Bad Request!!!') })

            //             InsuranceSrvcs.insuranceItems({insuranceCode:'', insuranceItemCode:'',assetCode:'', insuranceItemStatus:2}).then (function (response) {
            //                 if(response.data.status == 200)
            //                 {
            //                     vm.availableAssets = response.data.data;
            //                     console.log(vm.availableAssets)
            //                 }
            //             }, function (){ alert('Bad Request!!!') })
            //         }
            //         // console.log(response.data)
            //     }, function (){ alert('Bad Request!!!') })
            // }

            vm.ok = function(){
                $uibModalInstance.close();
            };

            vm.routeTo = function(route){
                $window.location.href = route;
            };

        }
})();