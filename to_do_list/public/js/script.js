var app = angular.module('login', []);
app.controller('loginController', function ($scope, $http,$window,$location) {
    $scope.show_error = false;
    $scope.show_success = false;
    $scope.show_signup = false;
    $scope.show_login = true;

    $scope.sign = function () {
        $scope.show_signup = true;
        $scope.show_login = false;
    };
    $scope.loggy = function () {
        $scope.show_signup = false;
        $scope.show_login = true;
    };
   // $scope.signup = function (callback) { 
   //  callback($scope.show_error);
   //  //$scope.show_error = false;
   
   //  }
    //log in
    $scope.log = function () {

        $http({
            method: 'POST',
            url: '/log',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-CSRF-Token': $('meta[name="_token"]').attr('content')
            },
            data: $.param({
                username: $scope.username, password: $scope.password, remember_token: $scope.remember_token
            })
        }).then(function (response) {
            console.log(response.data);
            if(response.data.success){
                 $window.location.href = 'http://localhost:8000/welcome';
            }
            else{
                 $scope.show_error = true;
                 $scope.show_success = false;
                var myE2 = angular.element( document.querySelector( '.alert' ) );
             myE2.append(response.data.message);
             console.log(myE2);    
            }
            });
        };
    //sign up
    $scope.signup = function () {
        $http({
            method: 'POST',
            url: '/sign',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-CSRF-Token': $('meta[name="_token"]').attr('content')
            },
            data: $.param({
                name: $scope.name, email: $scope.email, username: $scope.username, password: $scope.password, password_confirmation: $scope.password_confirmation
            })
        }).then(function (response, status) {
            console.log(response.data);
            if (response.data.success) {

                $scope.show_signup = false;
                $scope.show_login = true;
                $scope.show_error = false;
                $scope.show_success = true;

            }
            else {
                
                $scope.show_error = true;
                $scope.show_success = false;
            }

                         var myEl = angular.element( document.querySelector( '.alert' ) );
             myEl.append(response.data.message);    
        });
    };
}); 