(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .controller('OperationCtrl', OperationCtrl)
        .controller('ListOperatingCtrl', ListOperatingCtrl)
        .controller('ListMonitoringCtrl', ListMonitoringCtrl)
        
        OperationCtrl.$inject = ['MaintenanceSrvcs', 'AssetsSrvcs', 'ProjectsSrvcs', '$window'];
        function OperationCtrl(MaintenanceSrvcs, AssetsSrvcs, ProjectsSrvcs, $window){
 
            var vm = this;
            var data = {};

            // alert('this is main controller')
            
            vm.newOperation =  function(data){
                // console.log(data);
                MaintenanceSrvcs.saveOperation(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);
                        vm.routeTo('maintenance/new');
                    }
                    else {
                        alert(response.data.message);
                        // vm.routeTo('asset/create');
                    }
                    console.log(response.data);
                });
            }

            AssetsSrvcs.assets({tag:'', name:'', category:'CONE'}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.assets = response.data.data;
                    console.log(vm.assets)
                }
            }, function (){ alert('Bad Request!!!') })

            ProjectsSrvcs.projects().then (function (response) {
                if(response.data.status == 200)
                {
                    vm.projects = response.data.data;
                    console.log(vm.projects)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.routeTo = function(route){
                $window.location.href = route;
            }; 
        }
        
        ListOperatingCtrl.$inject = ['MaintenanceSrvcs', '$window'];
        function ListOperatingCtrl(MaintenanceSrvcs, $window){
            var vm = this;
            var data = {};
            
            MaintenanceSrvcs.operations({operationCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.operations = response.data.data;
                    console.log(vm.operations)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.routeTo = function(route){
                $window.location.href = route;
            }; 
        }

        ListMonitoringCtrl.$inject = ['MaintenanceSrvcs', '$window'];
        function ListMonitoringCtrl(MaintenanceSrvcs, $window){
            var vm = this;
            var data = {};
            
            MaintenanceSrvcs.assetsMonitoring({tag:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.assetsMonitoring = response.data.data;
                    console.log(vm.assetsMonitoring)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.routeTo = function(route){
                $window.location.href = route;
            }; 
        }

})();