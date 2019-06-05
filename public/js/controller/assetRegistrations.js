(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .controller('AssetRegistrationCtrl', AssetRegistrationCtrl)
        .controller('AssetRegistrationModalInstanceCtrl', AssetRegistrationModalInstanceCtrl)

        AssetRegistrationCtrl.$inject = [
            'AssetsSrvcs', 'AssetRegistrationsSrvcs', 'AssetCategoriesSrvcs', 'MaintenanceSrvcs', 'WarrantiesSrvcs', 'JobOrdersSrvcs', 'InsuranceSrvcs', 'AssetPhotosSrvcs',
            '$state', '$stateParams', '$window', '$uibModal'
        ];
        function AssetRegistrationCtrl(
            AssetsSrvcs, AssetRegistrationsSrvcs, AssetCategoriesSrvcs, MaintenanceSrvcs, WarrantiesSrvcs, JobOrdersSrvcs, InsuranceSrvcs, AssetPhotosSrvcs,
            $state, $stateParams, $window, $uibModal){

            var vm = this;
            var data = {};

            vm.attribute_tabs = [
                {'name': "Maintenance History", 'status': ""},
                {'name': "Events", 'status': ""},
                {'name': "Registration Details", 'status': "active"},
                {'name': "Insurance", 'status': ""},
                {'name': "Documents", 'status': ""}
            ]
            console.log(vm.attribute_tabs)
  
            if ($stateParams.assetCode) {

                vm.assetsDetails = {
                    assetCode: $stateParams.assetCode,
                    name: '',
                    category: '',
                    areCode: '',
                    status: '',
                    isAll: 1,
                    withActiveAre: 2
                }
    
                AssetsSrvcs.assets(vm.assetsDetails).then(function (response) {
                    if (response.data.status == 200) {
                        vm.asset = response.data.data[0];
                        console.log(vm.asset)
                    }
                }, function () { alert('Bad Request!!!') })

                AssetsSrvcs.assetEvents({ assetCode: $stateParams.assetCode, name: '', category: '', areCode: '', isAll: 1, assetEventCode: '' }).then(function (response) {
                    if (response.data.status == 200) {
                        vm.assetEvents = response.data.data;
                        console.log(vm.assetEvents)
                    }
                }, function () { alert('Bad Request!!!') })

                MaintenanceSrvcs.assetsMonitoring({ assetCode: $stateParams.assetCode }).then(function (response) {
                    if (response.data.status == 200) {
                        vm.assetsMonitoring = response.data.data[0];
                        console.log(vm.assetsMonitoring)
                    }
                }, function () { alert('Bad Request!!!') })
 
                WarrantiesSrvcs.warranties({ assetCode: $stateParams.assetCode }).then(function (response) {
                    if (response.data.status == 200) {
                        vm.warranties = response.data.data;
                        console.log(vm.warranties)
                    }
                }, function () { alert('Bad Request!!!') })

                AssetRegistrationsSrvcs.list({ assetRegistrationCode: '', assetCode: $stateParams.asset_code }).then(function (response) {
                    if (response.data.status == 200) {
                        vm.assetRegistrations = response.data.data;
                        console.log(vm.assetRegistrations)
                    }
                }, function () { alert('Bad Request!!!') })

                JobOrdersSrvcs.jobOrders({ joCode: '', joStatus: '', assetCode: $stateParams.assetCode }).then(function (response) {
                    if (response.data.status == 200) {
                        vm.jobOrders = response.data.data;
                        console.log(vm.jobOrders)
                    }
                }, function () { alert('Bad Request!!!') })
        
                InsuranceSrvcs.insuranceItems({ insuranceCode: '', insuranceItemCode: '', assetCode: $stateParams.assetCode, insuranceItemStatus: 1 }).then(function (response) {
                    if (response.data.status == 200) {
                        vm.insurance = response.data.data;
                        console.log(vm.insurance)
                    }
                }, function () { alert('Bad Request!!!') })
        
                AssetPhotosSrvcs.assetPhotos({ assetCode: $stateParams.assetCode, name: '', status: '' }).then(function (response) {
                    if (response.data.status == 200) {
                        vm.assetPhotos = response.data.data;
                        console.log(vm.assetPhotos)
                    }
                }, function () { alert('Bad Request!!!') })
        
                AssetPhotosSrvcs.assetPhotos({ assetCode: $stateParams.assetCode, name: '', status: 1 }).then(function (response) {
                    if (response.data.status == 200) {
                        vm.assetPhoto = response.data.data;
                        console.log(vm.assetPhoto)
                    }
                }, function () { alert('Bad Request!!!') })
            }

            if ($stateParams.assetRegistrationCode) {
                
                AssetRegistrationsSrvcs.list({ assetRegistrationCode: $stateParams.assetRegistrationCode, assetCode: $stateParams.asset_code}).then(function (response) {
                    if (response.data.status == 200) {

                        console.log(vm.assetRegistrations)

                        var modalInstance = $uibModal.open({
                            controller:'AssetRegistrationModalInstanceCtrl',
                            templateUrl:'asset.registration.modal.edit',
                            controllerAs: 'amdc',
                            resolve :{
                                datum: function () {
                                    return {
                                        title:'Asset Registration Controller',
                                        message:response.data.message,
                                        list: response.data.data[0]
                                    };
                                }
                            }
                        });
                    }
                }, function () { alert('Bad Request!!!') })
            }
        }

        AssetRegistrationModalInstanceCtrl.$inject = ['datum','AssetRegistrationsSrvcs', 'AssetCategoriesSrvcs', '$stateParams', '$uibModalInstance', '$state'];
        function AssetRegistrationModalInstanceCtrl (datum, AssetRegistrationsSrvcs, AssetCategoriesSrvcs, $stateParams, $uibModalInstance, $state) {

            var vm = this;
            vm.datum = datum.list;
            console.log(vm.datum)

            vm.updateAssetRegistrationBtn =  function(data){
                console.log(data)
                AssetRegistrationsSrvcs.update(data).then(function (response) {
                    if (response.data.status == 200) {
                        alert(response.data.message);
                        $state.go('asset-more-details', {assetCode: vm.datum.asset_code})
                        vm.ok();
                    }
                }, function () { alert('Bad Request!!!') })
            }

            vm.ok = function() {
                $uibModalInstance.close();
            };
            
            vm.routeTo = function(route){
                $window.location.href = route;
            };

            vm.printSupplyDetails = function(tag){
                vm.url = 'supply/report/'+tag;
            }
        }
})();