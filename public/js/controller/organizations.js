(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .controller('OrganizationsCtrl', OrganizationsCtrl) 
        .controller('DivisionsCtrl', DivisionsCtrl) 
        .controller('UnitsCtrl', UnitsCtrl) 

        OrganizationsCtrl.$inject = ['AddressesSrvcs', 'OrganizationsSrvcs', '$window'];
        function OrganizationsCtrl(AddressesSrvcs, OrganizationsSrvcs, $window){
            var vm = this;
            var data = {}; 

            AddressesSrvcs.region().then (function (response) {
                if(response.data.status == 200)
                {
                    vm.regions = response.data.data;
                    console.log(vm.regions)
                }
            }, function (){ alert('Bad Request!!!') })

            AddressesSrvcs.province({region_code:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.provinces = response.data.data;
                    console.log(vm.provinces)
                }
            }, function (){ alert('Bad Request!!!') })

            AddressesSrvcs.municipality({province_code:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.municipalities = response.data.data;
                    console.log(vm.municipalities)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.selectRegion =  function(region_code){
                console.log(region_code);
                AddressesSrvcs.province({region_code:region_code}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.provinces = response.data.data;
                        console.log(vm.provinces)
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            vm.selectProvince =  function(province_code){
                console.log(province_code);
                AddressesSrvcs.municipality({province_code:province_code}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.municipalities = response.data.data;
                        console.log(vm.municipalities)
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            vm.newDepartment =  function(data){
                // console.log(data);
                OrganizationsSrvcs.saveDepartment(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);
                        vm.routeTo('organization/department/new');
                    }
                    else {
                        alert(response.data.message);
                        // vm.routeTo('asset/create');
                    }
                    console.log(response.data);
                });
            }

            vm.routeTo = function(route){
                $window.location.href = route;
            };
        }


        DivisionsCtrl.$inject = ['AddressesSrvcs', 'OrganizationsSrvcs', '$window'];
        function DivisionsCtrl(AddressesSrvcs, OrganizationsSrvcs, $window){
            var vm = this;
            var data = {}; 

            AddressesSrvcs.region().then (function (response) {
                if(response.data.status == 200)
                {
                    vm.regions = response.data.data;
                    console.log(vm.regions)
                }
            }, function (){ alert('Bad Request!!!') })

            AddressesSrvcs.province({region_code:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.provinces = response.data.data;
                    console.log(vm.provinces)
                }
            }, function (){ alert('Bad Request!!!') })

            AddressesSrvcs.municipality({province_code:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.municipalities = response.data.data;
                    console.log(vm.municipalities)
                }
            }, function (){ alert('Bad Request!!!') })

            OrganizationsSrvcs.organizations({orgCode:'', nextOrgCode:'', orgType:'Department', startDate:'', endDate:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.departments = response.data.data;
                    console.log(vm.departments)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.selectRegion =  function(region_code){
                console.log(region_code);
                AddressesSrvcs.province({region_code:region_code}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.provinces = response.data.data;
                        console.log(vm.provinces)
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            vm.selectProvince =  function(province_code){
                console.log(province_code);
                AddressesSrvcs.municipality({province_code:province_code}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.municipalities = response.data.data;
                        console.log(vm.municipalities)
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            vm.newDivision =  function(data){
                console.log(data);
                OrganizationsSrvcs.saveDivision(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);
                        vm.routeTo('organization/division/new');
                    }
                    else {
                        alert(response.data.message);
                        // vm.routeTo('asset/create');
                    }
                    console.log(response.data);
                });
            }

            vm.routeTo = function(route){
                $window.location.href = route;
            };
        }


        UnitsCtrl.$inject = ['AddressesSrvcs', 'OrganizationsSrvcs', '$window'];
        function UnitsCtrl(AddressesSrvcs, OrganizationsSrvcs, $window){
            var vm = this;
            var data = {}; 

            AddressesSrvcs.region().then (function (response) {
                if(response.data.status == 200)
                {
                    vm.regions = response.data.data;
                    console.log(vm.regions)
                }
            }, function (){ alert('Bad Request!!!') })

            AddressesSrvcs.province({region_code:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.provinces = response.data.data;
                    console.log(vm.provinces)
                }
            }, function (){ alert('Bad Request!!!') })

            AddressesSrvcs.municipality({province_code:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.municipalities = response.data.data;
                    console.log(vm.municipalities)
                }
            }, function (){ alert('Bad Request!!!') })

            OrganizationsSrvcs.organizations({orgCode:'', nextOrgCode:'', orgType:'Department', startDate:'', endDate:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.departments = response.data.data;
                    console.log(vm.departments)
                }
            }, function (){ alert('Bad Request!!!') })

            OrganizationsSrvcs.organizations({orgCode:'', nextOrgCode:'', orgType:'Division', startDate:'', endDate:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.divisions = response.data.data;
                    console.log(vm.divisions)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.selectDepartment =  function(departmentCode){
                console.log(departmentCode);
                OrganizationsSrvcs.organizations({orgCode:'', nextOrgCode:departmentCode, orgType:'Division', startDate:'', endDate:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.divisions = response.data.data;
                    console.log(vm.divisions)
                }
            }, function (){ alert('Bad Request!!!') })
            }

            vm.selectRegion =  function(region_code){
                console.log(region_code);
                AddressesSrvcs.province({region_code:region_code}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.provinces = response.data.data;
                        console.log(vm.provinces)
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            vm.selectProvince =  function(province_code){
                console.log(province_code);
                AddressesSrvcs.municipality({province_code:province_code}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.municipalities = response.data.data;
                        console.log(vm.municipalities)
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            vm.newUnit =  function(data){
                console.log(data);
                OrganizationsSrvcs.saveUnit(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);
                        vm.routeTo('organization/unit/new');
                    }
                    else {
                        alert(response.data.message);
                        // vm.routeTo('asset/create');
                    }
                    console.log(response.data);
                });
            }

            vm.routeTo = function(route){
                $window.location.href = route;
            };
        }
})();