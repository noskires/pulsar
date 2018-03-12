(function(){
    'use strict';
    angular
        // .module('pulsarApp',[])
        .module('pulsarApp',['ui.router', 'ngSanitize'])
        .config(Config)
        .controller('headerCtrl', headerCtrl)

        Config.$inject = ['$stateProvider', '$urlRouterProvider', '$locationProvider', '$controllerProvider', '$compileProvider', '$filterProvider', '$provide', '$interpolateProvider']
        function Config($stateProvider, $urlRouterProvider, $locationProvider, $controllerProvider, $compileProvider, $filterProvider, $provide, $interpolateProvider){
            console.log("eApp here!");
            $interpolateProvider.startSymbol('<%');
            $interpolateProvider.endSymbol('%>');
            
            $locationProvider.html5Mode(true);

            $stateProvider
            .state('main-view', {
                url: '/index',
                // controller: 'OperationCtrl as oc',
                templateUrl: 'main.view'
            })
            .state('operation-view', {
                url: '/maintenance/operation',
                controller: 'OperationCtrl as oc',
                templateUrl: 'operation.view'
            })
            .state('list-operating-view', {
                url: '/maintenance/list-operating',
                controller: 'ListOperatingCtrl as loc',
                templateUrl: 'list.operating.view'
            })
            .state('list-monitoring-view', {
                url: '/maintenance/list-monitoring',
                // controller: 'mainController as mc',
                templateUrl: 'list.monitoring.view'
            })
            .state('asset-create-view', {
                url: '/asset/create',
                controller: 'AssetsCtrl as ac',
                templateUrl: 'asset.create.view'
            })

            $urlRouterProvider.otherwise('/index');
        }

        headerCtrl.$inject = ['$window','$http'];
        function headerCtrl($window, $http) {
            var vm = this;
            vm.routeTo = function(route, enableLogging){
                $window.location.href = route;
            };
        };
})();