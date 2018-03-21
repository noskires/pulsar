(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .controller('ProjectsCtrl', ProjectsCtrl) 

        ProjectsCtrl.$inject = ['ProjectsSrvcs', 'EmployeesSrvcs', '$window'];
        function ProjectsCtrl(ProjectsSrvcs, EmployeesSrvcs, $window){
            var vm = this;
            var data = {}; 

            ProjectsSrvcs.projects().then (function (response) {
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

            EmployeesSrvcs.employees({jobType:'Project Eng.'}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.employees = response.data.data;
                    console.log(vm.employees)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.routeTo = function(route){
                $window.location.href = route;
            };
        }
})();