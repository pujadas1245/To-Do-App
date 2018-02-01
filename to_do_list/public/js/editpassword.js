var app = angular.module('newPasswordApp', []);
app.controller('NewPasswordController', function ($scope, $http,$window) {
	$scope.resetNewPassword=function(){
        $http({
            method: 'POST',
            url: '/new-password',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-CSRF-Token': $('meta[name="_token"]').attr('content')
            },
            data: $.param({
               username: $scope.username, password: $scope.password, confirmPassword: $scope.confirmPassword
            })
        }).then(function (response) {
            //console.log(response.data);
            if(response.data.success){
                console.log("thanks.your password is reset");
                $window.location.href = '/about';
            }
            else{
                console.log("sorry, Something went wrong.please try again!");
             //     $scope.show_error = true;
             //     $scope.show_success = false;
             //    var myE2 = angular.element( document.querySelector( '.alert' ) );
             // myE2.append(response.data.message);
             // console.log(myE2);    
            }
            });
        };
    });