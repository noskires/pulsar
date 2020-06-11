(function () {
    'use strict';
    angular
        .module('pulsarApp')
        .controller('AssetsCtrl', AssetsCtrl)
        .controller('AssetsAddCtrl', AssetsAddCtrl)
        .controller('AssetMoreDetailsCtrl', AssetMoreDetailsCtrl)
        .controller('AssetsModalInstanceCtrl', AssetsModalInstanceCtrl)
        .controller('AssetsWarrantyModalInstanceCtrl', AssetsWarrantyModalInstanceCtrl)
        .controller('AssetsEditModalInstanceCtrl', AssetsEditModalInstanceCtrl)
        .controller('AssetRegistrationAddModalInstanceCtrl', AssetRegistrationAddModalInstanceCtrl)

    AssetsCtrl.$inject = ['$stateParams', 'AssetsSrvcs', 'EmployeesSrvcs', 'OrganizationsSrvcs', 'AddressesSrvcs', 'ProjectsSrvcs', 'AssetRegistrationsSrvcs', 'AssetCategoriesSrvcs', '$window', '$uibModal'];
    function AssetsCtrl($stateParams, AssetsSrvcs, EmployeesSrvcs, OrganizationsSrvcs, AddressesSrvcs, ProjectsSrvcs, AssetRegistrationsSrvcs, AssetCategoriesSrvcs, $window, $uibModal) {
        var vm = this;
        var data = {};

        // alert($stateParams.assetCode);

        vm.assetCode = $stateParams.assetCode;

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
                    var modalInstance = $uibModal.open({
                        controller: 'AssetsModalInstanceCtrl',
                        templateUrl: 'assetInfo.modal',
                        controllerAs: 'vm',
                        backdrop: 'static',
                        keyboard: false,
                        resolve: {
                            formData: function () {
                                return {
                                    title: 'Assets Controller',
                                    message: response.data.message,
                                    asset: vm.asset
                                };
                            }
                        },
                        // size: 'lg'
                    });


                }
            }, function () { alert('Bad Request!!!') })
        }

        vm.assetsDetails = {
            assetCode: '',
            name: '',
            category: '',
            areCode: '',
            status: '',
            isAll: 0,
            withActiveAre: 2 // 2 means shall all records 
        }

        vm.loader_status = true;

        AssetsSrvcs.assets(vm.assetsDetails).then(function (response) {
            if (response.data.status == 200) {
                vm.assets = response.data.data;
                console.log(vm.assets)
                console.log(response.data)
                vm.loader_status = false;
            }
        }, function () { alert('Bad Request!!!') })

        AssetCategoriesSrvcs.AssetCategories({ assetCategoryCode: '' }).then(function (response) {
            if (response.data.status == 200) {
                vm.asset_categories = response.data.data;
                console.log(vm.asset_categories)
            }
        }, function () { alert('Bad Request!!!') })

        vm.submit = function (data) {
            AssetsSrvcs.save(data).then(function (response) {
                if (response.data.status == 200) {
                    alert(response.data.message);
                    // $state.go('asset-list-equipments');
                    vm.routeTo('asset/list-equipments')
                }
                else {
                    alert(response.data.message);
                }
                console.log(response.data);
            });
        };

        vm.exportAssets = function () {
            AssetsSrvcs.exportAssets().then(function (response) {
                // vm.routeTo('api/v1/export-assets')
            }, function () { alert('Bad Request!!!') })
        }

        vm.routeTo = function (route) {
            $window.location.href = route;
        };

    }

    AssetsAddCtrl.$inject = ['$state', '$stateParams', 'AssetsSrvcs', 'AssetCategoriesSrvcs', 'EmployeesSrvcs', 'OrganizationsSrvcs', 'AddressesSrvcs', 'ProjectsSrvcs', '$window', '$uibModal'];
    function AssetsAddCtrl($state, $stateParams, AssetsSrvcs, AssetCategoriesSrvcs, EmployeesSrvcs, OrganizationsSrvcs, AddressesSrvcs, ProjectsSrvcs, $window, $uibModal) {
        var vm = this;
        var data = {};

        //employee services
        EmployeesSrvcs.employees({ jobType: '' }).then(function (response) {
            if (response.data.status == 200) {
                vm.employees = response.data.data;
                console.log(vm.employees)
            }
        }, function () { alert('Bad Request!!!') })

        //organizations services
        OrganizationsSrvcs.organizations({ orgCode: '', nextOrgCode: '', orgType: '', startDate: '', endDate: '' }).then(function (response) {
            if (response.data.status == 200) {
                vm.organizations = response.data.data;
                console.log(vm.organizations)
            }
        }, function () { alert('Bad Request!!!') })

        AssetCategoriesSrvcs.AssetCategories({ assetCategoryCode: '' }).then(function (response) {
            if (response.data.status == 200) {
                vm.asset_categories = response.data.data;
                console.log(vm.asset_categories)
            }
        }, function () { alert('Bad Request!!!') })

        AssetsSrvcs.asset_methods().then(function (response) {
            if (response.data.status == 200) {
                vm.methods = response.data.data;
                console.log(vm.methods)
            }
        }, function () { alert('Bad Request!!!') })

        ProjectsSrvcs.projects({ projectCode: '' }).then(function (response) {
            if (response.data.status == 200) {
                vm.projects = response.data.data;
                console.log(vm.projects)
            }
        }, function () { alert('Bad Request!!!') })

        vm.submit = function (data) {
            AssetsSrvcs.save(data).then(function (response) {
                if (response.data.status == 200) {
                    alert(response.data.message);
                    $state.go('asset-list-equipments');
                }
                else {
                    alert(response.data.message);
                }
                console.log(response.data);
            });
        };

        vm.routeTo = function (route) {
            $window.location.href = route;
        };

    }

    AssetsModalInstanceCtrl.$inject = ['$state', '$stateParams', '$uibModalInstance', 'formData', 'AssetPhotosSrvcs', '$window'];
    function AssetsModalInstanceCtrl($state, $stateParams, $uibModalInstance, formData, AssetPhotosSrvcs, $window) {

        var vm = this;
        vm.formData = formData;

        vm.assetCode = $stateParams.assetCode;

        AssetPhotosSrvcs.assetPhotos({ assetCode: $stateParams.assetCode, name: '', status: 1 }).then(function (response) {
            if (response.data.status == 200) {
                vm.assetPhoto = response.data.data;
                console.log(vm.assetPhoto)
            }
        }, function () { alert('Bad Request!!!') })

        vm.printAssetDetails = function (assetCode) {
            vm.url = 'export/' + assetCode;
        }

        // AssetPhotosSrvcs.assetPhotos({tag:$stateParams.assetCode, name:'',status:1}).then (function (response) {
        //     if(response.data.status == 200)
        //     {
        //         vm.assetPhoto = response.data.data;
        //         console.log(vm.assetPhoto)
        //     }
        // }, function (){ alert('Bad Request!!!') })

        // vm.printAssetDetails = function(tag){
        //     vm.url = 'export/'+tag;
        // }

        // console.log(vm.formData);
        vm.ok = function () {
            $uibModalInstance.close();
            $state.go('asset-list-equipments');
        };

        vm.close = function () {
            $uibModalInstance.close();
        };

        vm.moreDetails = function () {
            alert('more details')
            // vm.routeTo('asset/new');
        }

        vm.routeTo = function (route) {
            $window.location.href = route;
        };
    }

    AssetMoreDetailsCtrl.$inject = ['$state', '$stateParams', 'AssetsSrvcs', 'AssetPhotosSrvcs', 'MaintenanceSrvcs', 'WarrantiesSrvcs', 'EmployeesSrvcs', 'OrganizationsSrvcs', 'AddressesSrvcs', 'ProjectsSrvcs', 'InsuranceSrvcs', 'JobOrdersSrvcs', 'AssetRegistrationsSrvcs', '$window', '$uibModal', '$timeout'];
    function AssetMoreDetailsCtrl($state, $stateParams, AssetsSrvcs, AssetPhotosSrvcs, MaintenanceSrvcs, WarrantiesSrvcs, EmployeesSrvcs, OrganizationsSrvcs, AddressesSrvcs, ProjectsSrvcs, InsuranceSrvcs, JobOrdersSrvcs, AssetRegistrationsSrvcs, $window, $uibModal, $timeout) {
        var vm = this;
        var data = {};

        vm.attribute_tabs = [
            {name: "Maintenance History", status: ""},
            {name: "Events", status: ""},
            {name: "Registration Details", status: "active"},
            {name: "Insurance", status: ""},
            {name: "Documents", status: ""}
        ]

        vm.loader_status = true;

            $timeout(
                function(){ vm.loader_status =false; }
            , 2500);
        
        console.log(vm.attribute_tabs)

        vm.messageAlert = function (message) {
            alert(message);
        }

        vm.assetCode = $stateParams.assetCode;
        vm.editAsset = function (argument) {

            vm.assetsDetails = {
                assetCode: $stateParams.assetCode,
                name: '',
                category: '',
                areCode: '',
                status: '',
                isAll: 1
            }

            AssetsSrvcs.assets(vm.assetsDetails).then(function (response) {
                if (response.data.status == 200) {
                    vm.asset = response.data.data[0];
                    console.log(vm.asset)
                    var modalInstance = $uibModal.open({
                        controller: 'AssetsEditModalInstanceCtrl',
                        templateUrl: 'assetEditTpl.modal',
                        controllerAs: 'vm',
                        backdrop: 'static',
                        keyboard: false,
                        resolve: {
                            formData: function () {
                                return {
                                    title: 'Assets Edit Controller',
                                    message: response.data.message,
                                    asset: response.data.data[0]
                                };
                            }
                        }
                    });
                }
            }, function () { alert('Bad Request!!!') })
        }

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

            //changed
            AssetsSrvcs.assetEvents({ assetCode: $stateParams.assetCode, name: '', category: '', areCode: '', isAll: 1, assetEventCode: '' }).then(function (response) {
                if (response.data.status == 200) {
                    vm.assetEvents = response.data.data;
                    console.log(vm.assetEvents)
                }
            }, function () { alert('Bad Request!!!') })

            //changed
            MaintenanceSrvcs.assetsMonitoring({ assetCode: $stateParams.assetCode }).then(function (response) {
                if (response.data.status == 200) {
                    vm.assetsMonitoring = response.data.data[0];
                    console.log(vm.assetsMonitoring)
                }
            }, function () { alert('Bad Request!!!') })

            //changed
            WarrantiesSrvcs.warranties({ assetCode: $stateParams.assetCode }).then(function (response) {
                if (response.data.status == 200) {
                    vm.warranties = response.data.data;
                    console.log(vm.warranties)
                }
            }, function () { alert('Bad Request!!!') })
        }

        AssetRegistrationsSrvcs.list({ assetRegistrationCode: '', assetCode: $stateParams.asset_code }).then(function (response) {
            if (response.data.status == 200) {
                vm.assetRegistrations = response.data.data;
                console.log(vm.assetRegistrations)
            }
        }, function () { alert('Bad Request!!!') })

        JobOrdersSrvcs.jobOrders({ joCode: '', joStatus: '', assetCode: $stateParams.asset_code }).then(function (response) {
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


        vm.printAssetDetails = function (assetCode) {
            vm.url = 'export/' + $stateParams.assetCode
        }

        vm.addNewWarranty = function () {
            var modalInstance = $uibModal.open({
                controller: 'AssetsWarrantyModalInstanceCtrl',
                templateUrl: 'assetAddWarranty.modal',
                controllerAs: 'vm',
                backdrop: 'static',
                keyboard: false,
                resolve: {
                    formData: function () {
                        return {
                            title: 'Assets Add Warranty Controller'
                        };
                    }
                }
            });
        }

        vm.addAssetEventBtn = function (data) {
            data['asset_code'] = $stateParams.assetCode;
            console.log(data)
            AssetsSrvcs.saveAssetEvent(data).then(function (response) {
                if (response.data.status == 200) {
                    alert(response.data.message);
                    vm.ok()
                    // $state.go('asset-list-equipments');
                }
                else {
                    alert(response.data.message);
                }
                console.log(response.data);
            });
        }

        vm.addAssetRegistrationBtn = function (data) {

            data['asset_code'] = $stateParams.assetCode;
            console.log(data)
            AssetRegistrationsSrvcs.save(data).then(function (response) {
                if (response.data.status == 200) {
                    alert(response.data.message);
                    $state.go('asset-more-details', { assetCode:$stateParams.assetCode});

                    vm.registrationDetails = { 
                        assetRegistrationCode: '',
                        assetCode: $stateParams.asset_code
                    }

                    AssetRegistrationsSrvcs.list(vm.registrationDetails).then(function (response) {
                        if (response.data.status == 200) {
                            vm.assetRegistrations = response.data.data;
                            console.log(vm.assetRegistrations)
                        }
                    }, function () { alert('Bad Request!!!') })

                    vm.ok()
                }
                else {
                    alert(response.data.message);
                }
                console.log(response.data);
            });
        }

        vm.routeTo = function (route) {
            $window.location.href = route;
        };

        vm.routeToOpen = function (route) {
            $window.open = route;
        };

        vm.ok = function () {
            $uibModalInstance.close();
        };
    }

    AssetsEditModalInstanceCtrl.$inject = ['$stateParams', '$uibModalInstance', 'AssetsSrvcs', 'WarrantiesSrvcs', 'formData', '$window'];
    function AssetsEditModalInstanceCtrl($stateParams, $uibModalInstance, AssetsSrvcs, WarrantiesSrvcs, formData, $window) {
        var vm = this;
        console.log(vm.formData = formData.asset)
        vm.updateAsset = function (data) {
            console.log(data)

            AssetsSrvcs.updateAsset(data).then(function (response) {
                if (response.data.status == 200) {
                    alert(response.data.message);
                }
                else {
                    alert(response.data.message);
                }
                console.log(response.data);
            });

            vm.ok();
        }

        vm.ok = function () {
            $uibModalInstance.close();
        };
    }

    AssetRegistrationAddModalInstanceCtrl.$inject = ['$stateParams', '$uibModalInstance', 'AssetsSrvcs', 'WarrantiesSrvcs', 'formData', '$window'];
    function AssetRegistrationAddModalInstanceCtrl($stateParams, $uibModalInstance, AssetsSrvcs, WarrantiesSrvcs, formData, $window) {
        var vm = this;

        alert($stateParams.assetCode)
        console.log(vm.formData = formData.asset)
        vm.updateAsset = function (data) {
            console.log(data)

            AssetsSrvcs.updateAsset(data).then(function (response) {
                if (response.data.status == 200) {
                    alert(response.data.message);
                }
                else {
                    alert(response.data.message);
                }
                console.log(response.data);
            });

            vm.ok();
        }

        vm.ok = function () {
            $uibModalInstance.close();
        };
    }

    AssetsWarrantyModalInstanceCtrl.$inject = ['$stateParams', '$uibModalInstance', 'WarrantiesSrvcs', 'formData', '$window'];
    function AssetsWarrantyModalInstanceCtrl($stateParams, $uibModalInstance, WarrantiesSrvcs, formData, $window) {

        var vm = this;
        vm.ok = function () {
            $uibModalInstance.close();
        };

        vm.close = function () {
            $uibModalInstance.close();
        };

        vm.submitWarranty = function (data) {

            data['asset_tag'] = $stateParams.assetCode;
            WarrantiesSrvcs.save(data).then(function (response) {
                if (response.data.status == 200) {
                    alert(response.data.message);
                    vm.routeTo('asset/more-details/' + $stateParams.assetCode);
                    // WarrantiesSrvcs.warranties({tag:vm.tag}).then (function (response) {
                    //     if(response.data.status == 200)
                    //     {
                    //         vm.warranties = response.data.data;
                    //         console.log(vm.warranties)
                    //     }
                    // }, function (){ alert('Bad Request!!!') })
                }
                else {
                    alert(response.data.message);
                }

                console.log(response.data);
            }, function () { alert('Bad Request!!!') })
        }

        vm.routeTo = function (route) {
            $window.location.href = route;
        };
    }
})();