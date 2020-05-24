(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .factory('AssetsSrvcs', AssetsSrvcs)

        AssetsSrvcs.$inject = ['$http'];
        function AssetsSrvcs($http) {
            return {
            	assets: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: 'api/v1/assets?assetCode='+data.assetCode+'&name='+data.name+'&category='+data.category+'&areCode='+data.areCode+'&status='+data.status+'&isAll='+data.isAll+'&withActiveAre='+data.withActiveAre,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                assetEvents: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: 'api/v1/assetEvents?assetCode='+data.assetCode+'&name='+data.name+'&category='+data.category+'&areCode='+data.areCode+'&isAll='+data.isAll+'&assetEventCode='+data.assetEventCode,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                // asset_categories: function(data) {
                //     return $http({
                //         method: 'GET',
                //         data: data,
                //         url: 'api/v1/assets/asset-categories?assetCategory='+data.assetCategory,
                //         headers: {'Content-Type': 'application/json'}
                //     })
                // },
                asset_methods: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: 'api/v1/assets/methods',
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                asset_tag: function(data) {
                    return $http({
                        method: 'POST',
                        data: data,
                        url: 'api/v1/assets/asset-tag',
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                save: function(data) {
                    return $http({
                        method: 'POST',
                        url: 'api/v1/assets/save',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                saveAssetEvent: function(data) {
                    return $http({
                        method: 'POST',
                        url: 'api/v1/assets/saveAssetEvent',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                update: function(data) {
                    return $http({
                        method: 'POST',
                        url: 'api/v1/assets/update',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                updateAsset: function(data) {
                    return $http({
                        method: 'POST',
                        url: 'api/v1/assets/update-asset',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                exportAssets: function(data) {
                    return $http({
                        method: 'GET',
                        url: 'api/v1/export-assets',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                // getTag: function(data) {
                //     return $http({
                //         method: 'POST',
                //         url: 'api/v1/assets/save',
                //         data: data,
                //         headers: {'Content-Type': 'application/json'}
                //     })
                // }
            };
        }
})();