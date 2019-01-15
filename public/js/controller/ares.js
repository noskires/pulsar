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

        AreModalInstanceCtrl.$inject = ['$stateParams', '$uibModalInstance', 'AresSrvcs', 'AssetsSrvcs', 'InsuranceSrvcs', 'BanksSrvcs', 'formData', 'ReceiptSrvcs'];
        function AreModalInstanceCtrl ($stateParams, $uibModalInstance, AresSrvcs, AssetsSrvcs, InsuranceSrvcs, BanksSrvcs, formData, ReceiptSrvcs) {
            // alert('insurance model')
            var vm = this;
            vm.formData = formData.are;
            console.log(vm.formData) 

            vm.areCode = $stateParams.areCode;
            
            // alert(vm.areCode)
            vm.assetItemDetails = [
            {
                'are_code':vm.areCode,
                'asset_code':'',
                'started_at':''
            }];

            // vm.assetsDetails = {
            //     tag:'', 
            //     name:'', 
            //     category:'', 
            //     areCode:$stateParams.areCode, 
            //     status:'',
            //     withActiveAre:1
            // }

            // AssetsSrvcs.assets(vm.assetsDetails).then (function (response) { 
            //     if(response.data.status == 200)
            //     {
            //         vm.assignedAssets = response.data.data;
            //         console.log(vm.assignedAssets)
            //     }
            // }, function (){ alert('Bad Request!!!') })

            vm.areItemDetails = {
                areCode:vm.areCode,
                areItemCode:'',
                assetCode:'',
            }


            vm.assetsDetails = {
                tag:'',
                name:'',
                category:'',
                areCode:'',
                status:'',
                isAll:0,
                withActiveAre:0
            }

            AssetsSrvcs.assets(vm.assetsDetails).then (function (response) { 
                if(response.data.status == 200)
                {
                    vm.availableAssets = response.data.data;
                    console.log(vm.availableAssets)
                }
            }, function (){ alert('Bad Request!!!') })


            AresSrvcs.areItems(vm.areItemDetails).then (function (response) { 
                if(response.data.status == 200)
                {
                    vm.assignedAssets = response.data.data;
                    console.log(vm.assignedAssets)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.addAreItems = function(data){

                console.log(data)

                AresSrvcs.saveAreItems(data[0]).then (function (response) {
                    if(response.data.status == 200)
                    {

                        alert(response.data.message);
                        console.log(response.data.data)
                        vm.assetItemDetails = [
                        {
                            'are_code':vm.areCode,
                            'asset_code':'asset_code',
                            'started_at':''
                        }];

                        vm.assetsDetails = {
                            tag:'', 
                            name:'', 
                            category:'', 
                            areCode:'', 
                            status:'',
                            isAll:0,
                            withActiveAre:0
                        }
                        
                        AssetsSrvcs.assets(vm.assetsDetails).then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.availableAssets = response.data.data;
                                console.log(vm.availableAssets)
                            }
                        }, function (){ alert('Bad Request!!!') })


                        AresSrvcs.areItems(vm.areItemDetails).then (function (response) { 
                            if(response.data.status == 200)
                            {
                                vm.assignedAssets = response.data.data;
                                console.log(vm.assignedAssets)
                            }
                        }, function (){ alert('Bad Request!!!') })

                    }
                }, function (){ alert('Bad Request!!!') })
            }

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