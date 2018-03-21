(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .controller('JobOrdersCtrl', JobOrdersCtrl) 

        JobOrdersCtrl.$inject = ['JobOrdersSrvcs', '$window'];
        function JobOrdersCtrl(JobOrdersSrvcs, $window){
            var vm = this;
            var data = {}; 
            alert('a');
            JobOrdersSrvcs.jobOrders().then (function (response) {
                if(response.data.status == 200)
                {
                    vm.jobOrders = response.data.data;
                    console.log(vm.jobOrders)
                }
            }, function (){ alert('Bad Request!!!') })


            vm.newJobOrder =  function(data){
                console.log(data);
                JobOrdersSrvcs.save(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);
                        vm.routeTo('job-order/new');
                    }
                    else {
                        alert(response.data.message);
                        // vm.routeTo('asset/create');
                    }
                    console.log(response.data);
                });
            }


            vm.routeTo = function(route){
                $window.location.href = route;
            };
        }
})();