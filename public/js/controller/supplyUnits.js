(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .controller('SupplyUnitsCtrl', SupplyUnitsCtrl)
        .controller('SupplyUnitModalInstanceCtrl', SupplyUnitModalInstanceCtrl)

        SupplyUnitsCtrl.$inject = ['$stateParams', 'SupplyUnitsSrvcs', '$window', '$uibModal'];
        function SupplyUnitsCtrl($stateParams, SupplyUnitsSrvcs, $window, $uibModal){
            var vm = this;
            var data = {};

            SupplyUnitsSrvcs.supplyUnits({supplyUnitCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.supplyUnits = response.data.data;
                    console.log(vm.supplyUnits)
                }
            }, function (){ alert('Bad Request!!!') })

            if($stateParams.supplyUnitCode)
            {
                vm.supplyUnitCode = $stateParams.supplyUnitCode;

                SupplyUnitsSrvcs.supplyUnits({supplyUnitCode:vm.supplyUnitCode}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.supplyUnit = response.data.data[0];

                        var modalInstance = $uibModal.open({
                            controller:'SupplyUnitModalInstanceCtrl',
                            templateUrl:'supplyUnitEdit.modal',
                            controllerAs: 'vm',
                            backdrop: 'static',
                            keyboard: false,
                            resolve :{
                              formData: function () {
                                return {
                                    title:'Supply Unit Controller',
                                    message:response.data.message,
                                    supplyUnit: vm.supplyUnit
                                };
                              }
                            }
                        });
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            if($stateParams.supplyUnitRequest == "new")
            {

                var modalInstance = $uibModal.open({
                    controller:'SupplyUnitModalInstanceCtrl',
                    templateUrl:'supplyUnitNew.modal',
                    controllerAs: 'vm',
                    backdrop: 'static',
                    keyboard: false,
                    resolve :{
                        formData: function () {
                            return {
                                title:'Supply Unit Controller',
                                message:''
                            };
                        }
                    },
                    // size: 'lg'
                });
            }

            vm.routeTo = function(route){
                $window.location.href = route;
            }; 
        }

        SupplyUnitModalInstanceCtrl.$inject = ['$uibModalInstance', '$state', 'formData', 'SupplyUnitsSrvcs'];
        function SupplyUnitModalInstanceCtrl ($uibModalInstance, $state, formData, SupplyUnitsSrvcs) {

            var vm = this;
            vm.formData = formData.supplyUnit;
            console.log(vm.formData)
        

            vm.newSupplyUnit =  function(data){
                console.log(data)

                SupplyUnitsSrvcs.save(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);
                        $state.go('list-supply-unit', { supplyUnitCode:''});
                        vm.ok();
                    }
                    else {
                        alert(response.data.message);
                        console.log(response.data);
                    }
                }, function (){ console.log(response.data); alert('Bad Request!!!') });
            }

            vm.updateSupplyUnit =  function(data){

                data['supplyUnitCode'] = vm.formData.stock_unit_code;
                console.log(data)
                SupplyUnitsSrvcs.update(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);
                        vm.ok();
                        $state.go('list-supply-unit', { supplyUnitCode:''});
                    }
                    else {
                        alert(response.data.message);
                        console.log(response.data);
                    }
                }, function (){ console.log(response.data); alert('Bad Request!!!') });
            }

            vm.ok = function() {
                $uibModalInstance.close();
            };
            
            vm.routeTo = function(route){
                $window.location.href = route;
            };

            vm.printSupplyDetails = function(tag){
                vm.url = 'supply/report/'+tag;
            }
        }
})();