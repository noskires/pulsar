(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .controller('UsersCtrl', UsersCtrl)
        .controller('UsersModalInstanceCtrl', UsersModalInstanceCtrl)

        UsersCtrl.$inject = ['$stateParams', '$state', 'UsersSrvcs', 'EmployeesSrvcs', 'RolesSrvcs', 'RoleItemsSrvcs', 'ParticularsSrvcs', '$window', '$uibModal'];
        function UsersCtrl($stateParams, $state, UsersSrvcs, EmployeesSrvcs, RolesSrvcs, RoleItemsSrvcs, ParticularsSrvcs, $window, $uibModal){
            var vm = this;
            var data = {};

            EmployeesSrvcs.employees({jobType:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.employees = response.data.data;
                    console.log(vm.employees)
                }
            }, function (){ alert('Bad Request!!!') })
 
            UsersSrvcs.list({userCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.users = response.data.data;
                    console.log(vm.users)
                }
            }, function (){ alert('Bad Request!!!') })

            RolesSrvcs.list({roleCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.roles = response.data.data;
                    console.log(vm.roles)
                }
            }, function (){ alert('Bad Request!!!') })

            if($stateParams.userCode)
            {
                vm.userCode = $stateParams.userCode;
 
                UsersSrvcs.list({userCode:vm.userCode}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.user = response.data.data[0];
                        console.log(vm.user)

                        var modalInstance = $uibModal.open({
                            controller:'UsersModalInstanceCtrl',
                            templateUrl:'Edit.modal',
                            controllerAs: 'vm',
                            resolve :{
                              Datum: function () {
                                return {
                                    title:'',
                                    message:'',
                                    list: vm.user
                                };
                              }
                            }
                        });
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            vm.createUserBtn = function(data){
                console.log(data)
                // alert('create')
                UsersSrvcs.save(data).then(function(response){

                    console.log(response.data)
                    if (response.data.status == 200) {
                        alert(response.data.message);

                        UsersSrvcs.list({userCode:''}).then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.users = response.data.data;
                                console.log(vm.users)
                            }
                        }, function (){ alert('Bad Request!!!') })

                        $state.go('list-role', { roleCode:''});
                        // vm.ok();
                    }
                    else {
                        alert(response.data.message);
                        console.log(response.data);
                    }
                }, function (){ console.log(response.data); alert('Bad Request!!!') });
            }

            vm.routeTo = function(route){
                $window.location.href = route;
            }; 
        }

        UsersModalInstanceCtrl.$inject = ['$uibModalInstance', '$state', 'Datum', 'UsersSrvcs', 'RolesSrvcs', 'RoleItemsSrvcs', 'ModulesSrvcs', 'ClientsSrvcs', 'ParticularsSrvcs'];
        function UsersModalInstanceCtrl ($uibModalInstance, $state, Datum, UsersSrvcs, RolesSrvcs, RoleItemsSrvcs, ModulesSrvcs, ClientsSrvcs, ParticularsSrvcs) {

            var vm = this;
            vm.data = Datum.list;
            console.log(vm.data)

            RolesSrvcs.list({roleCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.roles = response.data.data;
                    console.log(vm.roles)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.updateUserBtn =  function(data){
                // console.log(data)
                UsersSrvcs.update(data).then(function(response){
                    console.log(response.data)
                    if (response.data.status == 200) {
                        console.log(response.data);
                        alert(response.data.message);

                        $state.go('list-user', { roleCode:''});
                        vm.ok();
                    }
                    else {
                        alert(response.data.message);
                        // console.log(response.data);
                    }
                }, function (){ console.log(response.data); alert('Bad Request!!!') });
            }

            vm.ok = function() {
                $uibModalInstance.close();
            };
            
            vm.routeTo = function(route){
                $window.location.href = route;
            };

            // vm.printSupplyDetails = function(tag){
            //     vm.url = 'supply/report/'+tag;
            // }
        }
})();