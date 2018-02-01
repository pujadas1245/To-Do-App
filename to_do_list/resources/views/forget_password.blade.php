<!DOCTYPE html>
<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="_token" content="<% csrf_token() %>">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
        <script type="text/javascript" src="<% URL::asset('js/resetemail.js') %>"></script>
    </head>
    <body ng-app="passwordApp">
        <div class="container"  ng-controller="PasswordController"  >
            <div class="content">
            </div>
            <div class="password"> 
            <center >
                        <h1>Forgot your password?</h1>
                    </center>
                    <form action="" method="POST" novalidate name="forgetPasswordForm">
                        <div class="form-group">
                            <label for="text">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" ng-model="email" required>
                            <span style="color:red" ng-show="forgetPasswordForm.email.$touched && forgetPasswordForm.email.$invalid">Email is required.</span>
                        </div>
                        <br>
                        <center><button type="button" ng-click="resetpassword()" class="btn btn-primary">Send password reset email</button>
                        <h5><a href="http://localhost:8000/about">I remember my password</a></h5></center>
                    </form>
                </div>
</body>
</html>