<html>
<head>
    <title>Laravel</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
    <meta name="_token" content="<% csrf_token() %>">
    <script type="text/javascript" src="<%URL::asset('js/todo.js')%>"></script>
</head>
<body>
    <div class="container" ng-app="myApp" ng-controller="todoController" >
        <div class="content"><br>
            <?= !empty($msg) ? $msg : ''; ?>
            <form align="right" name="logoutForm" method="post" action="">
                <label class="logoutLblPos"></label>
                <button type="button" ng-click="loggyout()" class="btn btn-primary">Log Out</button>
            </form>
            <center><h1>Things To Do</h1></center>
            <script type="text/javascript">
                function validateForm()
                {
                                        //return false;
                                    }
                                </script>
                                <form ng-submit="addRow()" action="" method="POST onsubmit="return validateForm();">

                                  <div class="form-group">
                                    <label for="text">Enter a new task:</label>
                                    <input type="text" class="form-control input-sm" id="task" placeholder="Enter your new task" width="50" ng-model="task">
                                </div><br>
                                <button type="button" ng-click="add()" class="btn btn-primary">
                                    <i class="fa fa-plus"></i>Add</button>
                                </form>
                                <form align='right' method= 'POST' action='' onsubmit= 'return validateForm();'>
                                    <div class="form-group" >
                                        <label for="text"></label>
                                        <input type="text" class="form-control input-sm" name="search" placeholder="Search Tasks" ng-model="search">
                                    </div><br>
                                    <button type="button" ng-click="searchTasks()" class="btn btn-primary">Search</button>
                                    <button type="reset" ng-click="resetTasks()" class="btn btn-primary">Reset</button>
                                </form>
                                <br>
                                <form>
                                    <label>Show 
                                        <select class="form-control pull-left input-sm" ng-model='totalDataLimit' ng-change="dataLimitsChange(totalDataLimit)">
                                            <option value= "5">5</option>
                                            <option value= "10">10</option>
                                            <option value= "15">15</option>
                                            <option value= "20">20</option>
                                        </select>Entries
                                    </label>
                                </form>
                                <br>        
                                <form>
                                    <label for= "status">Status</label>
                                    <select class= "form-control pull-right input-sm" ng-model= "status" ng-change= "statusChange(status)">
                                        <option value= '1'>To Do</option>
                                        <option value= '2'>In Progress</option>
                                        <option value= '3'>Done</option>
                                    </select> 
                                </form>
                                <br>
                                <form>
                                    <input type= "hidden" name="offset" value= "0">
                                    <input type= "hidden" name= "endRecords" value= "0">
                                    <input type= "hidden" name= "limits" value= "">
                                    <input type= "hidden" name= "pageVal" value= "1">
                                </form>
                                <h2>To-do list task</h2>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Task</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            <tr ng-repeat="x in records">
                                                <button type="submit" style="margin-bottom: 10px" class="btn btn-primary" ng-click=" cancel(x.id)">Delete All Selected</button>
                                                <td><input type="checkbox" ng-model="checkVal" ng-change="stateChanged(x.id, checkVal)"></td>
                                                <td >{{x.note}}</td>
                                                <td >{{x.status}}</td>
                                                <td>
                                                    <button class="btn btn-info" type="submit" id="submit" ng-click="edit(x.id, x.note)">edit Task</button><button class= "btn btn-success" type="submit" ng-click="editStatus(x.id, x.status)">Edit Status</button><button class="btn btn-warning" type="submit" data-ng-click="remove(x.id)">Delete Task</button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div>
                                        <task-pagination></task-pagination>
                                    </div>
                                </div>
                            </div>
                        </body>
                        </html>

