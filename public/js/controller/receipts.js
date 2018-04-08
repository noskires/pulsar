(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .controller('ReceiptsCtrl', ReceiptsCtrl)

        ReceiptsCtrl.$inject = ['$stateParams', 'ReceiptSrvcs', 'RequisitionsSrvcs', 'AssetsSrvcs', 'JobOrdersSrvcs', '$window', '$uibModal'];
        function ReceiptsCtrl($stateParams, ReceiptSrvcs, RequisitionsSrvcs, AssetsSrvcs, JobOrdersSrvcs, $window, $uibModal){
            var vm = this;
            var data = {};

            vm.newReceipt = function(data){
                // console.log(data);
                ReceiptSrvcs.save(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);
                        vm.routeTo('receipt/new');
                    }
                    else {
                        alert(response.data.message);
                    }
                    console.log(response.data);
                });
            };

            vm.routeTo = function(route){
                $window.location.href = route;
            }; 
        }
})();