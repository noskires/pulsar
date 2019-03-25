(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .controller('ProjectsCtrl', ProjectsCtrl) 
        .controller('ProjectsModalInstanceCtrl', ProjectsModalInstanceCtrl) 
        .controller('ProjectProfileDetailsCtrl', ProjectProfileDetailsCtrl) 
        .controller('ProjectProfileEditCtrl', ProjectProfileEditCtrl) 

        ProjectsCtrl.$inject = ['$state', '$stateParams', 'OrganizationsSrvcs', 'ProjectsSrvcs', 'EmployeesSrvcs', 'AddressesSrvcs', 'ClientsSrvcs', '$window', '$uibModal'];
        function ProjectsCtrl($state, $stateParams, OrganizationsSrvcs, ProjectsSrvcs, EmployeesSrvcs, AddressesSrvcs, ClientsSrvcs, $window, $uibModal){
            var vm = this;
            var data = {}; 

            vm.projectDetails = {'client_code' : 'CLIENT-0001-20190324023723'};

            vm.open1 = function() {
                vm.popup1.opened = true;
            };

            vm.popup1 = {
                opened: false
            };

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

            ClientsSrvcs.clients({clientCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.clients = response.data.data;
                    console.log(vm.clients)
                }
            }, function (){ alert('Bad Request!!!') })

            OrganizationsSrvcs.organizations({orgCode:'', nextOrgCode:'', orgType:'Department', startDate:'', endDate:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.departments = response.data.data;
                    console.log(vm.departments)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.selectDepartment =  function(departmentCode){
                console.log(departmentCode);
                OrganizationsSrvcs.organizations({orgCode:'', nextOrgCode:departmentCode, orgType:'Division', startDate:'', endDate:''}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.divisions = response.data.data;
                        console.log(vm.divisions)
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            vm.newProject =  function(data){
                console.log(data);

                ProjectsSrvcs.save(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);
                        // vm.routeTo('project/new');

                        vm.projectDetails.client_code = 'CLIENT-0001-20190324023723';

                        ProjectsSrvcs.projects({projectCode:''}).then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.projects = response.data.data;
                                console.log(vm.projects)
                            }
                        }, function (){ alert('Bad Request!!!') })
                        
                        $state.go('list-projects');
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

            EmployeesSrvcs.employees({jobType:''}).then (function (response) { //POS-002
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

        ProjectProfileDetailsCtrl.$inject = ['$stateParams', 'ProjectsSrvcs', '$window', '$uibModal'];
        function ProjectProfileDetailsCtrl($stateParams, ProjectsSrvcs, $window, $uibModal){
            var vm = this;
            var data = {};

            // alert($stateParams.projectCode)

            ProjectsSrvcs.projects({projectCode:$stateParams.projectCode}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.project = response.data.data[0];
                    console.log(vm.project)
                }
            }, function (){ alert('Bad Request!!!') })

            if($stateParams.actionType=='edit')
            {
             
                vm.projectCode = $stateParams.projectCode;

                ProjectsSrvcs.projects({projectCode:vm.projectCode}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.project = response.data.data[0];
                        console.log(vm.project)
                        
                        var modalInstance = $uibModal.open({
                            controller:'ProjectProfileEditCtrl',
                            templateUrl:'project.edit.modal',
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
            
        }

        ProjectProfileEditCtrl.$inject = ['$uibModalInstance', '$state', '$stateParams','ProjectsSrvcs', 'OrganizationsSrvcs', 'EmployeesSrvcs', 'AddressesSrvcs', 'ClientsSrvcs', 'formData', '$window', '$uibModal'];
        function ProjectProfileEditCtrl ($uibModalInstance, $state, $stateParams, ProjectsSrvcs, OrganizationsSrvcs, EmployeesSrvcs, AddressesSrvcs, ClientsSrvcs, formData, $window, $uibModal) {

            var vm = this;
            vm.formData = formData.project;

            console.log(vm.formData)

            
            ClientsSrvcs.clients({clientCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.clients = response.data.data;
                    console.log(vm.clients)
                }
            }, function (){ alert('Bad Request!!!') })
            

            OrganizationsSrvcs.organizations({orgCode:'', nextOrgCode:'', orgType:'Department', startDate:'', endDate:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.departments = response.data.data;
                    console.log(vm.departments)
                }
            }, function (){ alert('Bad Request!!!') })


            vm.selectDepartment =  function(departmentCode){
                console.log(departmentCode);
                OrganizationsSrvcs.organizations({orgCode:'', nextOrgCode:departmentCode, orgType:'Division', startDate:'', endDate:''}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.divisions = response.data.data;
                        console.log(vm.divisions)
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            vm.selectDepartment(vm.formData.department_code)
            

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

            vm.selectRegion(vm.formData.region_code)

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

            vm.selectProvince(vm.formData.province_code)

            EmployeesSrvcs.employees({jobType:'POS-00004'}).then (function (response) { //POS-002
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


            vm.updateProjectBtn = function(data){
                console.log(data)

                ProjectsSrvcs.update(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);
                        
                        $state.go('project-profile', {projectCode: $stateParams.projectCode});
                        vm.ok();
                    }
                    else {
                        alert(response.data.message);
                        // vm.routeTo('asset/create');
                    }
                    console.log(response.data);
                });
            }
            

            vm.ok = function() {
                $uibModalInstance.close();
            };
            
            vm.routeTo = function(route){
                $window.location.href = route;
            };
        }
})();