(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .controller('AssetsCtrl', AssetsCtrl) 
        .controller('AssetsAddCtrl', AssetsAddCtrl) 
        .controller('AssetMoreDetailsCtrl', AssetMoreDetailsCtrl) 
        .controller('AssetsModalInstanceCtrl', AssetsModalInstanceCtrl)
        .controller('AssetsWarrantyModalInstanceCtrl', AssetsWarrantyModalInstanceCtrl)
 		
 		AssetsCtrl.$inject = ['$stateParams', 'AssetsSrvcs', 'EmployeesSrvcs', 'OrganizationsSrvcs', 'AddressesSrvcs', 'ProjectsSrvcs', '$window', '$uibModal'];
        function AssetsCtrl($stateParams, AssetsSrvcs, EmployeesSrvcs, OrganizationsSrvcs, AddressesSrvcs, ProjectsSrvcs, $window, $uibModal){
            var vm = this;
            var data = {};

           // alert($stateParams.assetTag);

           if($stateParams.assetTag)
            {
                var tag = $stateParams.assetTag;
                AssetsSrvcs.assets({tag:tag, name:'', category:''}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.asset = response.data.data[0];
                        console.log(vm.asset)
                        var modalInstance = $uibModal.open({
                            controller:'AssetsModalInstanceCtrl',
                            templateUrl:'assetInfo.modal',
                            controllerAs: 'vm',
                            resolve :{
                              formData: function () {
                                return {
                                    title:'Assets Controller',
                                    message:response.data.message,
                                    asset: response.data.data[0]
                                };
                              }
                            }
                        });
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            AssetsSrvcs.assets({tag:'', name:'', category:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.assets = response.data.data;
                    console.log(vm.assets)
                }
            }, function (){ alert('Bad Request!!!') })

            //check this line

            // vm.assetTag = function(data){
            //     // console.log(asset);
            //     // vm.tag = '';
            //     // vm.d = new Date(asset.dateAcquired);

            //     AssetsSrvcs.asset_tag(data).then (function (response) {
            //         if(response.data.status == 200)
            //         {
            //             vm.asset_tag = response.data.data;
            //             console.log(response.data)
            //         }
            //     }, function (){ alert('Bad Request!!!') })
            // }

            // vm.assetInfo = function(tag){
            //     AssetsSrvcs.assets({tag:tag}).then (function (response) {
            //         if(response.data.status == 200)
            //         {
            //             vm.asset = response.data.data[0];
            //             console.log(vm.asset)

            //             // var modalInstance = $uibModal.open({
            //             //     controller:'ModalInstanceCtrl',
            //             //     templateUrl:'assetInfo.modal',
            //             //     controllerAs: 'vm',
            //             //     resolve :{
            //             //       formData: function () {
            //             //         return {
            //             //             title:'Assets Controller',
            //             //             message:response.data.message,
            //             //             asset: response.data.data[0]
            //             //         };
            //             //       }
            //             //     }
            //             // });
            //         }
            //     }, function (){ alert('Bad Request!!!') })
            // }

        }

        AssetsAddCtrl.$inject = ['$stateParams', 'AssetsSrvcs', 'EmployeesSrvcs', 'OrganizationsSrvcs', 'AddressesSrvcs', 'ProjectsSrvcs', '$window', '$uibModal'];
        function AssetsAddCtrl($stateParams, AssetsSrvcs, EmployeesSrvcs, OrganizationsSrvcs, AddressesSrvcs, ProjectsSrvcs, $window, $uibModal){
            var vm = this;
            var data = {};

            //employee services
            EmployeesSrvcs.employees({jobType:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.employees = response.data.data;
                    console.log(vm.employees)
                }
            }, function (){ alert('Bad Request!!!') })

            //organizations services
            OrganizationsSrvcs.organizations().then (function (response) {
                if(response.data.status == 200)
                {
                    vm.organizations = response.data.data;
                    console.log(vm.organizations)
                }
            }, function (){ alert('Bad Request!!!') })

            AssetsSrvcs.asset_categories().then (function (response) {
                if(response.data.status == 200)
                {
                    vm.asset_categories = response.data.data;
                    console.log(vm.asset_categories)
                }
            }, function (){ alert('Bad Request!!!') })

            AssetsSrvcs.asset_methods().then (function (response) {
                if(response.data.status == 200)
                {
                    vm.methods = response.data.data;
                    console.log(vm.methods)
                }
            }, function (){ alert('Bad Request!!!') })

            ProjectsSrvcs.projects().then (function (response) {
                if(response.data.status == 200)
                {
                    vm.projects = response.data.data;
                    console.log(vm.projects)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.submit = function(data){
                AssetsSrvcs.save(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);
                        vm.routeTo('asset/new');
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

        AssetsModalInstanceCtrl.$inject = ['$uibModalInstance', 'formData'];
        function AssetsModalInstanceCtrl ($uibModalInstance, formData) {

            var vm = this;
            vm.formData = formData;
            // console.log(vm.formData);
            vm.ok = function() {
                $uibModalInstance.close();
            };
            
            vm.close = function() {
                $uibModalInstance.close();
            };

            vm.moreDetails = function(){
                alert('more details')
                // vm.routeTo('asset/new');
            }

            vm.routeTo = function(route){
                $window.location.href = route;
            };
        }

        AssetMoreDetailsCtrl.$inject = ['$stateParams', 'AssetsSrvcs', 'MaintenanceSrvcs', 'WarrantiesSrvcs', 'EmployeesSrvcs', 'OrganizationsSrvcs', 'AddressesSrvcs', 'ProjectsSrvcs', '$window', '$uibModal'];
        function AssetMoreDetailsCtrl($stateParams, AssetsSrvcs, MaintenanceSrvcs, WarrantiesSrvcs, EmployeesSrvcs, OrganizationsSrvcs, AddressesSrvcs, ProjectsSrvcs, $window, $uibModal){
            var vm = this;
            var data = {};

            if($stateParams.assetTag)
            {
                // alert($stateParams.assetTag)
                var tag = $stateParams.assetTag;
                AssetsSrvcs.assets({tag:tag, name:'', category:''}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.asset = response.data.data[0];
                        console.log(vm.asset)
                    }
                }, function (){ alert('Bad Request!!!') })


                MaintenanceSrvcs.assetsMonitoring({tag:tag}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.assetsMonitoring = response.data.data[0];
                        console.log(vm.assetsMonitoring)
                    }
                }, function (){ alert('Bad Request!!!') })

                WarrantiesSrvcs.warranties({tag:tag}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.warranties = response.data.data;
                        console.log(vm.warranties)
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            vm.addNewWarranty = function(){ 
                var modalInstance = $uibModal.open({
                    controller:'AssetsWarrantyModalInstanceCtrl',
                    templateUrl:'assetAddWarranty.modal',
                    controllerAs: 'vm',
                    resolve :{
                      formData: function () {
                        return {
                            title:'Assets Add Warranty Controller'
                        };
                      }
                    }
                });
            }
        }

        AssetsWarrantyModalInstanceCtrl.$inject = ['$stateParams', '$uibModalInstance', 'WarrantiesSrvcs', 'formData', '$window'];
        function AssetsWarrantyModalInstanceCtrl ($stateParams, $uibModalInstance, WarrantiesSrvcs, formData, $window) {

            var vm = this;
            vm.ok = function() {
                $uibModalInstance.close();
            };
            
            vm.close = function() {
                $uibModalInstance.close();
            };

            vm.submitWarranty = function(data){

                data['asset_tag'] = $stateParams.assetTag;
                WarrantiesSrvcs.save(data).then (function (response) {
                    if(response.data.status == 200)
                    {
                        alert(response.data.message);
                        vm.routeTo('asset/more-details/'+$stateParams.assetTag);
                    }
                    else {
                        alert(response.data.message);
                    }

                    console.log(response.data);
                }, function (){ alert('Bad Request!!!') })
            }

            vm.routeTo = function(route){
                $window.location.href = route;
            };
        }
})();