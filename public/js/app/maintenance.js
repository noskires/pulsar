(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .controller('OperationCtrl', OperationCtrl)
        .controller('ListOperatingCtrl', ListOperatingCtrl)
        // .controller('AnswerQuestionCtrl',AnswerQuestionCtrl)
        // .controller('ModalInfoInstanceCtrl',ModalInfoInstanceCtrl)
        // .controller('ModalRateInstanceCtrl',ModalRateInstanceCtrl)
        // .controller('ModalApprovalRemarksInstanceCtrl',ModalApprovalRemarksInstanceCtrl)
        .factory('MainSrvcs',MainSrvcs)

        OperationCtrl.$inject = ['MainSrvcs', '$window'];
        function OperationCtrl(MainSrvcs, $window){

            var vm = this;
            var data = {};

            alert('this is main controller')
            
            vm.routeTo = function(route){
                $window.location.href = route;
            }; 
        }

        ListOperatingCtrl.$inject = ['MainSrvcs', '$window'];
        function ListOperatingCtrl(MainSrvcs, $window){
            var vm = this;
            var data = {};

            vm.erik = "erikson supnet list";
            alert('this is list controller')
            
            vm.routeTo = function(route){
                $window.location.href = route;
            }; 
        }

        MainSrvcs.$inject = ['$http'];
        function MainSrvcs($http) {
            return {
            };
        }
})();