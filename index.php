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
  <style type="text/css">
  .container {
      position: absolute;

      /*margin-top: 10px;*/
      width: 374px;
      height: 490px;
      margin-top: 20px;
      left: 50%;
      margin-left: -187px;
      /*left: 50%;*/
      /*margin-top: 5%;*/

      /*margin-left: 10%;*/
      background: #5db2df;
      /*background: #EDEFF2;*/
      border-radius: 12px;
      box-shadow: 0 2px 20px rgba(0,0,0,0.15);
      overflow: hidden;
    }
  

    .plane-cont {
      position: absolute;
      left: 50%;
      margin-left: -35px;
      top: 80px;
      width: 60px;
      height: 60px;
      background: #5ddfcb;
      border-radius: 50%; 
      box-shadow: 0 0.30px 0.30px rgba(0,0,0,0.3);
    }

    .plane-rotater {
      position: absolute;
      left: 50%;
      top: 50%;
      margin-left: -11px;
      margin-top: -14px;
      width: 32px;
      height: 32px;
    }

    .plane.fly {
        animation: planeFly 3.5s forwards;  
    }

    @keyframes planeFly {
      10% {
        transform: translate(-40px, 20px) rotate(-45deg);
      }
      28% {
        transform: translate(330px, -190px) rotate(0deg) scale(0.9);
      }

      30% {
        /*transform: translate(420px, -180px) rotate(-70deg) scale(0.7);*/
      }
      32% {
        transform: translate(330px, -120px) rotate(-160deg) scale(0.5);
      }
      68% {
        transform: translate(-250px, -40px) rotate(-180deg) scale(0.7);
      }
      70% {
        transform: translate(-250px, 0) rotate(0deg) scale(1.2);
      }
      100% {
        transform: rotate(0deg) scale(1.2);
      }
    }

    .page-header {
      /*position: absolute;*/
      /*min-height: 120px;*/
      /*height: 120px;*/
    }

    .infoArea {
      /*top: 120px;*/
      /*position: absolute;*/

    }




  </style>


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

                $(".plane").addClass("fly");

                $(".plane").one('webkitAnimationEnd oanimationend msAnimationEnd animationend', 
                  function(e) {
                  // code to execute after animation ends
                  console.log("animation end");
                  $(".plane").removeClass('fly');
                  window.location.href = "operatorMenu.php";
                });      
                // window.location.href = "operatorMenu.php";
              } else if (data.userType == 'inspector') {
                $(".plane").addClass("fly");
                console.log(passObject.userInfo);

                $(".plane").one('webkitAnimationEnd oanimationend msAnimationEnd animationend', 
                  function(e) {
                  // code to execute after animation ends
                  console.log("animation end");
                  $(".plane").removeClass('fly');
                  // window.location.href = "operatorMenu.php";
                  window.location.href = "inspectorMenu.php";

                });
                // window.location.href = "inspectorMenu.php";
              }
            }
          });

      };
    }

  </script>


</head>
<body ng-app="formApp" ng-controller="formController">
<div class="container">
<div class="col-md-12 col-md-offset-0">

  <!-- PAGE TITLE -->
  <div class="page-header">
    <h1><span class="glyphicon glyphicon-cutlery"></span> GA Restaurant Inspection System </h1>
  </div>

      <div class="demo-body">
      <div class="plane-cont">
        <div class="plane-rotater">
          <div class="plane">
            <svg class="plane-svg" viewBox="0 0 28 26">
              <path class="plane-svg__path" fill="#fff" d="M0,0 28,13 0,26 0,13 20,13 0,7z" />
            </svg>
          </div>
        </div>
      </div>
    </div>

  <!-- Info Area -->
  <div class="infoArea">
  
    <br>

    <!-- SHOW ERROR/SUCCESS MESSAGES -->
    <div id="messages" ng-show="message">{{ message }}</div>


    <!-- FORM -->
    <form ng-submit="processForm()">
      <!-- NAME -->
      <div id="name-group" class="form-group">
        <label>Name</label>
        <input type="text" name="name" class="form-control" placeholder="e.g. edo" ng-model="formData.name">
        <span class="help-block" ng-show="errorName">{{ errorName }}</span> 
      </div>

      <!--  Password -->
      <div id="password-group" class="form-group">
        <label>Password</label>
        <input type="text" name="password" class="form-control" placeholder="e.g. 1234" ng-model="formData.password">
        <span class="help-block" ng-show="errorPassword">{{ errorPassword }}</span> 

      </div>

      <!-- SUBMIT BUTTON -->
      <button type="submit" class="btn btn-success btn-lg btn-block">
        <span class="glyphicon glyphicon-user"></span> User Login
      </button>
      <br>
      

      <label>Not a registered user? No worry!</label>


      <button class="btn btn-warning btn-lg btn-block" type="button" ng-click="guestLogin()">
        <span class="glyphicon glyphicon-glass"></span> Guest Login
      </button>




    </form>
  </div>
</div>
</div>
</body>
</html>