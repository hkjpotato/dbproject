<?php include 'session.php'; ?>
<!-- index.html -->
<!doctype html>
<html>
<head>
  <title>Angular Forms</title>

  <!-- LOAD BOOTSTRAP CSS -->
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css">

  <!-- LOAD JQUERY -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
  <!-- LOAD ANGULAR -->
  <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.0/angular.min.js"></script>


<script type="text/javascript">
    <?php echo 'var userInfo = "'.$_SESSION['userInfo'].'";'; ?>
</script>


  <!-- PROCESS FORM WITH AJAX (OLD) -->
  <script>
    <!-- WE WILL PROCESS OUR FORM HERE -->
    
    console.log(userInfo);
        // define angular module/app
    var formApp = angular.module('formApp', []);

    // create angular controller and pass in $scope and $http
    function formController($scope, $http) {



      $scope.back = function() {
        location.href='operatorMenu.php';
      }

      $scope.formData = {};

      //preload page information: cuisine value
      $scope.cuisines = [
        'American',
        'Chinese',
        'French',
        'Greek',
        'Indian',
        'Italian',
        'Japanese',
        'Korean',
        'Mexican',
        'Thai'
      ];

      $scope.formData.cuisine = $scope.cuisines[0];
      $scope.formData.email = userInfo;

      $scope.processForm = function() {
        // $scope.formData.rid = $scope.selected.rid;
        $http({
          method  : 'POST',
          url     : 'createRestaurantProcess.php',
          data    : $.param($scope.formData),  // pass in data as strings
          headers : { 'Content-Type': 'application/x-www-form-urlencoded' }  // set the headers so angular passing info as form data (not request payload)
         })
          .success(function(data) {
            console.log(data);

            if (!data.success) {
              // if not successful, bind errors&messagesto error variables
              // $scope.errorName = data.errors.name;
              // $scope.errorPassword = data.errors.password;
              $scope.message = data.message;
              console.log("fail to subimit!!!!");
              console.log(data.message);
              console.log(data.phone);
              console.log(data.email);

            } else {
              // if successful, bind success message to message
              $scope.message = data.message;
              console.log( "success to subimit!!!!");
              document.getElementById("myForm").reset();
              alert('Restaurant has been created!');


              // var guestWindow = window.open("guestMenu.html",'_self');

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
    <h1><span class="glyphicon glyphicon-cutlery"></span> Create A New Restaurant </h1>
  </div>



  <br>

  <!-- SHOW ERROR/SUCCESS MESSAGES -->
  <div id="messages" ng-show="message">{{ message }}</div>

  <!-- FORM -->
  <form id="myForm" ng-submit="processForm()">
    <!-- NAME -->
    <div id="date-group" class="form-group">
      <label>Health Permit ID</label>
      <input type="text" name="hpID" class="form-control" placeholder="your unique 9 digit health permit ID" ng-model="formData.hpID">
      <!-- <span class="help-block" ng-show="errorDate">{{ errorDate }}</span>  -->
    </div>


    <div class="form-group">
      <label>Health Permit Expiration Date</label>
      <input type="text" name="hpIDDate" class="form-control" placeholder="yyyy-mm-dd" ng-model="formData.hpIDDate">
      <!-- <span class="help-block" ng-show="errorPassword">{{ errorPassword }}</span>  -->
    </div>

    <div id="cuisine" class="form-group">
      <label>Cuisine</label>
      <select 
      ng-options="item as item for item in cuisines" 
      ng-model="formData.cuisine"
      class="form-control">
      </select>
    </div>

    <div class="form-group">
      <label>Restaurant Name</label>
      <input type="text" name="name" class="form-control" placeholder="e.g: Panda Express" ng-model="formData.name">
      <!-- <span class="help-block" ng-show="errorPassword">{{ errorPassword }}</span>  -->
    </div>

    <div class="form-group">
      <label>Street</label>
      <input type="text" name="street" class="form-control" placeholder="e.g: 800 W Marietta NW" ng-model="formData.street">
      <!-- <span class="help-block" ng-show="errorPassword">{{ errorPassword }}</span>  -->
    </div>


    <div class="form-group col-md-4">
      <label>City</label>
      <input type="text" name="city" class="form-control" placeholder="e.g: Atlanta" ng-model="formData.city">
    </div>


    <div class="form-group col-md-3 ">
      <label>State</label>
      <input type="text" name="state" class="form-control" placeholder="e.g: GA" ng-model="formData.state">
    </div>

    <div class="form-group col-md-4">
      <label>Zipcode</label>
      <input type="text" name="zipcode" class="form-control" placeholder="e.g: 30318" ng-model="formData.zipcode">
    </div>

    <div class="form-group">
      <label>County</label>
      <input type="text" name="county" class="form-control" placeholder="e.g: Fulton" ng-model="formData.county">
    </div>


    <div class="form-group">
      <label>Restaurant Phone</label>
      <input type="text" name="phone" class="form-control" placeholder="e.g: 404-456-1122" ng-model="formData.phone">
    </div>

    <!-- SUBMIT BUTTON -->
    <button type="submit" class="btn btn-success btn-lg btn-block">
      <span class="glyphicon glyphicon-flash"></span> Create!
    </button>
    <br>


    <button class="btn btn-primary btn-lg btn-block" type="button" ng-click="back()">
      <span class="glyphicon glyphicon-user"></span> Cancel and Return
    </button>

  </form>


  <!-- FORM -->

</div>
</div>
</body>
</html>