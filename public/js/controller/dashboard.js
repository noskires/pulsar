(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .controller('DashboardCtrl', DashboardCtrl)

        DashboardCtrl.$inject = ['$stateParams', 'EmployeesSrvcs', 'SuppliesSrvcs', 'PurchaseOrdersSrvcs', 'ProjectsSrvcs', 'ReceiptSrvcs', 'StockUnitsSrvcs', 'RequisitionsSrvcs', 'AssetsSrvcs', 'JobOrdersSrvcs', '$window', '$uibModal', '$timeout'];
        function DashboardCtrl($stateParams, EmployeesSrvcs, SuppliesSrvcs, PurchaseOrdersSrvcs, ProjectsSrvcs, ReceiptSrvcs, StockUnitsSrvcs, RequisitionsSrvcs, AssetsSrvcs, JobOrdersSrvcs, $window, $uibModal, $timeout){
            var vm = this;
            var data = {};

            vm.loader_status = true;

            $timeout(
                function(){ vm.loader_status =false; }
            , 2500);


            // alert('dashboard')
            // SuppliesSrvcs.supplies({bankCode:''}).then (function (response) {
            //     if(response.data.status == 200)
            //     {
            //         vm.banks = response.data.data;
            //         console.log(vm.banks)
            //     }
            // }, function (){ alert('Bad Request!!!') })

            EmployeesSrvcs.employees2({
                employee_code: ''
            }).then(function (response) {
                if (response.data.status == 200) {
                    vm.employee = response.data.count;
                    console.log(vm.employee)
                }
            }, function () {
                alert('Bad Request!!!')
            })

            JobOrdersSrvcs.jobOrders({joCode:'', joStatus:1, date_started:'', assetCode:'', assetCategory:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.jobOrder = response.data.count;
                    console.log(vm.jobOrder)
                }
            }, function (){ alert('Bad Request!!!') })

            ProjectsSrvcs.projects({projectCode:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.project = response.data.count;
                    console.log(vm.project)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.purchaseDetails = {
                poCode:'', 
                referenceCode:'', 
                supplierCode:'', 
                poStatus:3, 
                dateFrom: '', 
                dateTo:''
            }

            PurchaseOrdersSrvcs.pos(vm.purchaseDetails).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.pos = response.data.count;
                    console.log(vm.pos)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.risDetails = {
                requisitionCode:'',
                requisitionStatus:'',
                dateRequested:'',
                requestType:''
            }

            RequisitionsSrvcs.requisitions(vm.risDetails).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.requisition = response.data.count;
                    console.log(vm.requisition)

                }
            }, function (){ alert('Bad Request!!!') })

            vm.assetsDetails = {
                assetCode: '',
                name: '',
                category: '',
                areCode: '',
                status: '',
                isAll: 0,
                withActiveAre: 2 // 2 means shall all records 
            }

            AssetsSrvcs.assets(vm.assetsDetails).then(function (response) {
                if (response.data.status == 200) {
                    vm.asset = response.data.count;
                    console.log(vm.asset)
                }
            }, function () { alert('Bad Request!!!') })

        }
})();