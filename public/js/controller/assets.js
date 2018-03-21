(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .controller('AssetsCtrl', AssetsCtrl) 
        .controller('AssetsCtrlCopy', AssetsCtrlCopy) 
 		
 		AssetsCtrl.$inject = ['$stateParams', 'AssetsSrvcs', 'EmployeesSrvcs', 'OrganizationsSrvcs', '$window'];
        function AssetsCtrl($stateParams, AssetsSrvcs, EmployeesSrvcs, OrganizationsSrvcs, $window){
            var vm = this;
            var data = {};

           console.log($stateParams);

            AssetsSrvcs.assets({tag:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.assets = response.data.data;
                    // console.log(vm.assets)
                }
            }, function (){ alert('Bad Request!!!') })

            AssetsSrvcs.asset_categories().then (function (response) {
                if(response.data.status == 200)
                {
                    vm.asset_categories = response.data.data;
                    console.log(vm.asset_categories)
                }
            }, function (){ alert('Bad Request!!!') })

            AssetsSrvcs.asset_methods().then (function (response) {
                if(response.data.status == 200)
                {
                    vm.methods = response.data.data;
                    console.log(vm.methods)
                }
            }, function (){ alert('Bad Request!!!') })



            vm.submit = function(data){
                AssetsSrvcs.save(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);
                        vm.routeTo('asset/create');
                    }
                    else {
                        alert(response.data.message);
                        // vm.routeTo('asset/create');
                    }
                });
            };

            vm.assetTag = function(data){
                // console.log(asset);
                // vm.tag = '';
                // vm.d = new Date(asset.dateAcquired);

                AssetsSrvcs.asset_tag(data).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.asset_tag = response.data.data;
                        console.log(response.data)
                    }
                }, function (){ alert('Bad Request!!!') })

                // console.log(vm.d);
                // var year = vm.d.getFullYear();
                // var month = vm.d.getMonth()+1;
                // var day = vm.d.getDate();
                // var fullDate = year+''+month+''+day;

                // if(!asset.categoryCode){ asset.categoryCode = ""; } else { vm.tag += asset.categoryCode }
                // if(!asset.dateAcquired){ asset.dateAcquired = ""; } else { vm.tag += "-"+fullDate}
                // if(!asset.assetID){ asset.assetID = ""; } else { vm.tag += "-"+asset.assetID }
            }

            vm.assetInfo = function(tag){
                AssetsSrvcs.assets({tag:tag}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.asset = response.data.data[0];
                        console.log(vm.asset)
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            //employee services
            EmployeesSrvcs.employees({jobType:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.employees = response.data.data;
                    console.log(vm.employees)
                }
            }, function (){ alert('Bad Request!!!') })

            //organizations services
            OrganizationsSrvcs.organizations().then (function (response) {
                if(response.data.status == 200)
                {
                    vm.organizations = response.data.data;
                    console.log(vm.organizations)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.routeTo = function(route){
                $window.location.href = route;
            };
        }

        AssetsCtrlCopy.$inject = ['$stateParams', 'AssetsSrvcs', 'EmployeesSrvcs', 'OrganizationsSrvcs', '$window'];
        function AssetsCtrlCopy($stateParams, AssetsSrvcs, EmployeesSrvcs, OrganizationsSrvcs, $window){
            var vm = this;
            var data = {};
            alert('asset copu');
        };
})();