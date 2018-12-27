(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .controller('SuppliersCtrl', SuppliersCtrl)
        .controller('SuppliersCtrlModalInstanceCtrl', SuppliersCtrlModalInstanceCtrl)

        SuppliersCtrl.$inject = ['$stateParams', 'SuppliersSrvcs', '$window', '$uibModal'];
        function SuppliersCtrl($stateParams, SuppliersSrvcs, $window, $uibModal){
            var vm = this;
            var data = {};

            SuppliersSrvcs.suppliers({supplierCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.suppliers = response.data.data;
                    console.log(vm.suppliers)
                }
            }, function (){ alert('Bad Request!!!') })

            if($stateParams.supplierCode)
            {
                vm.supplierCode = $stateParams.supplierCode;
 

                SuppliersSrvcs.suppliers({supplierCode:vm.supplierCode}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.supplier = response.data.data[0];

                        var modalInstance = $uibModal.open({
                            controller:'SuppliersCtrlModalInstanceCtrl',
                            templateUrl:'supplierEdit.modal',
                            controllerAs: 'vm',
                            resolve :{
                              formData: function () {
                                return {
                                    title:'Supply Category Controller',
                                    message:response.data.message,
                                    supplier: vm.supplier
                                };
                              }
                            }
                        });
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            if($stateParams.supplierRequest == "new")
            {

                var modalInstance = $uibModal.open({
                    controller:'SuppliersCtrlModalInstanceCtrl',
                    templateUrl:'supplierNew.modal',
                    controllerAs: 'vm',
                    resolve :{
                        formData: function () {
                            return {
                                title:'Supplier Controller',
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

        SuppliersCtrlModalInstanceCtrl.$inject = ['$uibModalInstance', '$state', 'formData', 'SuppliersSrvcs'];
        function SuppliersCtrlModalInstanceCtrl ($uibModalInstance, $state, formData, SuppliersSrvcs) {

            var vm = this;
            vm.formData = formData.supplier;
            console.log(vm.formData)
     
            vm.newSupplier =  function(data){
 
                console.log(data)

                SuppliersSrvcs.save(data).then(function(response){

                    // console.log(response.data)
                    if (response.data.status == 200) {
                        alert(response.data.message);

                        $state.go('list-suppliers', { supplierCode:''});
                        vm.ok();
                    }
                    else {
                        alert(response.data.message);
                        console.log(response.data);
                    }
                }, function (){ console.log(response.data); alert('Bad Request!!!') });
            }

            vm.updateSupplier =  function(data){
                console.log(data)

                SuppliersSrvcs.update(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);

                        $state.go('list-suppliers', { supplierCode:''});
                        vm.ok();
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