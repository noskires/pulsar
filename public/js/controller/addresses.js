(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .controller('AddressCtrl', AddressCtrl) 

        AddressCtrl.$inject = ['AddressesSrvcs', '$window'];
        function AddressCtrl(AddressesSrvcs, $window){
            var vm = this;
            var data = {}; 

            AddressesSrvcs.region().then (function (response) {
                if(response.data.status == 200)
                {
                    vm.regions = response.data.data;
                    console.log(vm.regions)
                }
            }, function (){ alert('Bad Request!!!') })

            AddressesSrvcs.province().then (function (response) {
                if(response.data.status == 200)
                {
                    vm.provinces = response.data.data;
                    console.log(vm.provinces)
                }
            }, function (){ alert('Bad Request!!!') })

            AddressesSrvcs.municipality().then (function (response) {
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
})();