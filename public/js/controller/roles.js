(function () {
    'use strict';
    angular
        .module('pulsarApp')
        .controller('RolesCtrl', RolesCtrl)
        .controller('RolesModalInstanceCtrl', RolesModalInstanceCtrl)

    RolesCtrl.$inject = ['$stateParams', '$state', 'RolesSrvcs', 'RoleItemsSrvcs', 'ParticularsSrvcs', '$window', '$uibModal'];

    function RolesCtrl($stateParams, $state, RolesSrvcs, RoleItemsSrvcs, ParticularsSrvcs, $window, $uibModal) {
        var vm = this;
        var data = {};

        RolesSrvcs.list({
            roleCode: ''
        }).then(function (response) {
            if (response.data.status == 200) {
                vm.roles = response.data.data;
                console.log(vm.roles)
            }
        }, function () {
            alert('Bad Request!!!')
        })



        if ($stateParams.roleCode) {
            vm.roleCode = $stateParams.roleCode;

            RolesSrvcs.list({
                roleCode: vm.roleCode
            }).then(function (response) {
                if (response.data.status == 200) {
                    vm.client = response.data.data[0];

                    var modalInstance = $uibModal.open({
                        controller: 'RolesModalInstanceCtrl',
                        templateUrl: 'Edit.modal',
                        controllerAs: 'vm',
                        resolve: {
                            Datum: function () {
                                return {
                                    title: '',
                                    message: '',
                                    list: vm.client
                                };
                            }
                        }
                    });
                }
            }, function () {
                alert('Bad Request!!!')
            })
        }


        vm.modules = [
            'Assets',
            'Projects',
            'Employees',
            'Finance'
        ];

        console.log(vm.roles)

        vm.createRoleBtn = function (data) {
            console.log(data)
            // alert('create')
            RolesSrvcs.save(data).then(function (response) {

                console.log(response.data)
                if (response.data.status == 200) {
                    alert(response.data.message);

                    RolesSrvcs.list({
                        roleCode: ''
                    }).then(function (response) {
                        if (response.data.status == 200) {
                            vm.roles = response.data.data;
                            console.log(vm.roles)
                            console.log(response.data)
                        }
                    }, function () {
                        alert('Bad Request!!!')
                    })

                    $state.go('list-role', {
                        roleCode: ''
                    });
                    // vm.ok();
                } else {
                    alert(response.data.message);
                    console.log(response.data);
                }
            }, function () {
                console.log(response.data);
                alert('Bad Request!!!')
            });
        }

        // if($stateParams.clientRequest == "new")
        // {

        //     var modalInstance = $uibModal.open({
        //         controller:'RolesModalInstanceCtrl',
        //         templateUrl:'Create.modal',
        //         controllerAs: 'vm',
        //         resolve :{
        //             data: function () {
        //                 return {
        //                     title:'',
        //                     message:''
        //                 };
        //             }
        //         },
        //         // size: 'lg'
        //     });
        // }

        vm.routeTo = function (route) {
            $window.location.href = route;
        };
    }

    RolesModalInstanceCtrl.$inject = ['$uibModalInstance', '$state', 'Datum', 'RolesSrvcs', 'RoleItemsSrvcs', 'ModulesSrvcs', 'ClientsSrvcs', 'ParticularsSrvcs', '$scope'];

    function RolesModalInstanceCtrl($uibModalInstance, $state, Datum, RolesSrvcs, RoleItemsSrvcs, ModulesSrvcs, ClientsSrvcs, ParticularsSrvcs, $scope) {

        var vm = this;
        vm.data = Datum.list;
        vm.getRoleItems = () => {
            return new Promise(resolve => {
                RoleItemsSrvcs.list({
                    roleItemCode: '',
                    roleCode: vm.data.role_code
                }).then(function (response) {
                    if (response.data.status == 200) {
                        resolve(response.data.data);
                    }
                }, function () {
                    alert('Bad Request!!!')
                })
            });
        };

        vm.getModules = () => {
            return new Promise(resolve => {
                ModulesSrvcs.list({
                    moduleCode: ''
                }).then(function (response) {
                    if (response.data.status == 200) {
                        resolve(response.data.data);
                    }
                }, function () {
                    alert('Bad Request!!!')
                })
            });
        }

        vm.filterOutModules = async (modules) => {
            vm.modules = await vm.getModules();
            $scope.$apply(() => {
                vm.modules = vm.modules.filter(item => !modules.includes(item.module_code));
            });
        };

        vm.refreshDisplay = async () => {
            vm.roleItems = await vm.getRoleItems();
            await vm.filterOutModules(vm.roleItems.map(e => e.module_code));
        }

        vm.refreshDisplay().then(async () => {
            await vm.refreshDisplay();
        });

        vm.createRoleItemBtn = function (data) {
            if (!data || !data.module_code) return;
            data['role_code'] = vm.data.role_code;
            RoleItemsSrvcs.save(data).then(async function (response) {
                    if (response.data.status == 200) {
                        await vm.refreshDisplay();
                    } else {
                        alert(response.data.message);
                    }
                },
                function () {
                    console.log(response.data);
                    alert('Bad Request!!!')
                });
        }

        vm.deleteRoleItemBtn = function (data) {
            RoleItemsSrvcs.delete(data).then(async function (response) {
                    if (response.data.status == 200) {
                        await vm.refreshDisplay();
                    } else {
                        alert(response.data.message);
                    }
                },
                function () {
                    console.log(response.data);
                    alert('Bad Request!!!')
                });
        }

        vm.updateRoleBtn = function (data) {
            // console.log(data)
            RolesSrvcs.update(data).then(function (response) {
                console.log(response.data)
                if (response.data.status == 200) {
                    console.log(response.data);
                    alert(response.data.message);

                    $state.go('list-role', {
                        roleCode: ''
                    });
                    vm.ok();
                } else {
                    alert(response.data.message);
                    // console.log(response.data);
                }
            }, function () {
                console.log(response.data);
                alert('Bad Request!!!')
            });
        }

        vm.ok = function () {
            $uibModalInstance.close();
        };

        vm.routeTo = function (route) {
            $window.location.href = route;
        };

        // vm.printSupplyDetails = function(tag){
        //     vm.url = 'supply/report/'+tag;
        // }
    }
})();