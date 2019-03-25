(function(){
    'use strict';
    angular
        // .module('pulsarApp',[])
        .module('pulsarApp',['ui.router', 'ngSanitize', 'ui.bootstrap', 'datatables', 'datatables.tabletools', 'datatables.buttons', 'datatables.bootstrap', 'dynamicNumber', 'ui.mask', 'ui.utils.masks', 'checklist-model'])
        .config(Config)
        .controller('MainCtrl', MainCtrl)
        // .directive('myDate', dateInput)
        .directive("datepicker", function() {
            return {
              restrict: "A",
                  require: "ngModel",
                  link: function(scope, elem, attrs, ngModelCtrl) {
                    elem.on("changeDate", updateModel);
                    function updateModel(event) {
                      ngModelCtrl.$setViewValue(event.date);
                    }
                    elem.datepicker({
                      autoclose: true,
                      endDate: '+0d',
                      // defaultDate: new Date()
                        format: "yyyy-mm-dd",
                        // format: "mm/dd/yyyy",
                        immediateUpdates: true,
                        todayBtn: true,
                        // todayHighlight: true
                    })
                    // .datepicker("setDate", "0");
                  }
            };
        })

        .directive("datepicker2", function() {
            return {
              restrict: "A",
                  require: "ngModel",
                  link: function(scope, elem, attrs, ngModelCtrl) {
                    elem.on("changeDate", updateModel);
                    function updateModel(event) {
                      ngModelCtrl.$setViewValue(event.date);
                    }
                    elem.datepicker({
                      autoclose: true
                    });
                  }
            };
        })

        // this is the important bit:
        .directive('datepickerPopup', function (){
          return {
            restrict: 'EAC',
            require: 'ngModel',
            link: function(scope, element, attr, controller) {
              //remove the default formatter from the input directive to prevent conflict
              controller.$formatters.shift();
            }
          }
        });

        

        dateInput.$inject = ["$filter", "$parse"];
          function dateInput($filter, $parse) {
            return {
              restrict: 'A',
              require: 'ngModel',
              replace: true,
              transclude: true,
              template: '<input ng-transclude ui-mask="19/39/2999" ui-mask-raw="false" ng-keypress="limitToValidDate($event)" placeholder="MM/DD/YYYY"/>',
              link: function(scope, element, attrs, controller) {
                scope.limitToValidDate = limitToValidDate;
                var dateFilter = $filter("date");
                var today = new Date();
                var date = {};

                function isValidMonth(month) {
                  return month >= 0 && month < 12;
                }

                function isValidDay(day) {
                  return day > 0 && day < 32;
                }

                function isValidYear(year) {
                  return year > (today.getFullYear() - 115) && year < (today.getFullYear() + 115);
                }

                function isValidDate(inputDate) {
                  inputDate = new Date(formatDate(inputDate));
                  if (!angular.isDate(inputDate)) {
                    return false;
                  }
                  date.month = inputDate.getMonth();
                  date.day = inputDate.getDate();
                  date.year = inputDate.getFullYear();
                  return (isValidMonth(date.month) && isValidDay(date.day) && isValidYear(date.year));
                }

                function formatDate(newDate) {
                  var modelDate = $parse(attrs.ngModel);
                  newDate = dateFilter(newDate, "MM/dd/yyyy");
                  modelDate.assign(scope, newDate);
                  return newDate;
                }

                controller.$validators.date = function(modelValue) {
                  return angular.isDefined(modelValue) && isValidDate(modelValue);
                };

                var pattern = "^(0[1-9]|1[012])(0[1-9]|[12][0-9]|3[01])(19|20)\\d\\d$" +
                  "|^(0[1-9]|1[012])(0[1-9]|[12][0-9]|3[01])(19|20)\\d$" +
                  "|^(0[1-9]|1[012])(0[1-9]|[12][0-9]|3[01])(19|20)$" +
                  "|^(0[1-9]|1[012])(0[1-9]|[12][0-9]|3[01])[12]$" +
                  "|^(0[1-9]|1[012])(0[1-9]|[12][0-9]|3[01])$" +
                  "|^(0[1-9]|1[012])([0-3])$" +
                  "|^(0[1-9]|1[012])$" +
                  "|^[01]$";
                var regexp = new RegExp(pattern);

                function limitToValidDate(event) {
                  var key = event.charCode ? event.charCode : event.keyCode;
                  if ((key >= 48 && key <= 57) || key === 9 || key === 46) {
                    var character = String.fromCharCode(event.which);
                    var start = element[0].selectionStart;
                    var end = element[0].selectionEnd;
                    var testValue = (element.val().slice(0, start) + character + element.val().slice(end)).replace(/\s|\//g, "");
                    if (!(regexp.test(testValue))) {
                      event.preventDefault();
                    }
                  }
                }
              }
            }
          }

        Config.$inject = ['$stateProvider', '$urlRouterProvider', '$locationProvider', '$controllerProvider', '$compileProvider', '$filterProvider', '$provide', '$interpolateProvider', 'dynamicNumberStrategyProvider']
        function Config($stateProvider, $urlRouterProvider, $locationProvider, $controllerProvider, $compileProvider, $filterProvider, $provide, $interpolateProvider, dynamicNumberStrategyProvider){
            console.log("App here!");
            $interpolateProvider.startSymbol('<%');
            $interpolateProvider.endSymbol('%>');
            
            $locationProvider.html5Mode(true);

            var main = {
                url: '/index',
                // controller: 'OperationCtrl as oc',
                templateUrl: 'main.view'
            };

            dynamicNumberStrategyProvider.addStrategy('price', {
                numInt: 7,
                numFract: 2,
                numSep: '.',
                numPos: true,
                numNeg: true,
                numRound: 'round',
                numThousand: true
            });
            
            $stateProvider
            .state('main-view', main)

            .state('operation', {
                url: '/maintenance/operation',
                controller: 'OperationCtrl as oc',
                templateUrl: 'operation.view'
            })

            .state('operation-create', {
                url: '/maintenance/new',
                controller: 'OperationCtrl as oc',
                templateUrl: 'operation.create.view'
            })

            .state('list-operating', {
                url: '/maintenance/list-operating',
                controller: 'ListOperatingCtrl as loc',
                templateUrl: 'list.operating.view'
            })
            .state('list-monitoring', {
                url: '/maintenance/list-monitoring',
                controller: 'ListMonitoringCtrl as lmc',
                templateUrl: 'list.monitoring.view'
            })
            .state('asset-create', {
                url: '/asset/new',
                controller: 'AssetsAddCtrl as ac',
                templateUrl: 'asset.create.view'
            })
            .state('asset-list-equipments', {
                url: '/asset/list-equipments',
                controller: 'AssetsCtrl as ac',
                templateUrl: 'asset.list.equipments.view',
            })
            .state('asset-list-equipmentsCopy', {
                url: '/asset/list-equipments/:assetCode',
                controller: 'AssetsCtrl as ac',
                templateUrl: 'asset.list.equipments.view'
            })
            .state('asset-more-details', {
                url: '/asset/more-details/:assetCode',
                controller: 'AssetMoreDetailsCtrl as amdc',
                templateUrl: 'asset.more.details.view',
            })

            .state('asset-more-details4', {
                url: '/asset/more-details4/:assetCode',
                controller: 'AssetMoreDetailsCtrl as amdc',
                templateUrl: 'asset.more.details.view4',
            })

            //11-18-2018

            .state('asset-category-create', {
                url: '/asset-category/:assetCategoryRequest',
                controller: 'AssetCategoriesCtrl as acc',
                templateUrl: 'asset.category.list.view'
            })
            .state('list-asset-categories', {
                url: '/asset-categories/list',
                controller: 'AssetCategoriesCtrl as acc',
                templateUrl: 'asset.category.list.view'
            })
            .state('list-asset-categoriesCopy', {
                url: '/asset-category/list/:assetCategoryCode',
                controller: 'AssetCategoriesCtrl as acc',
                templateUrl: 'asset.category.list.view'
            })

            //11-18-2018

            // .state('asset-list-equipments.asset', {
            //     url: '/:assetTag',
            //     controller: 'AssetsCtrl as ac',
            //     // templateUrl: 'asset.list.equipments.view'
            // })

            // .state('asset', {
            //     url: '/project/new/:assetTag',
            //     controller: 'AssetsCtrl as ac',
            //     // templateUrl: 'asset.list.equipments.view'
            // })
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
            .state('list-projectsCopy', {
                url: '/projects/list/:projectCode',
                controller: 'ProjectsCtrl as pc',
                templateUrl: 'project.list.projects.view'
            })

            .state('project-profile', {
                url: '/project/profile/:projectCode',
                controller: 'ProjectProfileDetailsCtrl as projectProfileCtrl',
                templateUrl: 'project.profile.view'
            })

            .state('project-profile-copy', {
                url: '/project/profile/:projectCode/:actionType',
                controller: 'ProjectProfileDetailsCtrl as projectProfileCtrl',
                templateUrl: 'project.profile.view'
            })

            .state('project-profile-edit', {
                url: '/project/profile/:projectCode/edit',
                controller: 'ProjectProfileEditCtrl as projectProfileCtrl',
                templateUrl: 'project.profile.view'
            })


            //Projects//
            .state('jo-create', {
                url: '/job-order/new/:assetTag',
                controller: 'JobOrdersCtrl as joc',
                templateUrl: 'jo.create.view'
            })
            .state('list-jo', {
                url: '/job-order/list',
                controller: 'JobOrdersCtrl as joc',
                templateUrl: 'jo.list.view'
            })
            .state('list-joCopy', {
                url: '/job-order/list/:joCode',
                controller: 'JobOrdersCtrl as joc',
                templateUrl: 'jo.list.view'
            })

            //manual entry of jo


            .state('list-jo2', {
                url: '/job-order2/list',
                controller: 'JobOrdersCtrl as joc',
                templateUrl: 'jo2.list.view'
            })
            .state('list-joCopy2', {
                url: '/job-order2/list/:joCode2',
                controller: 'JobOrdersCtrl as joc',
                templateUrl: 'jo2.list.view'
            })


            // .state('list-jo.jo', {
            //     url: '/:joCode',
            //     controller: 'JobOrdersCtrl as joc'
            // })
            .state('requesition-asset-create', {
                url: '/requisition-issue-slip/asset/new/:jobOrderCode',
                controller: 'RequisitionAssetCtrl as rac',
                templateUrl: 'ris.create.asset.view'
            })

            .state('requesition-asset-create2', {
                url: '/requisition/asset/new/:jobOrderCode',
                controller: 'RequisitionAssetCtrl as rac',
                templateUrl: 'ris2.create.asset.view'
            })

            // .state('requesition-project-create', {
            //     url: '/requisition-issue-slip/project/new/:projectCode',
            //     controller: 'RequisitionProjectCtrl as rpc',
            //     templateUrl: 'ris.create.project.view'
            // })
            // .state('requesition-office-create', {
            //     url: '/requisition-issue-slip/office/new',
            //     controller: 'RequisitionOfficetCtrl as roc',
            //     templateUrl: 'ris.create.office.view'
            // })

            .state('list-requesition', {
                url: '/requisition/list',
                controller: 'RequisitionCtrl as rc',
                templateUrl: 'ris.list.view'
            })
            .state('list-requesitionCopy', {
                url: '/requisition/list/:requisitionSlipCode',
                controller: 'RequisitionCtrl as rc',
                templateUrl: 'ris.list.view'
            })

            .state('list-requesition2', {
                url: '/requisition2/list',
                controller: 'RequisitionOfficetCtrl as roc',
                templateUrl: 'ris2.list.view'
            })
            .state('list-requesitionCopy2', {
                url: '/requisition2/list/:requisitionSlipCode',
                controller: 'RequisitionOfficetCtrl as roc',
                templateUrl: 'ris2.list.view'
            })

            .state('list-employees', {
                url: '/employee/list',
                controller: 'EmployeesCtrl as ec',
                templateUrl: 'employee.list.view'
            })

            .state('receipt-create', {
                url: '/receipt/new',
                controller: 'ReceiptsCtrl as rc',
                templateUrl: 'receipt.create.view'
            })

            .state('list-receipt', {
                url: '/receipt/list',
                controller: 'ReceiptsCtrl as rc',
                templateUrl: 'receipt.list.view'
            })
            .state('list-receiptCopy', {
                url: '/receipt/list/:receiptCode',
                controller: 'ReceiptsCtrl as rc',
                templateUrl: 'receipt.list.view'
            })

            .state('list-receipt2', {
                url: '/receipt2/list',
                controller: 'ReceiptsCtrl as rc',
                templateUrl: 'receipt2.list.view'
            })

            .state('list-receiptCopy2', {
                url: '/receipt2/list/:receiptCode',
                controller: 'ReceiptsCtrl as rc',
                templateUrl: 'receipt2.list.view'
            })

            .state('supply-create', {
                url: '/supply/new',
                controller: 'SuppliesCtrl as sc',
                templateUrl: 'supply.create.view'
            })
            .state('list-supply', {
                url: '/supply/list',
                controller: 'SuppliesCtrl as sc',
                templateUrl: 'supply.list.view'
            })
            .state('list-supplyCopy', {
                url: '/supply/list/:supplyCode',
                controller: 'SuppliesCtrl as sc',
                templateUrl: 'supply.list.view'
            })
            .state('edit-supply', {
                url: '/supply/edit/:supplyCode2',
                controller: 'SuppliesCtrl as sc',
                templateUrl: 'supply.list.view'
            })

            .state('supply-category-create', {
                url: '/supply-category/:supplyCategoryRequest',
                controller: 'SupplyCategoriesCtrl as scc',
                templateUrl: 'supply.category.list.view'
            })
            .state('list-supply-categories', {
                url: '/supply-categories/list',
                controller: 'SupplyCategoriesCtrl as scc',
                templateUrl: 'supply.category.list.view'
            })
            .state('list-supply-categoriesCopy', {
                url: '/supply-category/list/:supplyCategoryCode',
                controller: 'SupplyCategoriesCtrl as scc',
                templateUrl: 'supply.category.list.view'
            })

            .state('supply-unit-create', {
                url: '/supply-unit/:supplyUnitRequest',
                controller: 'SupplyUnitsCtrl as suc',
                templateUrl: 'supply.unit.list.view'
            })
            .state('list-supply-unit', {
                url: '/supply-unit/list',
                controller: 'SupplyUnitsCtrl as suc',
                templateUrl: 'supply.unit.list.view'
            })
            .state('list-supplyUnitCopy', {
                url: '/supply-unit/list/:supplyUnitCode',
                controller: 'SupplyUnitsCtrl as suc',
                templateUrl: 'supply.unit.list.view'
            })

            .state('supplier-create', {
                url: '/supplier/:supplierRequest',
                controller: 'SuppliersCtrl as sc',
                templateUrl: 'supply.supplier.list.view'
            })
            .state('list-suppliers', {
                url: '/suppliers/list',
                controller: 'SuppliersCtrl as sc',
                templateUrl: 'supply.supplier.list.view'
            })
            .state('list-supplierCopy', {
                url: '/supplier/list/:supplierCode',
                controller: 'SuppliersCtrl as sc',
                templateUrl: 'supply.supplier.list.view'
            })

            //particulars
            .state('particular-create', { 
                url: '/particular/:particularRequest',
                controller: 'ParticularsCtrl as pc',
                templateUrl: 'particular.list.view'
            })
            .state('list-particular', {
                url: '/particulars/list',
                controller: 'ParticularsCtrl as pc',
                templateUrl: 'particular.list.view'
            })
            .state('list-particularCopy', {
                url: '/particular/list/:particularCode',
                controller: 'ParticularsCtrl as pc',
                templateUrl: 'particular.list.view'
            })

            //funds
            .state('fund-create', { 
                url: '/fund/:fundRequest',
                controller: 'FundsCtrl as fc',
                templateUrl: 'fund.list.view'
            })
            .state('list-fund', {
                url: '/funds/list',
                controller: 'FundsCtrl as fc',
                templateUrl: 'fund.list.view'
            })
            .state('list-fundCopy', {
                url: '/fund/list/:fundCode',
                controller: 'FundsCtrl as fc',
                templateUrl: 'fund.list.view'
            })
            .state('edit-fund', {
                url: '/fund/edit/:fundCode2',
                controller: 'FundsCtrl as fc',
                templateUrl: 'fund.list.view'
            })

            //clients
            .state('client-create', { 
                url: '/client/:clientRequest',
                controller: 'ClientsCtrl as cc',
                templateUrl: 'client.list.view'
            })
            .state('list-client', {
                url: '/clients/list',
                controller: 'ClientsCtrl as cc',
                templateUrl: 'client.list.view'
            })
            .state('list-clientCopy', {
                url: '/clients/list/:clientCode',
                controller: 'ClientsCtrl as cc',
                templateUrl: 'client.list.view'
            })

            //org
            .state('org-deparment-create', {
                url: '/organization/department/new',
                controller: 'OrganizationsCtrl as oc',
                templateUrl: 'organization.create.department.view'
            })
            .state('org-division-create', {
                url: '/organization/division/new',
                controller: 'DivisionsCtrl as dc',
                templateUrl: 'organization.create.division.view'
            })
            .state('org-unit-create', {
                url: '/organization/unit/new',
                controller: 'UnitsCtrl as uc',
                templateUrl: 'organization.create.unit.view'
            })
            .state('org-office-create', {
                url: '/organizations',
                controller: 'OfficesCtrl as oc',
                templateUrl: 'organization.create.office.view'
            })
            .state('voucher-create', {
                url: '/voucher/new',
                controller: 'VouchersCtrl as vc',
                templateUrl: 'voucher.create.view'
            })
            .state('list-voucher', {
                url: '/voucher/list',
                controller: 'VouchersCtrl as vc',
                templateUrl: 'voucher.list.view'
            })
            .state('list-voucherCopy', {
                url: '/voucher/list/:voucherCode',
                controller: 'VouchersCtrl as vc',
                templateUrl: 'voucher.list.view'
            })
            .state('list-banks', {
                url: '/bank/list',
                controller: 'BanksCtrl as bc',
                templateUrl: 'banks.list.view'
            })
            .state('list-banksCopy', {
                url: '/bank/list/:bankCode',
                controller: 'BanksCtrl as bc',
                templateUrl: 'banks.list.view'
            })
            .state('list-insurance', {
                url: '/insurance/list',
                controller: 'InsuranceCtrl as ic',
                templateUrl: 'insurance.list.view'
            })
            .state('list-insuranceCopy', {
                url: '/insurance/list/:insuranceCode',
                controller: 'InsuranceCtrl as ic',
                templateUrl: 'insurance.list.view'
            })

            .state('list-ares', {
                url: '/are/list',
                controller: 'AreCtrl as ac',
                templateUrl: 'ares.list.view'
            })
            .state('list-aresCopy', {
                url: '/are/list/:areCode',
                controller: 'AreCtrl as ac',
                templateUrl: 'ares.list.view'
            })

            .state('list-po', {
                url: '/purchase-orders/list',
                controller: 'PurchaseOrdersCtrl as poc',
                templateUrl: 'purchase.order.list.view'
            })

            .state('list-po-office', {
                url: '/purchase-orders-office/list',
                controller: 'PurchaseOrdersCtrl as poc',
                templateUrl: 'purchase.order.list.office.view'
            })

            .state('list-po2', {
                url: '/purchase-orders2/list',
                controller: 'PurchaseOrdersCtrl as poc',
                templateUrl: 'purchase.order2.list.view'
            })

            .state('list-poCopy', {
                url: '/purchase-order/list/:poCode',
                controller: 'PurchaseOrdersCtrl as poc',
                templateUrl: 'purchase.order.list.view'
            })

            .state('list-poCopy2', {
                url: '/purchase-order2/list/:poCode',
                controller: 'PurchaseOrdersCtrl as poc',
                templateUrl: 'purchase.order2.list.view'
            })

            .state('list-utilization', {
                url: '/utilization/list',
                controller: 'UtilizationsCtrl as uc',
                templateUrl: 'utilization.list.view'
            })
            .state('list-utilization-office', {
                url: '/utilization-office/list',
                controller: 'UtilizationsCtrl as uc',
                templateUrl: 'utilization.list.office.view'
            })
            .state('list-utilizationCopy', {
                url: '/utilization/list/:utilizationCode',
                controller: 'UtilizationsCtrl as uc',
                templateUrl: 'utilization.list.view'
            })


            //for testing only
            .state('angular-data-tables', {
                url: '/angular-datatables',
                controller: 'DTCtrl as dtc',
                templateUrl: 'angular.datatables.view'
            })

            .state('create-employee', {
                url: '/angular-datatables/new',
                controller: 'EmployeesCtrl as ec',
                templateUrl: 'employee.list.view'
            })

            .state('image', {
                url: '/assets/dist/img/dumptruck2_1024x768.jpg'
            })
            //for testing only


            //roles
            .state('role-create', { 
                url: '/role/:roleRequest',
                controller: 'RolesCtrl as rc',
                templateUrl: 'role.list.view'
            })
            .state('list-role', {
                url: '/role/list',
                controller: 'RolesCtrl as rc',
                templateUrl: 'role.list.view'
            })
            .state('list-roleCopy', {
                url: '/role/list/:roleCode',
                controller: 'RolesCtrl as rc',
                templateUrl: 'role.list.view'
            })

            //users
            .state('user-create', { 
                url: '/user/:userRequest',
                controller: 'UsersCtrl as uc',
                templateUrl: 'user.list.view'
            })
            .state('list-user', {
                url: '/user/list',
                controller: 'UsersCtrl as uc',
                templateUrl: 'user.list.view'
            })
            .state('list-userCopy', {
                url: '/user/list/:userCode',
                controller: 'UsersCtrl as uc',
                templateUrl: 'user.list.view'
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


 