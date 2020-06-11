(function () {
    'use strict';
    angular
        .module('pulsarApp')
        .controller('UsersCtrl', UsersCtrl)
        .controller('UsersModalInstanceCtrl', UsersModalInstanceCtrl)

    UsersCtrl.$inject = ['$stateParams', '$state', 'UsersSrvcs', 'EmployeesSrvcs', 'RolesSrvcs', 'RoleItemsSrvcs', 'ParticularsSrvcs', '$window', '$uibModal', '$scope', '$timeout'];

    function UsersCtrl($stateParams, $state, UsersSrvcs, EmployeesSrvcs, RolesSrvcs, RoleItemsSrvcs, ParticularsSrvcs, $window, $uibModal, $scope, $timeout) {
        var vm = this;

        vm.loader_status = true;

        $timeout(
            function(){ vm.loader_status =false; }
        , 2500);

        vm.getUsers = function () {
            return new Promise(resolve => {
                UsersSrvcs.list({
                    userCode: '',
                    isSelfOnly: false
                }).then(function (response) {
                    if (response.data.status == 200) {
                        resolve(response.data.data);
                    }
                }, function () {
                    alert('Bad Request!!!')
                })
            });
        };

        vm.getEmployees = function () {
            return new Promise(resolve => {
                EmployeesSrvcs.employees({
                    jobType: ''
                }).then(function (response) {
                    if (response.data.status == 200) {
                        resolve(response.data.data);
                    }
                }, function () {
                    alert('Bad Request!!!')
                })
            });
        };

        vm.getGeneratedPassword = function (user) {
            return new Promise(resolve => {
                UsersSrvcs.generatePassword(user).then(function (response) {
                    if (response.data.status == 200) {
                        resolve(response.data.data);
                    }
                }, function () {
                    alert('Bad Request!!!')
                })
            });
        };

        vm.refreshDisplay = function () {
            vm.getEmployees().then(async (e) => {
                const users = await vm.getUsers();
                vm.users = users.map(user => ({
                    ...user,
                    is_active: (user.is_active) ? true : false
                }));

                const data = e.filter(employee => !(vm.users.map(user => user.employee_code).includes(employee.employee_code)));
                $scope.$apply(() => vm.employees = data);
            });
        };
        vm.refreshDisplay();

        RolesSrvcs.list({
            roleCode: ''
        }).then(function (response) {
            if (response.data.status == 200) {
                vm.roles = response.data.data;
            }
        }, function () {
            alert('Bad Request!!!')
        })

        if ($stateParams.userCode) {
            vm.userCode = $stateParams.userCode;

            UsersSrvcs.list({
                userCode: vm.userCode
            }).then(function (response) {
                if (response.data.status == 200) {
                    vm.user = response.data.data[0];

                    var modalInstance = $uibModal.open({
                        controller: 'UsersModalInstanceCtrl',
                        templateUrl: 'Edit.modal',
                        controllerAs: 'vm',
                        backdrop: 'static',
                        keyboard: false,
                        resolve: {
                            Datum: function () {
                                return {
                                    title: '',
                                    message: '',
                                    list: vm.user
                                };
                            }
                        }
                    });
                }
            }, function () {
                alert('Bad Request!!!')
            })
        }

        vm.createUserBtn = function (data) {
            UsersSrvcs.save(data).then(function (response) {
                if (response.data.status == 200) {
                    vm.refreshDisplay();
                    alert(response.data.message);

                    UsersSrvcs.list({
                        userCode: ''
                    }).then(function (response) {
                        if (response.data.status == 200) {
                            vm.users = response.data.data;
                            console.log(vm.users)
                        }
                    }, function () {
                        alert('Bad Request!!!')
                    })

                    $state.go('list-user', {
                        roleCode: ''
                    });
                    // vm.ok();
                } else {
                    alert(response.data.message);
                }
            }, function () {
                console.log(response.data);
                alert('Bad Request!!!')
            });
        }

        vm.updateUserBtn = function (data) {
            UsersSrvcs.update(data).then(function (response) {
                vm.refreshDisplay();
                if (response.data.status != 200) {
                    alert(response.data.message);
                }
            }, function () {
                console.log(response.data);
                alert('Bad Request!!!')
            });
        }

        vm.resetPassword = async function (user) {
            if (!confirm("Do you want to reset the password of this employe?")) return;
            await vm.getGeneratedPassword(user);
            vm.refreshDisplay();

        }
        vm.routeTo = function (route) {
            $window.location.href = route;
        };
    }

    UsersModalInstanceCtrl.$inject = ['$uibModalInstance', '$state', 'Datum', 'UsersSrvcs', 'RolesSrvcs', 'RoleItemsSrvcs', 'ModulesSrvcs', 'ClientsSrvcs', 'ParticularsSrvcs'];

    function UsersModalInstanceCtrl($uibModalInstance, $state, Datum, UsersSrvcs, RolesSrvcs, RoleItemsSrvcs, ModulesSrvcs, ClientsSrvcs, ParticularsSrvcs) {

        var vm = this;
        vm.data = Datum.list;
        console.log(vm.data)

        RolesSrvcs.list({
            roleCode: ''
        }).then(function (response) {
            if (response.data.status == 200) {
                vm.roles = response.data.data;
            }
        }, function () {
            alert('Bad Request!!!')
        })

        vm.updateUserBtn = function (data) {
            UsersSrvcs.update(data).then(function (response) {
                if (response.data.status == 200) {
                    alert(response.data.message);

                    $state.go('list-user', {
                        roleCode: ''
                    });
                    vm.ok();
                } else {
                    alert(response.data.message);
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