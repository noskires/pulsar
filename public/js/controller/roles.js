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

    RolesModalInstanceCtrl.$inject = ['$uibModalInstance', '$state', 'Datum', 'RolesSrvcs', 'RoleItemsSrvcs', 'ModulesSrvcs', 'ClientsSrvcs', 'ParticularsSrvcs'];

    function RolesModalInstanceCtrl($uibModalInstance, $state, Datum, RolesSrvcs, RoleItemsSrvcs, ModulesSrvcs, ClientsSrvcs, ParticularsSrvcs) {

        var vm = this;
        vm.data = Datum.list;
        console.log(vm.Datum)

        RoleItemsSrvcs.list({
            roleItemCode: '',
            roleCode: vm.data.role_code
        }).then(function (response) {
            if (response.data.status == 200) {
                vm.roleItems = response.data.data;
                console.log(vm.roleItems)
            }
        }, function () {
            alert('Bad Request!!!')
        })

        ModulesSrvcs.list({
            moduleCode: ''
        }).then(function (response) {
            if (response.data.status == 200) {
                vm.modules = response.data.data;
                console.log(vm.modules)
            }
        }, function () {
            alert('Bad Request!!!')
        })

        vm.createRoleItemBtn = function (data) {
            data['role_code'] = vm.data.role_code;
            RoleItemsSrvcs.save(data).then(function (response) {
                // console.log(response.data)
                if (response.data.status == 200) {
                    alert(response.data.message);

                    ModulesSrvcs.list({
                        moduleCode: ''
                    }).then(function (response) {
                        if (response.data.status == 200) {
                            vm.modules = response.data.data;
                            console.log(vm.modules)
                        }
                    }, function () {
                        alert('Bad Request!!!')
                    })

                    RoleItemsSrvcs.list({
                        roleItemCode: '',
                        roleCode: vm.data.role_code
                    }).then(function (response) {
                        if (response.data.status == 200) {
                            vm.roleItems = response.data.data;
                            console.log(vm.roleItems)
                        }
                    }, function () {
                        alert('Bad Request!!!')
                    })

                    // $state.go('list-roleCopy', { roleCode:vm.data.role_code});
                    // vm.ok();
                } else {
                    alert(response.data.message);
                    // console.log(response.data);
                }
            }, function () {
                console.log(response.data);
                alert('Bad Request!!!')
            });
        }

        vm.deleteRoleItemBtn = function (data) {
            console.log(data)
            // data['role_item_code'] = data;
            RoleItemsSrvcs.delete(data).then(function (response) {
                // console.log(response.data)
                if (response.data.status == 200) {
                    alert(response.data.message);

                    ModulesSrvcs.list({
                        moduleCode: ''
                    }).then(function (response) {
                        if (response.data.status == 200) {
                            vm.modules = response.data.data;
                            console.log(vm.modules)
                        }
                    }, function () {
                        alert('Bad Request!!!')
                    })

                    RoleItemsSrvcs.list({
                        roleItemCode: '',
                        roleCode: vm.data.role_code
                    }).then(function (response) {
                        if (response.data.status == 200) {
                            vm.roleItems = response.data.data;
                            console.log(vm.roleItems)
                        }
                    }, function () {
                        alert('Bad Request!!!')
                    })

                    // $state.go('list-roleCopy', { roleCode:vm.data.role_code});
                    // vm.ok();
                } else {
                    alert(response.data.message);
                    // console.log(response.data);
                }
            }, function () {
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