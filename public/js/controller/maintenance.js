(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .controller('OperationCtrl', OperationCtrl)
        .controller('ListOperatingCtrl', ListOperatingCtrl)
        .controller('ListMonitoringCtrl', ListMonitoringCtrl)
        .controller('OperationEditModalInstanceCtrl', OperationEditModalInstanceCtrl)
        
        OperationCtrl.$inject = ['$stateParams', '$state', 'MaintenanceSrvcs', 'AssetsSrvcs', 'ProjectsSrvcs', '$window'];
        function OperationCtrl($stateParams, $state, MaintenanceSrvcs, AssetsSrvcs, ProjectsSrvcs, $window){
 
            var vm = this;
            var data = {};

           
 
            vm.loader_status = true;
            // alert('this is main controller')
            
            vm.newOperation =  function(data){
                console.log(data);
                MaintenanceSrvcs.saveOperation(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);
                        // vm.routeTo('maintenance/new');
                        $state.go('list-operating');
                    }
                    else {
                        alert(response.data.message);
                        // vm.routeTo('asset/create');
                    }
                    console.log(response.data);
                });
            }

            vm.assetsDetails = {
                assetCode:'', 
                name:'', 
                category:'CONE', 
                areCode:'', 
                status: ['Active'],
                isAll:1
            }

            AssetsSrvcs.assets(vm.assetsDetails).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.assets = response.data.data;
                    console.log(vm.assets)
                }

                console.log(response.data)
            }, function (){ alert('Bad Request!!!') })

            ProjectsSrvcs.projects({projectCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.projects = response.data.data;
                    console.log(vm.projects)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.routeTo = function(route){
                $window.location.href = route;
            }; 

            
        }
        
        ListOperatingCtrl.$inject = ['$stateParams', '$state', 'MaintenanceSrvcs', 'AssetsSrvcs', 'ProjectsSrvcs', '$window', '$uibModal'];
        function ListOperatingCtrl($stateParams, $state, MaintenanceSrvcs, AssetsSrvcs, ProjectsSrvcs, $window, $uibModal){
            var vm = this;
            var data = {};
            
            
            vm.loader_status = true;
            MaintenanceSrvcs.operations({operationCode:''}).then (function (response) {
                if(response.data.status == 200)
                { 
                    vm.operations = response.data.data;
                    console.log(vm.operations)
                    vm.loader_status = false;
                }
            }, function (){ alert('Bad Request!!!') })

            vm.routeTo = function(route){
                $window.location.href = route;
            }; 

            vm.newOperation =  function(data){
                console.log(data);
                // alert(data.operatingTimeTo)
                MaintenanceSrvcs.saveOperation(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);
                        // vm.routeTo('maintenance/new');

                        vm.operationDetails = {
                            dieselConsumption:'',
                            distanceTravelledFrom:'',
                            distanceTravelledTo:'',
                            gasConsumption:'',
                            numberLoads:'',
                            oilConsumption:'',
                            operatingTimeFrom:'',
                            operatingTimeTo:'',
                            operationDate:'',
                            projectCode:'',
                            remarks:'',
                        };

                        vm.assetsDetails = {
                            assetCode:'', 
                            name:'', 
                            category:'CONE', 
                            areCode:'', 
                            status: ['Active'],
                            isAll:1
                        }
            
            
                        AssetsSrvcs.assets(vm.assetsDetails).then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.assets = response.data.data;
                                console.log(vm.assets)
                            }
            
                            console.log(response.data)
                        }, function (){ alert('Bad Request!!!') })
            
                        ProjectsSrvcs.projects({projectCode:''}).then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.projects = response.data.data;
                                console.log(vm.projects)
                            }
                        }, function (){ alert('Bad Request!!!') })

                        MaintenanceSrvcs.operations({operationCode:''}).then (function (response) {
                            if(response.data.status == 200)
                            { 
                                vm.operations = response.data.data;
                                console.log(vm.operations)
                            }
                        }, function (){ alert('Bad Request!!!') })

                        $state.go('list-operating');
                    }
                    else {
                        alert(response.data.message);
                        // vm.routeTo('asset/create');
                    }
                    console.log(response.data);
                });
            };

            if($stateParams.operationCodeEdit)
            {

                vm.operationCode = $stateParams.operationCodeEdit;

                // alert(vm.requisitionSlipCode);

                vm.opeartionDetails = {
                    operationCode:vm.operationCode
                }
                
                MaintenanceSrvcs.operations(vm.opeartionDetails).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.opeartion = response.data.data[0];
                        console.log(vm.opeartion)

                        var modalInstance = $uibModal.open({
                            controller:'OperationEditModalInstanceCtrl',
                            templateUrl:'operation-edit.modal',
                            controllerAs: 'vm',
                            backdrop: 'static',
                            keyboard: false,
                            resolve :{
                              formData: function () {
                                return {
                                    title:'Operation Controller',
                                    message:response.data.message,
                                    requisition: vm.opeartion
                                };
                              }
                            },
                            size: 'lg'
                        });
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            vm.assetsDetails = {
                assetCode:'', 
                name:'', 
                category:'CONE', 
                areCode:'', 
                status: ['Active'],
                isAll:1
            }


            AssetsSrvcs.assets(vm.assetsDetails).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.assets = response.data.data;
                    console.log(vm.assets)
                }

                console.log(response.data)
            }, function (){ alert('Bad Request!!!') })

            ProjectsSrvcs.projects({projectCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.projects = response.data.data;
                    console.log(vm.projects)
                }
            }, function (){ alert('Bad Request!!!') })

        }

        OperationEditModalInstanceCtrl.$inject = ['$state', '$stateParams', '$uibModalInstance', 'formData', 'MaintenanceSrvcs', 'AssetsSrvcs', 'ProjectsSrvcs', '$window'];
        function OperationEditModalInstanceCtrl ($state, $stateParams, $uibModalInstance, formData, MaintenanceSrvcs, AssetsSrvcs, ProjectsSrvcs, $window) {

            var vm = this;
            vm.formData = formData.requisition;
            console.log(vm.formData)
            // alert(vm.formData.asset_name)

            // OrganizationsSrvcs.organizations({orgCode:'', nextOrgCode:'', orgType:'', startDate:'', endDate:''}).then (function (response) {
            //     if(response.data.status == 200)
            //     {
            //         vm.organizations = response.data.data;
            //         console.log(vm.organizations)
            //     }
            // }, function (){ alert('Bad Request!!!') })

            ProjectsSrvcs.projects({projectCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.projects = response.data.data;
                    console.log(vm.projects)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.assetsDetails = {
                assetCode:'', 
                name:'', 
                category:'CONE', 
                areCode:'', 
                status: ['Active'],
                isAll:1
            }

            AssetsSrvcs.assets(vm.assetsDetails).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.assets = response.data.data;
                    console.log(vm.assets)
                }

                console.log(response.data)
            }, function (){ alert('Bad Request!!!') })

            vm.ok = function() {
                $uibModalInstance.close();
            };

            vm.updateOperation = function(data){
                console.log(data)

                MaintenanceSrvcs.update(data).then (function (response) {
                    console.log(response.data)
                    if(response.data.status == 200)
                    {
                        alert(response.data.message);
                        
                        vm.operationDetails = {
                            operationCode:''
                        }
                        MaintenanceSrvcs.operations(vm.operationDetails).then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.operations = response.data.data;
                                console.log(vm.operations)
                            }
                        }, function (){ alert('Bad Request!!!') })
                        
                        $state.go('list-operating');
                        vm.ok();
                    }
                }, function (){ alert('Bad Request!!!') })
            }
        }

        ListMonitoringCtrl.$inject = ['MaintenanceSrvcs', '$window'];
        function ListMonitoringCtrl(MaintenanceSrvcs, $window){
            var vm = this;
            var data = {};
            vm.loader_status = true;
            
            
            MaintenanceSrvcs.assetsMonitoring({assetCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.assetsMonitoring = response.data.data;
                    vm.loader_status = false;
                    console.log(vm.assetsMonitoring)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.routeTo = function(route){
                $window.location.href = route;
            }; 
        }

})();