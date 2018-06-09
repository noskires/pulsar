(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .controller('DTCtrl', DTCtrl) 
        .controller('EmployeesModalInstanceCtrl1', EmployeesModalInstanceCtrl1) 

        DTCtrl.$inject = ['EmployeesSrvcs', '$window', '$uibModal', 'DTOptionsBuilder'];
        function DTCtrl(EmployeesSrvcs, $window, $uibModal, DTOptionsBuilder){

            var vm = this;
            var data = {}; 

            EmployeesSrvcs.employees({jobType:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.employees = response.data.data;
                    console.log(vm.employees)

                    vm.dtOptions = DTOptionsBuilder.fromSource(vm.employees)
                        .withDOM('frtip')
                        .withPaginationType('full_numbers')
                        // Active Buttons extension
                        .withButtons([
                           {
                           extend:    'copy',
                           text:      '<i class="fa fa-files-o"></i> Copy',
                           titleAttr: 'Copy'
                           },
                           {
                           extend:    'print',
                           text:      '<i class="fa fa-print" aria-hidden="true"></i> Print',
                           titleAttr: 'Print'
                           },
                           {
                           extend:    'excel',
                           text:      '<i class="fa fa-file-text-o"></i> Excel',
                           titleAttr: 'Excel'
                           }
                          ]
                        );
                }
            }, function (){ alert('Bad Request!!!') })

            // alert('data angular here');

            // vm.employeeInfo = function(info){
            //     alert(info)
            // }

            vm.addNewEmployee = function(){
                var modalInstance = $uibModal.open({
                    controller:'EmployeesModalInstanceCtrl1',
                    templateUrl:'employeeNewTpl.modal',
                    controllerAs: 'dtc',
                    resolve :{
                      formData: function () {
                        return {
                            title:'Employees Controller',
                            // message:"response.data.message"
                        };
                      }
                    }
                });
            }

            vm.employeeInfo = function(employee_id){
                // alert(employee_id)
                EmployeesSrvcs.employees2({employee_id:employee_id}).then (function (response) {

                    if(response.data.status == 200)
                    {
                        vm.employee = response.data.data[0];
                        console.log(vm.employee)

                        var modalInstance = $uibModal.open({
                            controller:'EmployeesModalInstanceCtrl1',
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

            vm.routeTo = function(route){
                $window.location.href = route;
            };

        }

        EmployeesModalInstanceCtrl1.$inject = ['$uibModalInstance', 'formData', 'EmployeesSrvcs', '$window'];
        function EmployeesModalInstanceCtrl1 ($uibModalInstance, formData, EmployeesSrvcs, $window) {

            var vm = this;
            
            vm.formData = formData.employee;
            // console.log(vm.formData);
            vm.ok = function() {
                $uibModalInstance.close();
            };
            
            vm.close = function() {
                $uibModalInstance.close();
            };

            EmployeesSrvcs.positions({positionCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.positions = response.data.data;
                    console.log(vm.positions)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.submit = function(data){
          
                console.log(data);
                vm.erikson = "erik";
                EmployeesSrvcs.save(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);

                        EmployeesSrvcs.employees({jobType:''}).then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.employees = response.data.data;
                                console.log(vm.employees)
                            }
                        }, function (){ alert('Bad Request!!!') })

                    }
                    else {
                        alert(response.data.message);
                    }
                    console.log(response.data);
                });
                // alert('sumbbbb')
            };

            vm.updateEmployee =  function(data){
                // console.log(data);
                EmployeesSrvcs.update(data).then(function(response){
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
                    }
                }, function (){ alert('Bad Request!!!') });
            }

            // vm.routeTo = function(route){
            //     $window.location.href = route;
            // };
        }
})();