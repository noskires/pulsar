(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .controller('AssetsCtrl', AssetsCtrl)
        .factory('AssetsSrvcs',AssetsSrvcs)

        AssetsCtrl.$inject = ['AssetsSrvcs', '$window'];
        function AssetsCtrl(AssetsSrvcs, $window){
            var vm = this;
            var data = {};
            //asset categories
            AssetsSrvcs.asset_categories().then (function (response) {
                if(response.data.status == 200)
                {
                    vm.asset_categories = response.data.data;
                    console.log(vm.asset_categories)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.submit = function(data){ 
                AssetsSrvcs.save(data).then(function(response){
                    if (response.data.status == 200) {
                		console.log(data);
                    	alert('saved');
                    	vm.routeTo('asset/create');
                    }
                });
            };

            vm.routeTo = function(route){
                $window.location.href = route;
            };
        }

        AssetsSrvcs.$inject = ['$http'];
        function AssetsSrvcs($http) {
            return {
            	assets: function() {
                    return $http({
                        method: 'GET',
                        // data: data,
                        url: '/api/v1/assets',
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                asset_categories: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: '/api/v1/assets/asset-categories',
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                save: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/api/v1/assets/save',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                }
            };
        }
})();