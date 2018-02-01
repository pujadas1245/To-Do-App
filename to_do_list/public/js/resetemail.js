var app = angular.module('passwordApp', []);
app.controller('PasswordController', function ($scope, $http,$window) {
	$scope.resetpassword=function(){
        $http({
            method: 'POST',
            url: '/reset-password',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-CSRF-Token': $('meta[name="_token"]').attr('content')
            },
            data: $.param({
                email: $scope.email
            })
        }).then(function (response) {
            //console.log(response.data);
            if(response.data.success){
                 // $window.location.href = 'http://localhost:8000/newpassword';
            }
            else{
                console.log("we couldn't sent you a email");
             //     $scope.show_error = true;
             //     $scope.show_success = false;
             //    var myE2 = angular.element( document.querySelector( '.alert' ) );
             // myE2.append(response.data.message);
             // console.log(myE2);    
            }
            });
        };
    });