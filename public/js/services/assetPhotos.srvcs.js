(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .factory('AssetPhotosSrvcs', AssetPhotosSrvcs)

        AssetPhotosSrvcs.$inject = ['$http'];
        function AssetPhotosSrvcs($http) {
            return {
            	assetPhotos: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: 'api/v1/assets-photos?assetCode='+data.assetCode+'&name='+data.name+'&status='+data.status,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
            };
        }
})();