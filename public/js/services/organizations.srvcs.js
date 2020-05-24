(function(){
    'use strict';
    angular
        .module('pulsarApp')
        .factory('OrganizationsSrvcs', OrganizationsSrvcs)

        OrganizationsSrvcs.$inject = ['$http'];
        function OrganizationsSrvcs($http) {
            return {
            	organizations: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: 'api/v1/organizations?orgCode='+data.orgCode+'&nextOrgCode='+data.nextOrgCode+'&orgType='+data.orgType+'&startDate='+data.startDate+'&endDate'+data.endDate,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                departments: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: 'api/v1/organization/departments?departmentCode='+data.orgCode+'&nextOrgCode='+data.nextOrgCode+'&orgType='+data.orgType+'&startDate='+data.startDate+'&endDate'+data.endDate,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                saveDepartment: function(data) {
                    return $http({
                        method: 'POST',
                        url: 'api/v1/organization/department/save',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                updateDepartment: function(data) {
                    return $http({
                        method: 'POST',
                        url: 'api/v1/organization/department/update',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                divisions: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: 'api/v1/organization/divisions?divisionCode='+data.orgCode+'&nextOrgCode='+data.nextOrgCode+'&orgType='+data.orgType+'&startDate='+data.startDate+'&endDate'+data.endDate,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                saveDivision: function(data) {
                    return $http({
                        method: 'POST',
                        url: 'api/v1/organization/division/save',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                updateDivision: function(data) {
                    return $http({
                        method: 'POST',
                        url: 'api/v1/organization/division/update',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                units: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: 'api/v1/organization/units?unitCode='+data.orgCode+'&nextOrgCode='+data.nextOrgCode+'&orgType='+data.orgType+'&startDate='+data.startDate+'&endDate'+data.endDate,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                saveUnit: function(data) {
                    return $http({
                        method: 'POST',
                        url: 'api/v1/organization/unit/save',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                updateUnit: function(data) {
                    return $http({
                        method: 'POST',
                        url: 'api/v1/organization/unit/update',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
            };
        }
})();