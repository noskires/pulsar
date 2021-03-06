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
            vm.loader_status = true;
            JobOrdersSrvcs.jobOrders({joCode:'', joStatus:1, date_started:'', assetCode:'', assetCategory:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.jobOrders = response.data.data;
                    console.log(vm.jobOrders)
                    vm.loader_status = false; 
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
                        
                        JobOrdersSrvcs.jobOrders({joCode:'', joStatus:1, date_started:'', assetCode:'', assetCategory:''}).then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.jobOrders = response.data.data;
                                console.log(vm.jobOrders)
                                $state.reload();
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

            vm.filterJo = function(data){
                console.table(data) 

                JobOrdersSrvcs.jobOrders({joCode:'', joStatus:data.job_order_status, date_started:data.date_started, assetCode:'', assetCategory:data.asset_category}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.jobOrders = response.data.data;
                        console.log(vm.jobOrders)
                    }
                }, function (){ alert('Bad Request!!!') })
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
                JobOrdersSrvcs.jobOrders({joCode:$stateParams.joCode, joStatus:'', date_started:'', assetCode:'', assetCategory:''}).then (function (response) {

                    if(response.data.status == 200)
                    {
                        vm.jobOrder = response.data.data[0];
                        console.log(vm.jobOrder)

                        var modalInstance = $uibModal.open({
                            controller:'JobOrderModalInstanceCtrl',
                            templateUrl:'jobOrderInfo.modal',
                            controllerAs: 'vm',
                            backdrop: 'static',
                            keyboard: false,
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
                JobOrdersSrvcs.jobOrders({joCode:$stateParams.joCode2, joStatus:'', date_started:'', assetCode:'', assetCategory:''}).then (function (response) {

                    if(response.data.status == 200)
                    {
                        vm.jobOrder = response.data.data[0];
                        console.log(vm.jobOrder)

                        var modalInstance = $uibModal.open({
                            controller:'JobOrderModalInstanceCtrl',
                            templateUrl:'jobOrderInfo2.modal',
                            controllerAs: 'vm',
                            backdrop: 'static',
                            keyboard: false,
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


            vm.routeTo = function(route){
                $window.location.href = route;
            };
        }


        JobOrderModalInstanceCtrl.$inject = ['$stateParams', '$state', '$uibModalInstance', '$window', 'formData', 'JobOrdersSrvcs', 'EmployeesSrvcs'];
        function JobOrderModalInstanceCtrl ($stateParams, $state, $uibModalInstance, $window, formData, JobOrdersSrvcs, EmployeesSrvcs) {

            var vm = this;
            vm.formData = formData;

            // alert($stateParams.joCode)

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