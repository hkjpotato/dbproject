<?php
include('session.php');
?>
<!-- index.html -->
<!doctype html>
<html>
<head>
  <title>Angular Forms</title>


<style>
#result {
  display: none;
  margin-left: -40%; 
  width: 180%;
}

</style>


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

  //initilize item information
  //items hold itemnum, description, critical
  //formData.items hold itemnum, score
  //preload item information
    $scope.items = [];

    var request = $http({
      method: "post",
      url: "getItemProcess.php",
      data: $.param({
        msg: "getItem"
      }),
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
    })
    .success(function (data) {
      console.log("post success and response!");
      $scope.items = data;
      // console.log(data);
     }); 


      $scope.return = function() {
        location.href='operatorMenu.php';
      }


      // create a blank object to hold our form information
      // $scope will allow this to pass between controller and view

      $scope.records = [];
      for (var i = 0; i < 15; i++) {
        $scope.records[i] = {};
      }


      var request = $http({
        method: "post",
        // url: "http://localhost:8888/dbphp/test.php",
        url: "getOperatorRestaurants.php",
        data: $.param({
          userInfo: userInfo
        }),
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
      })
      .success(function (data) {
        console.log("post success and response!");
        $scope.restaurants = data;
        // console.log($scope.restaurants[0]);
        $scope.selected = $scope.restaurants[0];
       }); 



      $scope.submit = function() {
        // console.log($scope.selected.rid);
        
        $("#criteria").slideUp();
        $("#result").slideDown();

        var request = $http({
          method: "post",
          // url: "http://localhost:8888/dbphp/test.php",
          url: "showOperatorRestaurantProcess.php",
          data: $.param({
            rid: $scope.selected.rid
          }),
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
        });
          
         request.success(function (data) {
            //clear data anyway
            $scope.firstDate = null;
            $scope.firstTotal = null;
            $scope.firstPassFail = null;

            $scope.secondDate = null;
            $scope.secondTotal = null;
            $scope.secondPassFail = null;





            for (var i = 0; i < 15; i++) {
              $scope.records[i].firstScore = null;
              $scope.records[i].secondScore = null;

            }

            
            
              console.log(data);
              $scope.reportNum = data.length;
              if (data.length != 0) {
                  $scope.firstDate = data[0].date;
                  $scope.firstTotal = data[0].totalscore;
                  $scope.firstPassFail = data[0].passfail;



                  if (data.length > 1) {
                    $scope.secondDate = data[1].date;
                    $scope.secondTotal = data[1].totalscore;
                    $scope.secondPassFail = data[1].passfail;
                  }


                  // console.log(data);
                  for (var i = 0; i < 15; i++) {

                    $scope.records[i].itemNo = $scope.items[i].itemnum;
                    $scope.records[i].description = $scope.items[i].description;
                    $scope.records[i].firstScore = data[0].scores[i];
                    if (data.length > 1) {
                      $scope.records[i].secondScore = data[1].scores[i];
                    }
                  }

            }
          
         }); 

      }


      $scope.back = function() {
          $("#criteria").slideDown();
          $("#result").slideUp();
      }

    }

  </script>
</head>
<body ng-app="formApp" ng-controller="formController">
<div class="container">
<div class="col-md-6 col-md-offset-3">

  <!-- PAGE TITLE -->
  <div class="page-header">
    <h1><span class="glyphicon glyphicon-cutlery"></span> Show your restaurant's report! </h1>
  </div>

<div id="criteria">
  <div id="selected restaurant" ><strong>{{ selected.name }}</strong> with id <strong>{{selected.rid}}</strong> is selected!</div>

  <select 
  ng-options="item.info for item in restaurants" 
  ng-model="selected"
  class="form-control">
  </select>

  <br>
  <br>

  <button id="submitBtn" type="button" class="btn btn-success btn-lg btn-block" ng-click="submit()" >
    <span class="glyphicon glyphicon-flash"></span> Show Report!
  </button>

  <button class="btn btn-primary btn-lg btn-block" type="button" ng-click="return()">
    <span class="glyphicon glyphicon-user"></span> Cancel and Return
  </button>
</div>


  <!-- SHOW ERROR/SUCCESS MESSAGES -->
  <div id="messages" ng-show="message">{{ message }}</div>






<div id="result">

<table class="table table-striped table-bordered">
  <thread>
    <tr>

      <th>Item Number</th>
      <th>Item Description</th> 
      <th>{{firstDate}}</th>
      <th>{{secondDate}}</th>


    </tr>
  </thread>
  <tbody>
    <tr ng-repeat="x in records">
      <td>{{ x.itemNo }}</td>
      <td>{{ x.description }}</td>
      <td>{{ x.firstScore }}</td>
      <td>{{ x.secondScore }}</td>
    </tr>
    <tr>
      <td>Total Score</td>
      <td></td>
      <td>{{ firstTotal }}</td>
      <td>{{ secondTotal }}</td>
    </tr>
    <tr>
      <td>Result</td>
      <td></td>
      <td>{{ firstPassFail }}</td>
      <td>{{ secondPassFail }}</td>
    </tr>
  </tbody>
</table>


<button id="backBtn" type="button" class="btn btn-primary btn-lg btn-block" ng-click="back()" >
  Back
</button>

</div>


</div>
</div>
</body>
</html>