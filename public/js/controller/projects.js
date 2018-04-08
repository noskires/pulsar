(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .controller('ProjectsCtrl', ProjectsCtrl) 
        .controller('ProjectsModalInstanceCtrl', ProjectsModalInstanceCtrl) 

        ProjectsCtrl.$inject = ['$stateParams', 'ProjectsSrvcs', 'EmployeesSrvcs', 'AddressesSrvcs', '$window', '$uibModal'];
        function ProjectsCtrl($stateParams, ProjectsSrvcs, EmployeesSrvcs, AddressesSrvcs, $window, $uibModal){
            var vm = this;
            var data = {}; 


            if($stateParams.projectCode)
            {
                vm.projectCode = $stateParams.projectCode;

                ProjectsSrvcs.projects({projectCode:vm.projectCode}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.project = response.data.data[0];
                        console.log(vm.project)
                        
                        var modalInstance = $uibModal.open({
                            controller:'ProjectsModalInstanceCtrl',
                            templateUrl:'projectInfo.modal',
                            controllerAs: 'vm',
                            resolve :{
                              formData: function () {
                                return {
                                    title:'Project Controller',
                                    message:response.data.message,
                                    project: vm.project
                                };
                              }
                            }
                        });
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            ProjectsSrvcs.projects({projectCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.projects = response.data.data;
                    console.log(vm.projects)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.newProject =  function(data){
                // console.log(data);
                ProjectsSrvcs.save(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);
                        vm.routeTo('project/new');
                    }
                    else {
                        alert(response.data.message);
                        // vm.routeTo('asset/create');
                    }
                console.log(response.data);
                });
            }

            vm.selectRegion =  function(region_code){
                console.log(region_code);
                AddressesSrvcs.province({region_code:region_code}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.provinces = response.data.data;
                        console.log(vm.provinces)
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            vm.selectProvince =  function(province_code){
                console.log(province_code);
                AddressesSrvcs.municipality({province_code:province_code}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.municipalities = response.data.data;
                        console.log(vm.municipalities)
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            EmployeesSrvcs.employees({jobType:'POS-002'}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.employees = response.data.data;
                    console.log(vm.employees)
                }
            }, function (){ alert('Bad Request!!!') })

            AddressesSrvcs.region().then (function (response) {
                if(response.data.status == 200)
                {
                    vm.regions = response.data.data;
                    console.log(vm.regions)
                }
            }, function (){ alert('Bad Request!!!') })

            AddressesSrvcs.province({region_code:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.provinces = response.data.data;
                    console.log(vm.provinces)
                }
            }, function (){ alert('Bad Request!!!') })

            AddressesSrvcs.municipality({province_code:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.municipalities = response.data.data;
                    console.log(vm.municipalities)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.routeTo = function(route){
                $window.location.href = route;
            };
        }

        ProjectsModalInstanceCtrl.$inject = ['$uibModalInstance', 'formData'];
        function ProjectsModalInstanceCtrl ($uibModalInstance, formData) {

            var vm = this;
            vm.formData = formData.project;

            vm.ok = function() {
                $uibModalInstance.close();
            };
            
            vm.routeTo = function(route){
                $window.location.href = route;
            };
        }
})();