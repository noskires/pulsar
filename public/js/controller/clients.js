(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .controller('ClientsCtrl', ClientsCtrl)
        .controller('ClientsModalInstanceCtrl', ClientsModalInstanceCtrl)

        ClientsCtrl.$inject = ['$stateParams', 'ClientsSrvcs', 'ParticularsSrvcs', '$window', '$uibModal'];
        function ClientsCtrl($stateParams, ClientsSrvcs, ParticularsSrvcs, $window, $uibModal){
            var vm = this;
            var data = {};

            ClientsSrvcs.clients({clientCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.clients = response.data.data;
                    console.log(vm.clients)
                }
            }, function (){ alert('Bad Request!!!') })

            if($stateParams.clientCode)
            {
                vm.clientCode = $stateParams.clientCode;
 
                ClientsSrvcs.clients({clientCode:vm.clientCode}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.client = response.data.data[0];

                        var modalInstance = $uibModal.open({
                            controller:'ClientsModalInstanceCtrl',
                            templateUrl:'ClientEdit.modal',
                            controllerAs: 'vm',
                            resolve :{
                              formData: function () {
                                return {
                                    title:'CLient Controller',
                                    message:response.data.message,
                                    client: vm.client
                                };
                              }
                            }
                        });
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            if($stateParams.clientRequest == "new")
            {

                var modalInstance = $uibModal.open({
                    controller:'ClientsModalInstanceCtrl',
                    templateUrl:'clientNew.modal',
                    controllerAs: 'vm',
                    resolve :{
                        formData: function () {
                            return {
                                title:'Client Controller',
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

        ClientsModalInstanceCtrl.$inject = ['$uibModalInstance', '$state', 'formData', 'ClientsSrvcs', 'ParticularsSrvcs'];
        function ClientsModalInstanceCtrl ($uibModalInstance, $state, formData, ClientsSrvcs, ParticularsSrvcs) {

            var vm = this;
            vm.formData = formData.client;
            console.log(vm.formData)
     
            vm.newClient =  function(data){
 
                console.log(data)

                ClientsSrvcs.save(data).then(function(response){

                    // console.log(response.data)
                    if (response.data.status == 200) {
                        alert(response.data.message);

                        ClientsSrvcs.clients({clientCode:''}).then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.clients = response.data.data;
                                console.log(vm.clients)
                            }
                        }, function (){ alert('Bad Request!!!') })

                        $state.go('list-client', { clientCode:''});
                        vm.ok();
                    }
                    else {
                        alert(response.data.message);
                        console.log(response.data);
                    }
                }, function (){ console.log(response.data); alert('Bad Request!!!') });
            }

            vm.updateClient =  function(data){
                console.log(data)

                ClientsSrvcs.update(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);


                        ClientsSrvcs.clients({clientCode:''}).then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.clients = response.data.data;
                                console.log(vm.clients)
                            }
                        }, function (){ alert('Bad Request!!!') })

                        $state.go('list-client', { clientCode:''});
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