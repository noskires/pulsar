(function(){
    'use strict';
    angular
        // .module('pulsarApp',[])
        .module('pulsarApp',['ui.router', 'ngSanitize'])
        .config(Config)
        .controller('MainCtrl', MainCtrl)

        Config.$inject = ['$stateProvider', '$urlRouterProvider', '$locationProvider', '$controllerProvider', '$compileProvider', '$filterProvider', '$provide', '$interpolateProvider']
        function Config($stateProvider, $urlRouterProvider, $locationProvider, $controllerProvider, $compileProvider, $filterProvider, $provide, $interpolateProvider){
            console.log("eApp here!");
            $interpolateProvider.startSymbol('<%');
            $interpolateProvider.endSymbol('%>');
            
            $locationProvider.html5Mode(true);

            var main = {
                url: '/index',
                // controller: 'OperationCtrl as oc',
                templateUrl: 'main.view'
            };
            
            $stateProvider
            .state('main-view', main)
            .state('operation', {
                url: '/maintenance/operation',
                controller: 'OperationCtrl as oc',
                templateUrl: 'operation.view'
            })
            .state('list-operating', {
                url: '/maintenance/list-operating',
                controller: 'ListOperatingCtrl as loc',
                templateUrl: 'list.operating.view'
            })
            .state('list-monitoring', {
                url: '/maintenance/list-monitoring',
                // controller: 'mainController as mc',
                templateUrl: 'list.monitoring.view'
            })
            .state('asset-create', {
                url: '/asset/create',
                controller: 'AssetsCtrl as ac',
                templateUrl: 'asset.create.view'
            })
            .state('asset-list-equipments', {
                url: '/asset/list-equipments/:assetTag',
                controller: 'AssetsCtrl as ac',
                templateUrl: 'asset.list.equipments.view'
            })
            .state('asset-list-equipments.asset', {
                url: '/:assetTag',
                controller: 'AssetsCtrl as ac',
                // templateUrl: 'asset.list.equipments.view'
            })
            //Projects//
            .state('project-create', {
                url: '/project/new',
                controller: 'ProjectsCtrl as pc',
                templateUrl: 'project.create.view'
            })
            .state('list-projects', {
                url: '/projects/list',
                controller: 'ProjectsCtrl as pc',
                templateUrl: 'project.list.projects.view'
            })
            //Projects//
            .state('jo-create', {
                url: '/job-order/new',
                controller: 'JobOrdersCtrl as joc',
                templateUrl: 'jo.create.view'
            })
            .state('list-jo', {
                url: '/job-order/list',
                controller: 'JobOrdersCtrl as joc',
                templateUrl: 'jo.list.view'
            })

            //sample//
            .state('sample-state', {
                url: '/asset/sample_state_url',
                // controller: 'JobOrdersCtrl as joc',
                templateUrl: 'sample.state'
            })
            //sample//
            .state('sample-state.child-state', {
                url: '/:id',
                // controller: 'JobOrdersCtrl as joc',
                templateUrl: 'sample.state.child'
            })

            $urlRouterProvider.otherwise('/index');
        }

        MainCtrl.$inject = ['$window','$http'];
        function MainCtrl($window, $http) {
            var vm = this;
            vm.routeTo = function(route){
                $window.location.href = route;
            };
        };
})();