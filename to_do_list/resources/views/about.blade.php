<!--login and registration-->
<html>
    <head>
        <title>Laravel</title>
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="_token" content="<% csrf_token() %>">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
        <script type="text/javascript" src="<% URL::asset('js/script.js') %>"></script>
    </head>
    <body ng-app="login">
        <div class="container"  ng-controller="loginController"  >
            <div class="content">
<!-- to log-in -->
                     <?= !empty($msg)?$msg:'';?>
                <div>
                    <div ng-show="show_error" class="alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <strong></strong>
                    </div>
                    <div ng-show="show_success" class="alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a><strong>You have succesfully created an account.</strong></div>
                </div>
                <div class="login" ng-show="show_login">
                    <center >
                        <h1>Log In</h1>
                    </center>
                    <form action="" method="POST" novalidate name="loginForm">
                        <div class="form-group">
                            <label for="text">UserName/Email:</label>
                            <input type="text" class="form-control" id="username" name="username" ng-model="username" required>
                            <span style="color:red" ng-show="loginForm.username.$touched && loginForm.username.$invalid">Username is required.</span>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" ng-model="password" required>
                            <span style="color:red" ng-show="loginForm.password.$touched && loginForm.password.$invalid">Password is required.</span>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" ng-model="remember_token" name="remember_token"> Remember me</label>
                        </div>
                        <button type="button" ng-click="log()" class="btn btn-primary">Log In</button>
                        <a class="btn btn-link" href="http://localhost:8000/forget-password">Forgot Your Password?</a>
                    </form>
                    <center>
                        <button class="btn btn-primary" ng-click="sign()">Want to Sign Up?</button>
                    </center>

                </div>
<!-- to sign up -->
                <div class="signup" ng-show="show_signup">
                    <center>
                        <h1>Sign Up</h1>
                    </center>
                    <form action="" method="POST" novalidate name="SignUpForm">
                        <div class="form-group">
                            <label for="text">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" ng-model="name" required>
                            <span style="color:red" ng-show="SignUpForm.name.$touched && SignUpForm.name.$invalid">Name is required.</span>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="text">Email:</label>
                            <input type="email" class="form-control" id="email" name="email"  ng-model="email" required>
                            <span style="color:red" ng-show="SignUpForm.email.$touched && SignUpForm.email.$invalid">Email Id is required.</span>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="text">UserName:</label>
                            <input type="text" class="form-control" id="username" name="username" ng-model="username" required>
                            <span style="color:red" ng-show="SignUpForm.username.$touched && SignUpForm.username.$invalid">Username is required.</span>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" ng-model="password" required>
                            <span style="color:red" ng-show="SignUpForm.password.$touched && loginForm.password.$invalid">Password is required.</span>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Password Confirmation:</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" ng-model="password_confirmation" required>
                            <span style="color:red" ng-show="SignUpForm.password.$touched && loginForm.password.$invalid">Password Confirmation is required.</span>
                        </div>
                        <button type="button" ng-click="signup()" class="btn btn-primary">Sign Up</button>
                    </form>
                    <center><button class="btn btn-primary" ng-click="loggy()">Log In</button></center>
                </div>
            </div>
        </div>
    </body>
</html>