<?php include 'session.php'; ?>

<!DOCTYPE html>
<html >
<style>
#result {
  display: none;
  margin-left: -40%; 
  width: 180%;
}

.infoPanel {
  width: 90%;
  margin-left: 5%;
  margin-top: 2%;
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
<div class="col-md-6 col-md-offset-3">
  <!-- PAGE TITLE -->
<div class="page-header">
    <h1><span class="glyphicon glyphicon-glass"></span>Monthly Report</h1>
  </div>
<div class="app" ng-app="myApp" ng-controller="customersCtrl">


<div id="criteria">
<form class="form">

<div class="form-group col-md-5">
  <label>Enter Month</label>
  <input type="text" name="month" class="form-control" placeholder="e.g: 3" ng-model="formData.month">
</div>

<div class="form-group col-md-5">
  <label>Enter Year</label>
  <input type="text" name="year" class="form-control" placeholder="e.g: 2015" ng-model="formData.year">
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



<p>Total Inspected : <strong><font color="#5281ff">{{totalinspected}}</font></strong>   Total Failed: <strong><font color="#FF4C4C">{{totalfail}}</font></font></p>
<br>
<div class="panel panel-primary" ng-repeat="x in counties">
  <div class="panel-heading large"><strong>{{x.name}}</strong> </div>
  	<p class="infoPanel">Number of Inspection: <font color="#5281ff">{{x.subinspected}}</font> Number of Fail: <font color="#FF4C4C">{{x.subfail}}</font></p>
  	<div class="panel panel-info infoPanel">
	<table class="table table-striped table-bordered">
	  <thread>
	    <tr>
	      <th>Cuisine</th>
	      <th>Number of Inspected</th> 
	      <th>Number of Failed</th>
	    </tr>
	  </thread>
	  <tbody>
	    <tr ng-repeat="y in x.cuisines">
	      <td>{{ y.cuisine }}</td>
	      <td>{{ y.numinspected }}</td>
	      <td>{{ y.numfail }}</td>
	    </tr>
	  </tbody>
	</table>
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
      $scope.counties = null;
      $scope.totalinspected = null;
      $scope.totalfail = null;


      $("#criteria").slideUp();
      $("#result").slideDown();

      var request = $http({
        method: "post",
        url: "MYProcess.php",
        data: $.param($scope.formData),
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
      });
       request.success(function (data) {
        $scope.formData = null;
        $scope.counties = data.counties;
        $scope.totalinspected = data.totalinspected;
        $scope.totalfail = data.totalfail;
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

