(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .controller('SubConsCtrl', SubConsCtrl)
        .controller('SubConsModalInstanceCtrl', SubConsModalInstanceCtrl)
        .controller('SubConsItemsModalInstanceCtrl', SubConsItemsModalInstanceCtrl)

        SubConsCtrl.$inject = ['$stateParams', 'SuppliersSrvcs', 'ParticularsSrvcs', 'FundsSrvcs',  '$window', '$uibModal'];
        function SubConsCtrl($stateParams, SuppliersSrvcs, ParticularsSrvcs, FundsSrvcs, $window, $uibModal){
            var vm = this;
            var data = {};

            FundsSrvcs.funds({fundCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.funds = response.data.data;
                    console.log(vm.funds)
                }
            }, function (){ alert('Bad Request!!!') })

            if($stateParams.fundCode)
            {
                vm.fundCode = $stateParams.fundCode;
 
                FundsSrvcs.funds({fundCode:vm.fundCode}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.fund = response.data.data[0];

                        var modalInstance = $uibModal.open({
                            controller:'FundItemsModalInstanceCtrl',
                            templateUrl:'fundInfo.modal',
                            controllerAs: 'vm',
                            resolve :{
                              formData: function () {
                                return {
                                    title:'Fund Controller',
                                    message:response.data.message,
                                    fund: vm.fund
                                };
                              }
                            },
                            size: 'xlg'
                        });
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            if($stateParams.fundCode2)
            {
                vm.fundCode2 = $stateParams.fundCode2;
                alert(vm.fundCode2);

                FundsSrvcs.funds({fundCode:vm.fundCode2}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.fund = response.data.data[0];

                        var modalInstance = $uibModal.open({
                            controller:'FundsModalInstanceCtrl',
                            templateUrl:'fundEdit.modal',
                            controllerAs: 'vm',
                            resolve :{
                              formData: function () {
                                return {
                                    title:'Fund Controller',
                                    message:response.data.message,
                                    fund: vm.fund
                                };
                              }
                            }
                        });
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            if($stateParams.fundRequest == "new")
            {
                vm.fund_code = 0;
                var modalInstance = $uibModal.open({
                    controller:'FundsModalInstanceCtrl',
                    templateUrl:'fundNew.modal',
                    controllerAs: 'vm',
                    resolve :{
                        formData: function () {
                            return {
                                title:'Fund Controller',
                                message:'',
                                fund: vm.fund_code
                            };
                        }
                    },
                    // size: 'lg'
                });
            }

            FundsSrvcs.fundItems({fundCode:'', fundItemCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.fundItems = response.data.data;
                    vm.totalFundItems = response.data.totalFundItems;
                    console.log(vm.fundItems)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.routeTo = function(route){
                $window.location.href = route;
            }; 
        }

        FundsModalInstanceCtrl.$inject = ['$uibModalInstance', '$state', 'formData', 'SuppliersSrvcs', 'FundsSrvcs', 'ParticularsSrvcs', 'SupplyCategoriesSrvcs', 'OrganizationsSrvcs', 'ProjectsSrvcs'];
        function FundsModalInstanceCtrl ($uibModalInstance, $state, formData, SuppliersSrvcs, FundsSrvcs, ParticularsSrvcs, SupplyCategoriesSrvcs, OrganizationsSrvcs, ProjectsSrvcs) {

            var vm = this;
            vm.formData = formData.fund;
            console.log(vm.formData)


            // ParticularsSrvcs.particulars({particularCode:''}).then (function (response) {
            //     if(response.data.status == 200)
            //     {
            //         vm.particulars = response.data.data;
            //         console.log(vm.particulars)
            //     }
            // }, function (){ alert('Bad Request!!!') })

            OrganizationsSrvcs.organizations({orgCode:'', nextOrgCode:'', orgType:'', startDate:'', endDate:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.organizations = response.data.data;
                    console.log(vm.organizations)
                }
            }, function (){ alert('Bad Request!!!') })

            ProjectsSrvcs.projects({projectCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.projects = response.data.data;
                    console.log(vm.projects)
                }
            }, function (){ alert('Bad Request!!!') })

            SupplyCategoriesSrvcs.SupplyCategories({supplyCategoryCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.supplyCategories = response.data.data;
                    console.log(vm.supplyCategories)
                }
            }, function (){ alert('Bad Request!!!') })
            
            FundsSrvcs.fundItems({fundCode:vm.formData.fund_code, fundItemCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.fundItems = response.data.data;
                    vm.totalFundItems = response.data.totalFundItems;
                    console.log(vm.fundItems)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.newFund =  function(data){
 
                console.log(data)

                FundsSrvcs.save(data).then(function(response){

                    // console.log(response.data)
                    if (response.data.status == 200) {
                        alert(response.data.message);

                        FundsSrvcs.funds({fundCode:''}).then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.funds = response.data.data;
                                console.log(vm.funds)
                            }
                        }, function (){ alert('Bad Request!!!') })

                        $state.go('list-fund', { fundCode:''});
                        vm.ok();
                    }
                    else {
                        alert(response.data.message);
                        console.log(response.data);
                    }
                }, function (){ console.log(response.data); alert('Bad Request!!!') });
            }

            vm.updateFund =  function(data){
                console.log(data)

                FundsSrvcs.update(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);


                        FundsSrvcs.funds({fundCode:''}).then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.funds = response.data.data;
                                console.log(vm.funds)
                            }
                        }, function (){ alert('Bad Request!!!') })

                        $state.go('list-fund', { fundCode:''});
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

            // vm.printSupplyDetails = function(tag){
            //     vm.url = 'supply/report/'+tag;
            // }
        }

        FundItemsModalInstanceCtrl.$inject = ['$uibModalInstance', '$state', 'formData', 'SuppliersSrvcs', 'FundsSrvcs', 'ParticularsSrvcs', 'SupplyCategoriesSrvcs', 'OrganizationsSrvcs', 'ProjectsSrvcs'];
        function FundItemsModalInstanceCtrl ($uibModalInstance, $state, formData, SuppliersSrvcs, FundsSrvcs, ParticularsSrvcs, SupplyCategoriesSrvcs, OrganizationsSrvcs, ProjectsSrvcs) {

            var vm = this;
            vm.formData = formData.fund;
            console.log(vm.formData)

            vm.fundDetails = [
            {
                'fund_code':vm.formData.fund_code,
                'particular_code':'',
                'fund_item_amount':''
            }];

            // ParticularsSrvcs.particulars({particularCode:''}).then (function (response) {
            //     if(response.data.status == 200)
            //     {
            //         vm.particulars = response.data.data;
            //         console.log(vm.particulars)
            //     }
            // }, function (){ alert('Bad Request!!!') })

            OrganizationsSrvcs.organizations({orgCode:'', nextOrgCode:'', orgType:'', startDate:'', endDate:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.organizations = response.data.data;
                    console.log(vm.organizations)
                }
            }, function (){ alert('Bad Request!!!') })

            ProjectsSrvcs.projects({projectCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.projects = response.data.data;
                    console.log(vm.projects)
                }
            }, function (){ alert('Bad Request!!!') })

            SupplyCategoriesSrvcs.SupplyCategories({supplyCategoryCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.supplyCategories = response.data.data;
                    console.log(vm.supplyCategories)
                }
            }, function (){ alert('Bad Request!!!') })
            

            FundsSrvcs.fundItems({fundCode:vm.formData.fund_code, fundItemCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.fundItems = response.data.data;
                    vm.totalFundItems = response.data.totalFundItems;
                    console.log(vm.fundItems)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.addFundItems = function(data){
                console.log(data)

                FundsSrvcs.saveFundItems(data).then (function (response) {
                    console.log(response.data)
                    if(response.data.status == 200)
                    {
                        alert(response.data.message);
                        vm.fundDetails = [
                        {
                            'fund_code':vm.formData.fund_code,
                            'particular_code':'',
                            'fund_item_amount':''
                        }];

                        vm.supplyGrandTotal = 0;

                        FundsSrvcs.fundItems({fundCode:vm.formData.fund_code, fundItemCode:''}).then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.fundItems = response.data.data;
                                vm.totalFundItems = response.data.totalFundItems;
                                console.log(vm.fundItems)
                            }
                        }, function (){ alert('Bad Request!!!') })
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            vm.ok = function() {
                $uibModalInstance.close();
            };
        }
})();