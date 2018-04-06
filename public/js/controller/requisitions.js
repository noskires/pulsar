(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .controller('RequisitionsAddCtrl', RequisitionsAddCtrl)
        .factory('MainSrvcs',MainSrvcs)
        
    
        RequisitionsAddCtrl.$inject = ['$stateParams', 'RequisitionsSrvcs', 'AssetsSrvcs', 'EmployeesSrvcs', 'OrganizationsSrvcs', 'AddressesSrvcs', 'ProjectsSrvcs', '$window', '$uibModal'];
        function RequisitionsAddCtrl($stateParams, RequisitionsSrvcs, AssetsSrvcs, EmployeesSrvcs, OrganizationsSrvcs, AddressesSrvcs, ProjectsSrvcs, $window, $uibModal){
            var vm = this;
            var data = {};

            //employee services
            // EmployeesSrvcs.employees({jobType:''}).then (function (response) {
            //     if(response.data.status == 200)
            //     {
            //         vm.employees = response.data.data;
            //         console.log(vm.employees)
            //     }
            // }, function (){ alert('Bad Request!!!') })

            // //organizations services
            // OrganizationsSrvcs.organizations().then (function (response) {
            //     if(response.data.status == 200)
            //     {
            //         vm.organizations = response.data.data;
            //         console.log(vm.organizations)
            //     }
            // }, function (){ alert('Bad Request!!!') })

            // AssetsSrvcs.asset_categories().then (function (response) {
            //     if(response.data.status == 200)
            //     {
            //         vm.asset_categories = response.data.data;
            //         console.log(vm.asset_categories)
            //     }
            // }, function (){ alert('Bad Request!!!') })

            // AssetsSrvcs.asset_methods().then (function (response) {
            //     if(response.data.status == 200)
            //     {
            //         vm.methods = response.data.data;
            //         console.log(vm.methods)
            //     }
            // }, function (){ alert('Bad Request!!!') })

            // ProjectsSrvcs.projects().then (function (response) {
            //     if(response.data.status == 200)
            //     {
            //         vm.projects = response.data.data;
            //         console.log(vm.projects)
            //     }
            // }, function (){ alert('Bad Request!!!') })

            vm.newRequisitionSlip = function(data){
                console.log(data);
                RequisitionsSrvcs.save(data).then(function(response){
                    // if (response.data.status == 200) {
                    //     alert(response.data.message);
                    //     vm.routeTo('asset/new');
                    // }
                    // else {
                    //     alert(response.data.message);
                    // }
                    console.log(response.data);
                });
            };

            vm.routeTo = function(route){
                $window.location.href = route;
            };

        }

        MainSrvcs.$inject = ['$http'];
        function MainSrvcs($http) {
            return {
            };
        }
})();