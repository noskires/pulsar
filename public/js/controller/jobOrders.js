(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .controller('JobOrdersCtrl', JobOrdersCtrl) 
        .controller('JobOrderModalInstanceCtrl',JobOrderModalInstanceCtrl)

        JobOrdersCtrl.$inject = ['JobOrdersSrvcs', 'AssetsSrvcs', 'EmployeesSrvcs', '$window', '$stateParams', '$uibModal'];
        function JobOrdersCtrl(JobOrdersSrvcs, AssetsSrvcs, EmployeesSrvcs, $window, $stateParams, $uibModal){
            var vm = this;
            var data = {}; 
            var tag = "";

            // alert($stateParams.assetTag);
            // alert($stateParams.joCode)
            
            JobOrdersSrvcs.jobOrders({joCode:'', joStatus:1, assetTag:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.jobOrders = response.data.data;
                    console.log(vm.jobOrders)
                }
            }, function (){ alert('Bad Request!!!') })

            if($stateParams.assetTag!=null)
            {
                AssetsSrvcs.assets({tag:$stateParams.assetTag, name:'', category:'', areCode:'', isAll:1}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.asset = response.data.data[0];
                        console.log(vm.asset)

                        vm.joDetails = {
                            tag: vm.asset.tag,
                            name: vm.asset.name,
                            location: vm.asset.municipality_text,
                            requestingEmployee: vm.asset.employee_name,
                        };

                        console.log(vm.joDetails);
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            if($stateParams.joCode){
                JobOrdersSrvcs.jobOrders({joCode:$stateParams.joCode,joStatus:'', assetTag:''}).then (function (response) {

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
                            size: 'lg'
                        });
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            vm.newJobOrder =  function(data){

                // console.log(data);
                JobOrdersSrvcs.save(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);
                        vm.routeTo('asset/list-equipments');
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


        JobOrderModalInstanceCtrl.$inject = ['$uibModalInstance', '$window', 'formData', 'JobOrdersSrvcs', 'EmployeesSrvcs'];
        function JobOrderModalInstanceCtrl ($uibModalInstance, $window, formData, JobOrdersSrvcs, EmployeesSrvcs) {

            var vm = this;
            vm.formData = formData;
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
                        vm.routeTo('job-order/list');
                    }
                    console.log(response.data);
                }, function (){ alert('Bad Request!!!') });
            }

            // EmployeesSrvcs.employees({jobType:''}).then (function (response) {
            //     if(response.data.status == 200)
            //     {
            //         vm.employees = response.data.data;
            //         console.log(vm.employees)
            //     }
            // }, function (){ alert('Bad Request!!!') })

            vm.routeTo = function(route){
                $window.location.href = route;
            };
        }
})();