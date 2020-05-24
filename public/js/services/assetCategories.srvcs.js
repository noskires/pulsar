(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .factory('AssetCategoriesSrvcs', AssetCategoriesSrvcs)

        AssetCategoriesSrvcs.$inject = ['$http'];
        function AssetCategoriesSrvcs($http) {
            return {
            	AssetCategories: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: 'api/v1/asset-categories?assetCategoryCode='+data.assetCategoryCode,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                save: function(data) {
                    return $http({
                        method: 'POST',
                        url: 'api/v1/asset-category/save',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                update: function(data) {
                    return $http({
                        method: 'POST',
                        url: 'api/v1/asset-category/update',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
            };
        }
})();