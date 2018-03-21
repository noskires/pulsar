(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .factory('AssetsSrvcs', AssetsSrvcs)

        AssetsSrvcs.$inject = ['$http'];
        function AssetsSrvcs($http) {
            return {
            	assets: function(data, tag) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: '/api/v1/assets?tag='+data.tag,
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
                asset_methods: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: '/api/v1/assets/methods',
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                asset_tag: function(data) {
                    return $http({
                        method: 'POST',
                        data: data,
                        url: '/api/v1/assets/asset-tag',
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
                },
                // getTag: function(data) {
                //     return $http({
                //         method: 'POST',
                //         url: '/api/v1/assets/save',
                //         data: data,
                //         headers: {'Content-Type': 'application/json'}
                //     })
                // }
            };
        }
})();