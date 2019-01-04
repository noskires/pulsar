(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .controller('FundsCtrl', FundsCtrl)
        .controller('FundsModalInstanceCtrl', FundsModalInstanceCtrl)

        FundsCtrl.$inject = ['$stateParams', 'SuppliersSrvcs', 'ParticularsSrvcs', 'FundsSrvcs',  '$window', '$uibModal'];
        function FundsCtrl($stateParams, SuppliersSrvcs, ParticularsSrvcs, FundsSrvcs, $window, $uibModal){
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
                            controller:'FundsModalInstanceCtrl',
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

                var modalInstance = $uibModal.open({
                    controller:'FundsModalInstanceCtrl',
                    templateUrl:'fundNew.modal',
                    controllerAs: 'vm',
                    resolve :{
                        formData: function () {
                            return {
                                title:'Fund Controller',
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

        FundsModalInstanceCtrl.$inject = ['$uibModalInstance', '$state', 'formData', 'SuppliersSrvcs', 'FundsSrvcs', 'ParticularsSrvcs'];
        function FundsModalInstanceCtrl ($uibModalInstance, $state, formData, SuppliersSrvcs, FundsSrvcs, ParticularsSrvcs) {

            var vm = this;
            vm.formData = formData.fund;
            console.log(vm.formData)

            vm.fundDetails = [
            {
                'fund_code':vm.formData.fund_code,
                'particular_code':'',
                'fund_item_amount':''
            }];

            ParticularsSrvcs.particulars({particularCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.particulars = response.data.data;
                    console.log(vm.particulars)
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
                                console.log(vm.totalFundItems)
                            }
                        }, function (){ alert('Bad Request!!!') })
                    }
                }, function (){ alert('Bad Request!!!') })
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
})();