(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .controller('AssetCategoriesCtrl', AssetCategoriesCtrl)
        .controller('AssetCategoryModalInstanceCtrl', AssetCategoryModalInstanceCtrl)

        AssetCategoriesCtrl.$inject = ['$stateParams', 'AssetCategoriesSrvcs', '$window', '$uibModal'];
        function AssetCategoriesCtrl($stateParams, AssetCategoriesSrvcs, $window, $uibModal){
            var vm = this;
            var data = {};

            AssetCategoriesSrvcs.AssetCategories({assetCategoryCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.assetCategories = response.data.data;
                    console.log(vm.assetCategories)
                }
            }, function (){ alert('Bad Request!!!') })

            if($stateParams.assetCategoryCode)
            {
                vm.assetCategoryCode = $stateParams.assetCategoryCode;

                AssetCategoriesSrvcs.AssetCategories({assetCategoryCode:vm.assetCategoryCode}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.assetCategory = response.data.data[0];

                        var modalInstance = $uibModal.open({
                            controller:'AssetCategoryModalInstanceCtrl',
                            templateUrl:'assetCategoryEdit.modal',
                            controllerAs: 'vm',
                            resolve :{
                              formData: function () {
                                return {
                                    title:'Asset Category Controller',
                                    message:response.data.message,
                                    assetCategory: vm.assetCategory
                                };
                              }
                            }
                        });
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            if($stateParams.assetCategoryRequest == "new")
            {
                var modalInstance = $uibModal.open({
                    controller:'AssetCategoryModalInstanceCtrl',
                    templateUrl:'assetCategoryNew.modal',
                    controllerAs: 'vm',
                    resolve :{
                        formData: function () {
                            return {
                                title:'Asset Category Controller',
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

        AssetCategoryModalInstanceCtrl.$inject = ['$uibModalInstance', '$state', 'formData', 'AssetCategoriesSrvcs'];
        function AssetCategoryModalInstanceCtrl ($uibModalInstance, $state, formData, AssetCategoriesSrvcs) {

            var vm = this;
            vm.formData = formData.assetCategory;
            console.log(vm.formData)
     
            vm.addAssetCategory =  function(data){
 
                console.log(data)

                AssetCategoriesSrvcs.save(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);

                        $state.go('list-asset-categories', { assetCategoryCode:''});

                        vm.ok();
                    }
                    else {
                        alert(response.data.message);
                        console.log(response.data);
                    }
                }, function (){ console.log(response.data); alert('Bad Request!!!') });
            }

            vm.updateAssetCategory =  function(data){
                console.log(data)

                AssetCategoriesSrvcs.update(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);

                        $state.go('list-asset-categories', { assetCategoryCode:''});

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