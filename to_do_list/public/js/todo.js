var app = angular.module('myApp', []);
app.controller('todoController', function ($scope, $http, $window) {
    $scope.blankarray = [];
    $scope.totalPages = 0;
    $scope.currentPage = 1;
    $scope.range = [];
//to logout
    $scope.loggyout = function () {
        $http({
            method: 'POST',
            url: '/signout',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-CSRF-Token': $('meta[name="_token"]').attr('content')
            }
        }).then(function (response) {
            if (response.data.success) {
                $window.location.href = 'http://localhost:8000/about';
            }
            else {

            }
        });
    };
//to add data
    $scope.add = function () {
        $http({
            method: 'POST',
            url: '/create-task',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-CSRF-Token': $('meta[name="_token"]').attr('content')
            },
            data: $.param({
                note: $scope.task
            })
        }).then(function (data, status, headers, config) {
            $scope.display();

        });
    };
//to search task
    $scope.searchTasks = function () {
        $scope.display($scope.search);
    };
//to reset search
    $scope.resetTasks = function () {
        $scope.display();
    };
//to change status
    $scope.statusChange = function () {
        $scope.display(null, $scope.status);
    };
//to select no of data to show in pagination
    $scope.dataLimitsChange = function (totalDataLimit) {
        $scope.display(null, null, null, totalDataLimit);
    }

//to get data
    $scope.display = function(search = null, status = null, pageNumber, totalDataLimit = null) {
        if (pageNumber == 'undefined') {
            pageNumber = '1';
        }
        $http({
            method: 'POST',
            url: '/fetch',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-CSRF-Token': $('meta[name="_token"]').attr('content')
            },
            data: $.param({
                search: search,
                status: status,
                page: pageNumber,
                totalDataLimit: totalDataLimit

            })
        }).then(function show(response) {
            $scope.data = response.data.data;
            angular.forEach($scope.data, function (value, key) {
                if (value.status == 1)
                {
                    value.status = 'To Do';
                }
                else if (value.status == 2)
                {
                    value.status = 'In Progress';
                }
                else if
                        (value.status == 3)
                {
                    value.status = 'Done';
                }
                else {

                }
            });

            $scope.totalPages = response.data.last_page;
            $scope.currentPage = response.data.current_page;
            var pages = [];
            for (var i = 1; i <= response.data.last_page; i++) {
                pages.push(i);
            }
            $scope.range = pages;
            $scope.records = $scope.data;
        });
    }
//to delete data
    $scope.remove = function (id) {
        $http({
            method: 'DELETE',
            url: '/delete-task/' + id
        }).then(function cut(response) {
            $scope.display();
        });
    }
//to edit data        
    $scope.edit = function (id, note) {
        $http({
            method: 'GET',
            url: '/showing/' + id + note
        }).then(function (response) {
            $scope.task = response.data.note;
        });
        $scope.add = function () {
            $http({
                method: 'POST',
                url: '/up/' + id,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                },
                data: $.param({
                    note: $scope.task
                })
            }).then(function (data) {
                $scope.display();

            });
        };
    }
//to edit status
    $scope.editStatus = function (id, status) {
        $http({
            method: 'GET',
            url: '/editing/' + id + status
        }).then(function (response) {
            $scope.data = response.data;
            if ($scope.data.status == 1) {
                $scope.data.status = 'To Do';
            }
            else if ($scope.data.status == 2) {
                $scope.data.status = 'In Progress';
            }
            else if ($scope.data.status == 3) {
                $scope.data.status = 'Done';
            }
            else {

            }
            $scope.task = $scope.data.status;
        });

        $scope.add = function () {
            $http({
                method: 'POST',
                url: '/updateStatus/' + id,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                },
                data: $.param({
                    status: $scope.task
                })
            }).then(function (data) {
                $scope.data = data;
                if ($scope.data == 1)
                {
                    $scope.data = 'To Do';
                }
                else if ($scope.data == 2) {
                    $scope.data = 'In Progress';
                }
                else if ($scope.data == 3) {
                    $scope.data = 'Done';
                }
                else {

                }
                $scope.display();
            });
        };
    }

//checkbox     
    $scope.stateChanged = function (id, checkVal) {
        if (checkVal === true) { //If it is checked
            $scope.blankarray.push(id);
        }
        else {
            $scope.blankarray.splice($scope.blankarray.indexOf(id), 1);
        }
    };
//delete multple tasks
    $scope.cancel = function () {
        console.log($scope.blankarray);
        $http({
            method: 'DELETE',
            url: '/delete-all/' + $scope.blankarray
        }).then(function erase(response) {
            $scope.display();
        });
    };

    $scope.display();
});
app.directive('taskPagination', function () {
    return {
        restrict: 'E',
        template: "<ul class= 'pagination'>" +
                "<li ng-show= 'currentPage !=1'><a href= 'javascript:void(0)' ng-click='display(null, null, 1)'>&laquo;</a></li>" +
                "<li ng-show= 'currentPage !=1'><a href= 'javascript:void(0)' ng-click='display(null, null, currentPage-1)'>&lsaquo; prev</a></li>" +
                "<li ng-repeat= 'i in range' class= '{active: currentPage== i}'>" +
                "<a href= 'javascript:void(0)' ng-click= 'display(null,  null, i)'>{{i}}</a>" +
                "</li>" +
                "<li ng-show= 'currentPage != totalPages'><a href= 'javascript:void(0)' ng-click='display(null, null, currentPage+1)'>&rsaquo; Next</a></li>" +
                "<li ng-show= 'currentPage != totalPages'><a href= 'javascript:void(0)' ng-click='display(null, null, totalPages)'>&raquo;</a></li>" +
                "</ul>"
    };
});