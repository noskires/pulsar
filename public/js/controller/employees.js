(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .controller('EmployeesCtrl', EmployeesCtrl) 
        .controller('EmployeesModalInstanceCtrl', EmployeesModalInstanceCtrl) 
        .controller('PositionsModalInstanceCtrl', PositionsModalInstanceCtrl) 

        EmployeesCtrl.$inject = ['$state', 'EmployeesSrvcs', 'OrganizationsSrvcs', '$window', '$uibModal'];
        function EmployeesCtrl($state, EmployeesSrvcs, OrganizationsSrvcs, $window, $uibModal){
            var vm = this;
            var data = {}; 

            EmployeesSrvcs.employees({jobType:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.employees = response.data.data;
                    console.log(vm.employees)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.addNewEmployee = function(){
                var modalInstance = $uibModal.open({
                    controller:'EmployeesModalInstanceCtrl',
                    templateUrl:'employeeNewTpl.modal',
                    controllerAs: 'vm',
                    resolve :{
                      formData: function () {
                        return {
                            title:'Employees Controller',
                            message:"response.data.message"
                        };
                      }
                    }
                });
            }

            vm.addNewPosition = function(){
                var modalInstance = $uibModal.open({
                    controller:'PositionsModalInstanceCtrl',
                    templateUrl:'positionNewTpl.modal',
                    controllerAs: 'vm',
                    resolve :{
                      formData: function () {
                        return {
                            title:'Positions Controller',
                            message:"response.data.message"
                        };
                      }
                    }
                });
            }

            vm.employeeInfo = function(employee_code){
                // alert(employee_id)
                EmployeesSrvcs.employees2({employee_code:employee_code}).then (function (response) {

                    if(response.data.status == 200)
                    {
                        vm.employee = response.data.data[0];
                        console.log(vm.employee)

                        var modalInstance = $uibModal.open({
                            controller:'EmployeesModalInstanceCtrl',
                            templateUrl:'employeeEditTpl.modal',
                            controllerAs: 'vm',
                            resolve :{
                              formData: function () {
                                return {
                                    title:'Employee Controller',
                                    message:response.data.message,
                                    employee: vm.employee
                                };
                              }
                            }
                        });
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            OrganizationsSrvcs.departments({orgCode:'', nextOrgCode:'', orgType:'Department', startDate:'', endDate:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.departments = response.data.data;
                    console.log(vm.departments)
                }
            }, function (){ alert('Bad Request!!!') })

            OrganizationsSrvcs.divisions({orgCode:'', nextOrgCode:'', orgType:'Division', startDate:'', endDate:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.divisions = response.data.data;
                    console.log(vm.divisions)
                }
            }, function (){ alert('Bad Request!!!') })

            OrganizationsSrvcs.units({orgCode:'', nextOrgCode:'', orgType:'Unit', startDate:'', endDate:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.units = response.data.data;
                    console.log(vm.units)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.selectDepartment =  function(departmentCode){
                console.log(departmentCode);
           
                OrganizationsSrvcs.divisions({orgCode:'', nextOrgCode:departmentCode, orgType:'Division', startDate:'', endDate:''}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.divisions = response.data.data;
                        console.log(vm.divisions)
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            vm.selectDivision =  function(divisionCode){
                console.log(divisionCode);
           
                OrganizationsSrvcs.units({orgCode:'', nextOrgCode:divisionCode, orgType:'Unit', startDate:'', endDate:''}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.units = response.data.data;
                        console.log(vm.units)
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            EmployeesSrvcs.positions({positionCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.positions = response.data.data;
                    console.log(vm.positions)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.submit = function(data){
                console.log(data);
                EmployeesSrvcs.save(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);
                        // vm.routeTo('employee/list');

                        EmployeesSrvcs.employees({jobType:''}).then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.employees = response.data.data;
                                console.log(vm.employees)
                            }
                        }, function (){ alert('Bad Request!!!') })

                        $state.go('list-employees');
                    }
                    else {
                        alert(response.data.message);
                    }
                    console.log(response.data);
                });
                // alert('sumbbbb')
            };
        }


        EmployeesModalInstanceCtrl.$inject = ['$state', '$uibModalInstance', 'formData', 'EmployeesSrvcs', 'OrganizationsSrvcs', '$window'];
        function EmployeesModalInstanceCtrl ($state, $uibModalInstance, formData, EmployeesSrvcs, OrganizationsSrvcs, $window) {

            var vm = this;
            vm.formData = formData.employee;
            // console.log(vm.formData);
            vm.ok = function() {
                $uibModalInstance.close();
            };
            
            vm.close = function() {
                $uibModalInstance.close();
            };

            OrganizationsSrvcs.departments({orgCode:'', nextOrgCode:'', orgType:'Department', startDate:'', endDate:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.departments = response.data.data;
                    console.log(vm.departments)
                }
            }, function (){ alert('Bad Request!!!') })

            OrganizationsSrvcs.divisions({orgCode:'', nextOrgCode:'', orgType:'Division', startDate:'', endDate:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.divisions = response.data.data;
                    console.log(vm.divisions)
                }
            }, function (){ alert('Bad Request!!!') })

            OrganizationsSrvcs.units({orgCode:'', nextOrgCode:'', orgType:'Unit', startDate:'', endDate:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.units = response.data.data;
                    console.log(vm.units)
                }
            }, function (){ alert('Bad Request!!!') })

 

            vm.selectDepartment =  function(departmentCode){
                console.log(departmentCode);
           
                OrganizationsSrvcs.divisions({orgCode:'', nextOrgCode:departmentCode, orgType:'Division', startDate:'', endDate:''}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.divisions = response.data.data;
                        console.log(vm.divisions)
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            vm.selectDivision =  function(divisionCode){
                console.log(divisionCode);
           
                OrganizationsSrvcs.units({orgCode:'', nextOrgCode:divisionCode, orgType:'Unit', startDate:'', endDate:''}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.units = response.data.data;
                        console.log(vm.units)
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            EmployeesSrvcs.positions({positionCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.positions = response.data.data;
                    console.log(vm.positions)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.submit = function(data){
                console.log(data);
                EmployeesSrvcs.save(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);
                        vm.routeTo('employee/list');
                    }
                    else {
                        alert(response.data.message);
                    }
                    console.log(response.data);
                });
                // alert('sumbbbb')
            };

            vm.updateEmployee =  function(data){
                console.log(data);
                EmployeesSrvcs.update(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);
                        // vm.routeTo('employee/list');
                        // console.log(response.data);
                        EmployeesSrvcs.employees({jobType:''}).then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.employees = response.data.data;
                                console.log(vm.employees)
                            }
                        }, function (){ alert('Bad Request!!!') })

                        $state.go('list-employees');
                    }
                }, function (){ alert('Bad Request!!!') });
            }

            vm.routeTo = function(route){
                $window.location.href = route;
            };
        }


        PositionsModalInstanceCtrl.$inject = ['$uibModalInstance', 'formData', 'EmployeesSrvcs', 'OrganizationsSrvcs', '$window'];
        function PositionsModalInstanceCtrl ($uibModalInstance, formData, EmployeesSrvcs, OrganizationsSrvcs, $window) {

            var vm = this;

            vm.submit = function(data){
                console.log(data);
                EmployeesSrvcs.NewPosition(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);
                        vm.routeTo('employee/list');
                    }
                    else {
                        alert(response.data.message);
                    }
                    console.log(response.data);
                });
            };

            vm.ok = function() {
                $uibModalInstance.close();
            };
            
            vm.close = function() {
                $uibModalInstance.close();
            };

            vm.routeTo = function(route){
                $window.location.href = route;
            };

        }
})();