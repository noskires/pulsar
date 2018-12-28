(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .controller('ParticularsCtrl', ParticularsCtrl)
        .controller('ParticularsModalInstanceCtrl', ParticularsModalInstanceCtrl)

        ParticularsCtrl.$inject = ['$stateParams', 'SuppliersSrvcs', 'ParticularsSrvcs', '$window', '$uibModal'];
        function ParticularsCtrl($stateParams, SuppliersSrvcs, ParticularsSrvcs, $window, $uibModal){
            var vm = this;
            var data = {};

            ParticularsSrvcs.particulars({particularCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.particulars = response.data.data;
                    console.log(vm.particulars)
                }
            }, function (){ alert('Bad Request!!!') })

            if($stateParams.particularCode)
            {
                vm.particularCode = $stateParams.particularCode;
 
                ParticularsSrvcs.particulars({particularCode:vm.particularCode}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.particular = response.data.data[0];

                        var modalInstance = $uibModal.open({
                            controller:'ParticularsModalInstanceCtrl',
                            templateUrl:'ParticularEdit.modal',
                            controllerAs: 'vm',
                            resolve :{
                              formData: function () {
                                return {
                                    title:'Particular Category Controller',
                                    message:response.data.message,
                                    particular: vm.particular
                                };
                              }
                            }
                        });
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            if($stateParams.particularRequest == "new")
            {

                var modalInstance = $uibModal.open({
                    controller:'ParticularsModalInstanceCtrl',
                    templateUrl:'particularNew.modal',
                    controllerAs: 'vm',
                    resolve :{
                        formData: function () {
                            return {
                                title:'Particular Controller',
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

        ParticularsModalInstanceCtrl.$inject = ['$uibModalInstance', '$state', 'formData', 'SuppliersSrvcs', 'ParticularsSrvcs'];
        function ParticularsModalInstanceCtrl ($uibModalInstance, $state, formData, SuppliersSrvcs, ParticularsSrvcs) {

            var vm = this;
            vm.formData = formData.particular;
            console.log(vm.formData)
     
            vm.newParticular =  function(data){
 
                console.log(data)

                ParticularsSrvcs.save(data).then(function(response){

                    // console.log(response.data)
                    if (response.data.status == 200) {
                        alert(response.data.message);

                        ParticularsSrvcs.particulars({particularCode:''}).then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.particulars = response.data.data;
                                console.log(vm.particulars)
                            }
                        }, function (){ alert('Bad Request!!!') })

                        $state.go('list-particular', { particularCode:''});
                        vm.ok();
                    }
                    else {
                        alert(response.data.message);
                        console.log(response.data);
                    }
                }, function (){ console.log(response.data); alert('Bad Request!!!') });
            }

            vm.updateParticular =  function(data){
                console.log(data)

                ParticularsSrvcs.update(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);


                        ParticularsSrvcs.particulars({particularCode:''}).then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.particulars = response.data.data;
                                console.log(vm.particulars)
                            }
                        }, function (){ alert('Bad Request!!!') })

                        $state.go('list-particular', { particularCode:''});
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