<?php include 'session.php'; ?>

<!DOCTYPE html>
<html >
<style>
#result {
  display: none;
/*  margin-left: -40%; 
  width: 180%;*/
}

.complaintPanel {
  width: 90%;
  margin-left: 5%;
  margin-top: 2%;
}

.infoList {
  width: 90%;
  margin-left: 5%;
  margin-top: 2%;


}


  .container {
      position: absolute;

      /*margin-top: 10px;*/
      width: 374px;
      /*height: 490px;*/
      margin-top: 20px;
      left: 50%;
      margin-left: -187px;
      /*left: 50%;*/
      /*margin-top: 5%;*/

      /*margin-left: 10%;*/
      /*background: #5db2df;*/
      /*background: #EDEFF2;*/
      border-radius: 12px;
      box-shadow: 0 2px 20px rgba(0,0,0,0.15);
      overflow: hidden;
    }

</style>
<script src= "http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<script type="text/javascript">
    <?php echo 'var userInfo = "'.$_SESSION['userInfo'].'";'; ?>
</script>

<body>


<div class="container">
<div class="col-md-12 col-md-offset-0">
  <!-- PAGE TITLE -->
<div class="page-header">
    <h1><span class="glyphicon glyphicon-glass"></span>Restaurants with Complaints </h1>
  </div>
<div class="app" ng-app="myApp" ng-controller="customersCtrl">


<div id="criteria">
<form class="form">

<div class="form-group col-md-3 col-md-offset-1">
  <label>Enter Year</label>
  <input type="text" name="year" class="form-control" placeholder="e.g: 2015" ng-model="formData.year">
</div>

<div class="form-group col-md-4">
  <label>Enter Min Complaints</label>
  <input type="number" name="mincompl" step="1" class="form-control" placeholder="e.g: 2" ng-model="formData.mincompl">
</div>

<div class="form-group col-md-3">
  <label>Enter Max Score</label>
  <input type="number" name="maxscore" class="form-control"  min="0" max="120" step="1" placeholder="e.g: 75" ng-model="formData.maxscore">
</div>

<button id="submitBtn" type="button" class="btn btn-success btn-lg btn-block" ng-click="submit()" >
 <span class="glyphicon glyphicon-flash"></span> Start Searching!
</button>

<button class="btn btn-primary btn-lg btn-block" type="button" ng-click="return()">
  <span class="glyphicon glyphicon-user"></span> Cancel and Return
</button>


</form>
</div>

<div id="result">



<div class="panel panel-primary" ng-repeat="x in records">
  <div class="panel-heading large">{{x.name}} owned by {{x.operator}}</div>

  <div class="list-group infoList">
    <div  class="list-group-item">
      <h4 class="list-group-item-heading small">Address</h4>
      <p class="list-group-item-text small">{{x.address}}</p>
    </div>

    <div  class="list-group-item">
      <h4 class="list-group-item-heading small">Operator Email</h4>
      <p class="list-group-item-text">{{x.email}}</p>
    </div>

    <div  class="list-group-item">
      <h4 class="list-group-item-heading small">Score and # Complaints</h4>
      <p class="list-group-item-text medium">Rate at <strong><font color="#5281ff">{{x.score}}</font></strong> with <strong><font color="#FF4C4C">{{x.numcompl}}</font></strong> complaints!</p>
    </div>
  </div>


  <div class="panel panel-info complaintPanel">
    <div class="panel-heading">Customer Complaints</div>
      <ul>
        <li  ng-repeat="y in x.complaints">{{y}}</li>
      </ul>
  </div>
</div>



<button id="backBtn" type="button" class="btn btn-warning btn-lg btn-block" ng-click="back()" >
  Back
</button>

</div>

</div>
</div>
<div>


<script>

var app = angular.module('myApp', []);
app.controller('customersCtrl', function($scope, $http, $window) {

  $scope.return = function() {
    location.href='inspectorMenu.php';
  }

  $scope.submit = function() {
      $scope.records = null;
      $("#criteria").slideUp(1000);
      $("#result").slideDown();

      var request = $http({
        method: "post",
        url: "CSProcess.php",
        data: $.param($scope.formData),
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
      });
       request.success(function (data) {
        $scope.records = data;
        console.log(data);
       }); 
  }

  $scope.back = function() {
      $("#criteria").slideDown();
      $("#result").slideUp(1000);
  }

});


</script>
 
</body>
</html>
