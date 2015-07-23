<?php include 'session.php'; ?>

<!DOCTYPE html>
<html >
<style>
#result {
  display: none;
/*  margin-left: -40%; 
  width: 180%;*/
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
    <h1><span class="glyphicon glyphicon-glass"></span>Yearly County Report</h1>
  </div>
<div class="app" ng-app="myApp" ng-controller="customersCtrl">

<div id="criteria">
<form class="form">

<div class="form-group col-md-5">
  <label>Enter Year</label>
  <input type="text" name="year" class="form-control" placeholder="e.g: 2015" ng-model="formData.year">
</div>

<div class="form-group col-md-5">
  <label>Enter County</label>
  <input type="text" name="month" class="form-control" placeholder="e.g: Fulton" ng-model="formData.county">
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

<table class="table table-striped table-bordered">
  <thread>
    <tr>
      <th>Month</th>
      <th>Restaurant Inspected</th> 
    </tr>
  </thread>
  <tbody>
    <tr ng-repeat="x in records">
      <td>{{ x.month }}</td>
      <td>{{ x.inspected }}</td>
    </tr>
    <tr >
      <td>Grand Total</td>
      <td>{{total}}</td>
    </tr>
  </tbody>
</table>


<button id="backBtn" type="button" class="btn btn-primary btn-lg btn-block" ng-click="back()" >
  Back
</button>
</div>

</div>
</div>
<div>


<script>

function getMonth(data) {
  var a = parseInt(data);
  var b = '';
  switch(a) {
    case 1: b = "January";
        break;
    case 2: b = "February";
        break;
    case 3: b = "March";
        break;
    case 4: b = "April";
        break;
    case 5: b = "May";
        break;
    case 6: b = "June"; 
        break;
    case 7: b = "July";
        break;
    case 8: b = "August";
        break;
    case 9: b = "September";
        break;
    case 10: b = "October";
        break;
    case 11: b = "November";
        break;
    case 12: b = "December";
        break;
  }
  return b;

}
var app = angular.module('myApp', []);
app.controller('customersCtrl', function($scope, $http, $window) {

  $scope.return = function() {
    location.href='inspectorMenu.php';
  }

  console.log(userInfo);



  $scope.submit = function() {

      $("#criteria").slideUp();
      $("#result").slideDown();

      var request = $http({
        method: "post",
        url: "YCProcess.php",
        data: $.param($scope.formData),
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
      });
       request.success(function (data) {
        $scope.records = data;
        var total = 0;
        for (var i = 0; i < data.length; i++) {
          data[i].month = getMonth(data[i].month);
          total += parseInt(data[i].inspected);
        }
        $scope.total = total;
       }); 
   
  }

  $scope.back = function() {
      $("#criteria").slideDown();
      $("#result").slideUp();
  }

});


</script>
 
</body>
</html>

