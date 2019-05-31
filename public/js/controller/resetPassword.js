(function () {
    'use strict';
    angular
        .module('pulsarApp')
        .controller('ResetPasswordCtrl', ResetPasswordCtrl)
        .controller('AreModalInstanceCtrl', AreModalInstanceCtrl)

    ResetPasswordCtrl.$inject = ['$stateParams', '$window', '$uibModal', '$scope', 'UsersSrvcs'];

    function ResetPasswordCtrl($stateParams, $window, $uibModal, $scope, UsersSrvcs) {
        var vm = this;
        var data = {};
        vm.sample = 'works!';

        vm.getUser = function () {
            return new Promise(resolve => {
                UsersSrvcs.list({
                    isSelfOnly: true
                }).then(function (response) {
                    if (response.data.status == 200) {
                        resolve(response.data.data);
                    }
                }, function () {
                    alert('Bad Request!!!')
                })
            });
        };

        vm.resetPassword = function (data) {
            return new Promise(resolve => {
                UsersSrvcs.resetPassword(data).then(function (response) {
                    resolve(response.data);
                }, function () {
                    alert('Bad Request!!!')
                })
            });
        };

        vm.getUser().then(async () => {
            const data = await vm.getUser();
            $scope.$apply(() => vm.form = data[0]);
        });

        vm.submit = async function (data) {
            const response = await vm.resetPassword(data);
            vm.response = {
                ...response,
                hasError: (response.status) ? response.status != 200 : false
            };
            if (!vm.response.hasError) {
                alert(vm.response.message);
                $window.location.href = '/logout';
            }
        };
    }

    AreModalInstanceCtrl.$inject = ['$stateParams', '$uibModalInstance', 'AresSrvcs', 'AssetsSrvcs', 'InsuranceSrvcs', 'BanksSrvcs', 'formData', 'ReceiptSrvcs'];

    function AreModalInstanceCtrl($stateParams, $uibModalInstance, AresSrvcs, AssetsSrvcs, InsuranceSrvcs, BanksSrvcs, formData, ReceiptSrvcs) {
        // alert('insurance model')
        var vm = this;
        vm.formData = formData.are;
        console.log(vm.formData)

        vm.areCode = $stateParams.areCode;

        // alert(vm.areCode)
        vm.assetItemDetails = [{
            'are_code': vm.areCode,
            'asset_code': '',
            'started_at': ''
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
            areCode: vm.areCode,
            areItemCode: '',
            assetCode: '',
        }


        vm.assetsDetails = {
            tag: '',
            name: '',
            category: '',
            areCode: '',
            status: '',
            isAll: 0,
            withActiveAre: 0
        }

        AssetsSrvcs.assets(vm.assetsDetails).then(function (response) {
            if (response.data.status == 200) {
                vm.availableAssets = response.data.data;
                console.log(vm.availableAssets)
            }
        }, function () {
            alert('Bad Request!!!')
        })


        AresSrvcs.areItems(vm.areItemDetails).then(function (response) {
            if (response.data.status == 200) {
                vm.assignedAssets = response.data.data;
                console.log(vm.assignedAssets)
            }
        }, function () {
            alert('Bad Request!!!')
        })

        vm.addAreItems = function (data) {

            console.log(data)

            AresSrvcs.saveAreItems(data[0]).then(function (response) {
                if (response.data.status == 200) {

                    alert(response.data.message);
                    console.log(response.data.data)
                    vm.assetItemDetails = [{
                        'are_code': vm.areCode,
                        'asset_code': 'asset_code',
                        'started_at': ''
                    }];

                    vm.assetsDetails = {
                        tag: '',
                        name: '',
                        category: '',
                        areCode: '',
                        status: '',
                        isAll: 0,
                        withActiveAre: 0
                    }

                    AssetsSrvcs.assets(vm.assetsDetails).then(function (response) {
                        if (response.data.status == 200) {
                            vm.availableAssets = response.data.data;
                            console.log(vm.availableAssets)
                        }
                    }, function () {
                        alert('Bad Request!!!')
                    })


                    AresSrvcs.areItems(vm.areItemDetails).then(function (response) {
                        if (response.data.status == 200) {
                            vm.assignedAssets = response.data.data;
                            console.log(vm.assignedAssets)
                        }
                    }, function () {
                        alert('Bad Request!!!')
                    })

                }
            }, function () {
                alert('Bad Request!!!')
            })
        }

        vm.assignAssetBtn = function (assetTag) {
            // alert(assetTag)
            AssetsSrvcs.update({
                tag: assetTag,
                areCode: $stateParams.areCode
            }).then(function (response) {

                vm.assetsDetails = {
                    tag: '',
                    name: '',
                    category: '',
                    areCode: $stateParams.areCode,
                    status: '',
                    isAll: 0
                }
                AssetsSrvcs.assets(vm.assetsDetails).then(function (response) {
                    if (response.data.status == 200) {
                        vm.assignedAssets = response.data.data;
                        console.log(vm.assignedAssets)
                    }
                }, function () {
                    alert('Bad Request!!!')
                })

                vm.assetsDetails = {
                    tag: '',
                    name: '',
                    category: '',
                    areCode: '',
                    status: '',
                    isAll: 0
                }
                AssetsSrvcs.assets(vm.assetsDetails).then(function (response) {
                    if (response.data.status == 200) {
                        vm.availableAssets = response.data.data;
                        console.log(vm.availableAssets)
                    }
                }, function () {
                    alert('Bad Request!!!')
                })

            }, function () {
                alert('Bad Request!!!')
            })
        }


        vm.ok = function () {
            $uibModalInstance.close();
        };

        vm.routeTo = function (route) {
            $window.location.href = route;
        };

    }
})();