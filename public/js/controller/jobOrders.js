(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .controller('JobOrdersCtrl', JobOrdersCtrl) 
        .controller('JobOrderModalInstanceCtrl',JobOrderModalInstanceCtrl)

        JobOrdersCtrl.$inject = ['$state', 'JobOrdersSrvcs', 'AssetsSrvcs', 'EmployeesSrvcs', 'AssetCategoriesSrvcs', '$window', '$stateParams', '$uibModal'];
        function JobOrdersCtrl($state, JobOrdersSrvcs, AssetsSrvcs, EmployeesSrvcs, AssetCategoriesSrvcs, $window, $stateParams, $uibModal){
            var vm = this;
            var data = {}; 
            var tag = "";

            // alert($stateParams.assetTag);
            // alert($stateParams.joCode)
            
            JobOrdersSrvcs.jobOrders({joCode:'', joStatus:1, assetCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.jobOrders = response.data.data;
                    console.log(vm.jobOrders)
                }
            }, function (){ alert('Bad Request!!!') })

            EmployeesSrvcs.employees({jobType:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.employees = response.data.data;
                    console.log(vm.employees)
                }
            }, function (){ alert('Bad Request!!!') })

            


            AssetCategoriesSrvcs.AssetCategories({assetCategoryCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.assetCategories = response.data.data;
                    console.log(vm.assetCategories)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.selectCategory = function(assetCategory){
                // alert(assetCategory)

                vm.assetsDetails = {
                    assetCode:'',
                    name:'',
                    category:assetCategory,
                    areCode:'',
                    status:'',
                    isAll:0,
                    withActiveAre:2 // 2 means shall all records 
                }

                AssetsSrvcs.assets(vm.assetsDetails).then (function (response) { 
                    if(response.data.status == 200)
                    {
                        vm.assets = response.data.data;
                        console.log(vm.assets)
                        console.log(response.data)
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            vm.createJoBtn = function(data){
                // alert(data)
                console.log(data)

                JobOrdersSrvcs.save2(data).then(function(response){
                    if (response.data.status == 200) {

                        JobOrdersSrvcs.jobOrders({joCode:'', joStatus:1, assetCode:''}).then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.jobOrders = response.data.data;
                                console.log(vm.jobOrders)
                            }
                        }, function (){ alert('Bad Request!!!') })
                        alert(response.data.message);
                    }
                    else {
                        alert(response.data.message);
                        console.log(response.data);
                    }
                }, function (){ console.log(response.data); alert('Bad Request!!!') });
            }

            if($stateParams.assetCode!=null)
            {

                vm.assetsDetails = {
                    tag:$stateParams.assetCode, 
                    name:'', 
                    category:'', 
                    areCode:'', 
                    status:'',
                    isAll:1, 
                    withActiveAre:2
                }

                AssetsSrvcs.assets(vm.assetsDetails).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.asset = response.data.data[0];
                        console.log(vm.asset)

                        // vm.joDetails = {
                        //     tag: vm.asset.tag,
                        //     name: vm.asset.name,
                        //     location_code: vm.asset.municipality_code,
                        //     location: vm.asset.municipality_text,
                        //     requestingEmployee: vm.asset.employee_name,
                        // };
                        
                        console.log(vm.joDetails);
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            if($stateParams.joCode){
                JobOrdersSrvcs.jobOrders({joCode:$stateParams.joCode,joStatus:'', assetCode:''}).then (function (response) {

                    if(response.data.status == 200)
                    {
                        vm.jobOrder = response.data.data[0];
                        console.log(vm.jobOrder)

                        var modalInstance = $uibModal.open({
                            controller:'JobOrderModalInstanceCtrl',
                            templateUrl:'jobOrderInfo.modal',
                            controllerAs: 'vm',
                            resolve :{
                              formData: function () {
                                return {
                                    title:'Job Order Controller',
                                    message:response.data.message,
                                    jobOrder: response.data.data[0]
                                };
                              }
                            },
                            size: 'xlg'
                        });
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            if($stateParams.joCode2){
                JobOrdersSrvcs.jobOrders({joCode:$stateParams.joCode2,joStatus:'', assetCode:''}).then (function (response) {

                    if(response.data.status == 200)
                    {
                        vm.jobOrder = response.data.data[0];
                        console.log(vm.jobOrder)

                        var modalInstance = $uibModal.open({
                            controller:'JobOrderModalInstanceCtrl',
                            templateUrl:'jobOrderInfo2.modal',
                            controllerAs: 'vm',
                            resolve :{
                              formData: function () {
                                return {
                                    title:'Job Order Controller',
                                    message:response.data.message,
                                    jobOrder: response.data.data[0]
                                };
                              }
                            },
                            size: 'xlg'
                        });
                    }
                }, function (){ alert('Bad Request!!!') })
            }


            vm.newJobOrder =  function(data){

                // console.log(data);
                JobOrdersSrvcs.save(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);
                        // vm.routeTo('asset/list-equipments');
                        $state.go('asset-more-details', { assetTag:$stateParams.assetTag});
                    }
                    else {
                        alert(response.data.message);
                        // vm.routeTo('asset/create');
                        console.log(response.data);
                    }
                    // console.log(response.data);
                }, function (){ console.log(response.data); alert('Bad Request!!!') });
            }

            // EmployeesSrvcs.employees({jobType:''}).then (function (response) {
            //     if(response.data.status == 200)
            //     {
            //         vm.employees = response.data.data;
            //         console.log(vm.employees)
            //     }
            // }, function (){ alert('Bad Request!!!') })

            // var today = new Date();
            // vm.AvailableDate = new Date();
            // vm.ExpireDate = new Date();
            // vm.dateFormat = 'yyyy-MM-dd';
            // vm.availableDateOptions = {
            //     formatYear: 'yy',
            //     startingDay: 1,
            //     minDate: today,
            //     maxDate: new Date(2030, 5, 22)
            // };
            // vm.expireDateOptions = {
            //     formatYear: 'yy',
            //     startingDay: 1,
            //     minDate: today,
            //     maxDate: new Date(2030, 5, 22)
            // };
            // vm.availableDatePopup = {
            //     opened: false
            // };
            // vm.expireDatePopup = {
            //     opened: false
            // };
            // vm.ChangeExpiryMinDate = function(availableDate) {
            //     if (availableDate != null) {
            //         var expiryMinDate = new Date(availableDate);
            //         vm.expireDateOptions.minDate = expiryMinDate;
            //         vm.ExpireDate = expiryMinDate;
            //     }
            // };
            // vm.ChangeExpiryMinDate();
            // vm.OpenAvailableDate = function() {
            //     vm.availableDatePopup.opened = !vm.availableDatePopup.opened;
            // };
            // vm.OpenExpireDate = function() {
            //     vm.expireDatePopup.opened = !vm.expireDatePopup.opened;
            // };

            vm.routeTo = function(route){
                $window.location.href = route;
            };
        }


        JobOrderModalInstanceCtrl.$inject = ['$stateParams', '$state', '$uibModalInstance', '$window', 'formData', 'JobOrdersSrvcs', 'EmployeesSrvcs'];
        function JobOrderModalInstanceCtrl ($stateParams, $state, $uibModalInstance, $window, formData, JobOrdersSrvcs, EmployeesSrvcs) {

            var vm = this;
            vm.formData = formData;

            alert($stateParams.joCode)

            vm.ok = function() {
                $uibModalInstance.close();
            };
            
            vm.close = function() {
                $uibModalInstance.close();
            };

            vm.updateJobOrder =  function(data){
                // console.log(data);
                JobOrdersSrvcs.update(vm.formData.jobOrder).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);
                        // vm.routeTo('job-order/list');
                        $state.go('list-jo2');
                        vm.ok();
                    }
                    console.log(response.data);
                }, function (){ alert('Bad Request!!!') });
            }

            EmployeesSrvcs.employees({jobType:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.employees = response.data.data;
                    console.log(vm.employees)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.routeTo = function(route){
                $window.location.href = route;
            };

            vm.printJobOrderDetails = function(tag){
                vm.url = 'job-order/report/'+tag;
            }
        }
})();