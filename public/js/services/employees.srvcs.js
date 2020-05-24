(function () {
    'use strict';
    angular
        .module('pulsarApp')
        .factory('EmployeesSrvcs', EmployeesSrvcs)

    EmployeesSrvcs.$inject = ['$http'];

    function EmployeesSrvcs($http) {
        return {
            employees: function (data) {
                return $http({
                    method: 'GET',
                    data: data,
                    url: 'api/v1/employees?jobType=' + data.jobType,
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
            },
            employees2: function (data) {
                return $http({
                    method: 'GET',
                    data: data,
                    url: 'api/v1/employees2?employee_code=' + data.employee_code,
                    // url: 'api/v1/employees2?employee_id='+data.employee_id,
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
            },
            save: function (data) {
                return $http({
                    method: 'POST',
                    url: 'api/v1/employees/save',
                    data: data,
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
            },
            update: function (data) {
                return $http({
                    method: 'POST',
                    url: 'api/v1/employee/update',
                    data: data,
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
            },
            positions: function (data) {
                return $http({
                    method: 'GET',
                    data: data,
                    url: 'api/v1/positions?positionCode=' + data.positionCode,
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
            },
            uploadProfilePhoto: function (data) {
                return $http({
                    method: 'POST',
                    data: data,
                    url: 'api/v1/profile/upload-profile-photo/' + data.employee_code,
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
            },
            NewPosition: function (data) {
                return $http({
                    method: 'POST',
                    data: data,
                    url: 'api/v1/position/save',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
            },
        };
    }
})();