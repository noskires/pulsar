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
                        url: '/api/v1/assets-photos?tag='+data.tag+'&name='+data.name+'&status='+data.status,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
            };
        }
})();