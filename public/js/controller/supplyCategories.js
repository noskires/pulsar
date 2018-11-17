(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .controller('SupplyCategoriesCtrl', SupplyCategoriesCtrl)
        .controller('SupplyCategoryModalInstanceCtrl', SupplyCategoryModalInstanceCtrl)

        SupplyCategoriesCtrl.$inject = ['$stateParams', 'SupplyCategoriesSrvcs', '$window', '$uibModal'];
        function SupplyCategoriesCtrl($stateParams, SupplyCategoriesSrvcs, $window, $uibModal){
            var vm = this;
            var data = {};

            SupplyCategoriesSrvcs.SupplyCategories({supplyCategoryCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.supplyCategories = response.data.data;
                    console.log(vm.supplyCategories)
                }
            }, function (){ alert('Bad Request!!!') })

            if($stateParams.supplyCategoryCode)
            {
                vm.supplyCategoryCode = $stateParams.supplyCategoryCode;

                SupplyCategoriesSrvcs.SupplyCategories({supplyCategoryCode:vm.supplyCategoryCode}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.supplyCategory = response.data.data[0];

                        var modalInstance = $uibModal.open({
                            controller:'SupplyCategoryModalInstanceCtrl',
                            templateUrl:'supplyCategoryEdit.modal',
                            controllerAs: 'vm',
                            resolve :{
                              formData: function () {
                                return {
                                    title:'Supply Category Controller',
                                    message:response.data.message,
                                    supplyCategory: vm.supplyCategory
                                };
                              }
                            }
                        });
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            if($stateParams.supplyCategoryRequest == "new")
            {

                var modalInstance = $uibModal.open({
                    controller:'SupplyCategoryModalInstanceCtrl',
                    templateUrl:'supplyCategoryNew.modal',
                    controllerAs: 'vm',
                    resolve :{
                        formData: function () {
                            return {
                                title:'Supply Category Controller',
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

        SupplyCategoryModalInstanceCtrl.$inject = ['$uibModalInstance', '$state', 'formData', 'SupplyCategoriesSrvcs'];
        function SupplyCategoryModalInstanceCtrl ($uibModalInstance, $state, formData, SupplyCategoriesSrvcs) {

            var vm = this;
            vm.formData = formData.supplyCategory;
            console.log(vm.formData)
     
            vm.newSupplyCategory =  function(data){
 
                console.log(data)

                SupplyCategoriesSrvcs.save(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);

                        $state.go('list-supply-categories', { supplyCategoryCode:''});
                    }
                    else {
                        alert(response.data.message);
                        console.log(response.data);
                    }
                }, function (){ console.log(response.data); alert('Bad Request!!!') });
            }

            vm.updateSupplyCategory =  function(data){
                console.log(data)

                SupplyCategoriesSrvcs.update(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);

                        $state.go('list-supply-categories', { supplyCategoryCode:''});
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