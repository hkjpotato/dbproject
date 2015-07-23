<?php
session_start();

//check if session information has been set up
if(isset($_SESSION['userType'])){
  if($_SESSION['userType'] == "operator") {
    // echo $_SESSION['userInfo'];
    header("location: operatorMenu.php");

  } else if ($_SESSION['userType'] == "inspector") {
    header("location: inspectorMenu.php");
  }
}
?>
<!-- index.html -->
<!doctype html>
<html>
<head>
  <title>Angular Forms</title>

  <!-- LOAD BOOTSTRAP CSS -->
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css">

  <!-- LOAD JQUERY -->
    <!-- when building an angular app, you generally DO NOT want to use jquery -->
    <!-- we are breaking this rule here because jQuery's $.param will help us send data to our PHP script so that PHP can recognize it -->
    <!-- this is jQuery's only use. avoid it in Angular apps and if anyone has tips on how to send data to a PHP script w/o jQuery, please state it in the comments -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
  <!-- LOAD ANGULAR -->
  <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.0/angular.min.js"></script>

  <!-- PROCESS FORM WITH AJAX (OLD) -->
  <script>
    <!-- WE WILL PROCESS OUR FORM HERE -->
    var passObject = {
      username: "",
      password: "",
      userTpye: "",
      userInfo: ""
    };

        // define angular module/app
    var formApp = angular.module('formApp', []);

    // create angular controller and pass in $scope and $http
    function formController($scope, $http) {
      // create a blank object to hold our form information
      // $scope will allow this to pass between controller and view
      $scope.formData = {};

      $scope.guestLogin = function() {
        var guestWindow = window.open("guestMenu.html","_self");

      }

      // process the form
      $scope.processForm = function() {
        passObject.username = $scope.formData.name;
        passObject.password = $scope.formData.password;

        $http({
          method  : 'POST',
          url     : 'loginprocess.php',
          data    : $.param($scope.formData),  // pass in data as strings
          headers : { 'Content-Type': 'application/x-www-form-urlencoded' }  // set the headers so angular passing info as form data (not request payload)
         })
          .success(function(data) {
            console.log(data);

            if (!data.success) {
              // if not successful, bind errors&messagesto error variables
              console.log("fail to do");

              $scope.errorName = data.errors.name;
              $scope.errorPassword = data.errors.password;
              $scope.message = data.message;
              console.log(data.user);

            } else {
              // if successful, bind success message to message
              $scope.message = data.message;
              console.log(data.userType);
              console.log(data.userInfo);
        
              if (data.userType == 'operator') {
                window.location.href = "operatorMenu.php";
              } else if (data.userType == 'inspector') {
                console.log(passObject.userInfo);
                window.location.href = "inspectorMenu.php";
              }
            }
          });

      };
    }

  </script>
</head>
<body ng-app="formApp" ng-controller="formController">
<div class="container">
<div class="col-md-6 col-md-offset-3">

  <!-- PAGE TITLE -->
  <div class="page-header">
    <h1><span class="glyphicon glyphicon-cutlery"></span> Group 23 Project</h1>
  </div>

  <!-- SHOW ERROR/SUCCESS MESSAGES -->
  <div id="messages" ng-show="message">{{ message }}</div>

  <!-- FORM -->
  <form ng-submit="processForm()">
    <!-- NAME -->
    <div id="name-group" class="form-group">
      <label>Name</label>
      <input type="text" name="name" class="form-control" placeholder="Chuney" ng-model="formData.name">
      <span class="help-block" ng-show="errorName">{{ errorName }}</span> 
    </div>

    <!--  Password -->
    <div id="password-group" class="form-group">
      <label>Password</label>
      <input type="text" name="password" class="form-control" placeholder="1234" ng-model="formData.password">
      <span class="help-block" ng-show="errorPassword">{{ errorPassword }}</span> 

    </div>

    <!-- SUBMIT BUTTON -->
    <button type="submit" class="btn btn-success btn-lg btn-block">
      <span class="glyphicon glyphicon-user"></span> User Login
    </button>
    <br>
    

    <label>Not a registered user? No worry!</label>


    <button class="btn btn-primary btn-lg btn-block" type="button" ng-click="guestLogin()">
      <span class="glyphicon glyphicon-glass"></span> Guest Login
    </button>

  </form>
</div>
</div>
</body>
</html>