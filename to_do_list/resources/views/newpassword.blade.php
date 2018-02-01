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
        <script type="text/javascript" src="<% URL::asset('js/editpassword.js') %>"></script>
    </head>
    <body ng-app="newPasswordApp">
        <div class="container"  ng-controller="NewPasswordController"  >
            <!-- <div class="content">
            </div> -->
            <center ><h1>Enter your new password</h1></center>
                    <form action="" method="POST" novalidate name="latestPasswordForm">
                        <div class="form-group">
                            <label for="text">UserName:</label>
                            <input type="text" class="form-control" id="username" name="username" ng-model="username" required>
                            <span style="color:red" ng-show="latestPasswordForm.username.$touched && latestPasswordForm.username.$invalid">UserName is required.</span>
                        </div>
                        <div class="form-group">
                            <label for="text">New Password:</label>
                            <input type="password" class="form-control" id="password" name="password" ng-model="password" required>
                            <span style="color:red" ng-show="latestPasswordForm.password.$touched && latestPasswordForm.password.$invalid">Password is required.</span>
                        </div>
                        <div class="form-group">
                            <label for="text">Confirm New Password:</label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" ng-model="confirmPassword" required>
                            <span style="color:red" ng-show="latestPasswordForm.confirmPassword.$touched && latestPasswordForm.confirmPassword.$invalid">Confirm Password is required.</span>
                        </div>
                        <br>
                        <center><button type="button" ng-click="resetNewPassword()" class="btn btn-primary">Enter your new password</button></center>
                    </form>
                </div>
</body>
</html>