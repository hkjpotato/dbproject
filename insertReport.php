<?php include 'session.php'; ?>
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

<style type="text/css">
input.score {
    width: 75px;
}

#commentsTable {
  display: none;
}
</style>

<script type="text/javascript">
    <?php echo 'var userInfo = "'.$_SESSION['userInfo'].'";'; ?>
</script>


</head>
<body ng-app="formApp" ng-controller="formController">

<div class="container">
<div class="col-md-10 col-md-offset-1">
  <!-- PAGE TITLE -->
  <div class="page-header">
    <h1><span class="glyphicon glyphicon-eye-open"></span>Inspert Report</h1>
  </div>


  
  <div id="messages" ng-show="message">{{ message }}</div>

  <!-- FORM -->
  <form id="myForm" ng-submit="processForm()">
    <!-- NAME -->

   	<div class="form-group col-md-4">
      <label>Inspector ID</label>
      <input type="text" name="iid" class="form-control" placeholder="e.g: 12345" ng-model="formData.iid">
    </div>


    <div class="form-group col-md-4">
      <label>Restaurant ID</label>
      <input type="text" name="rid" class="form-control" placeholder="e.g: 1" ng-model="formData.rid">
    </div>

    <div class="form-group col-md-4">
      <label>Date</label>
      <input type="text" name="date" class="form-control" placeholder="e.g: 2015-07-11" ng-model="formData.date">
    </div>

	<table id="scoreTable" class="table table-striped table-bordered">
	  <thread>
	    <tr>
	      <th>Item Number</th>
	      <th>Item Description</th> 
	      <th>Critical</th>
	      <th>Score *</th>
	    </tr>
	  </thread>
	  <tbody>
      <tr ng-repeat="x in onetoeightitems">
	      <td>{{ x.itemnum }}</td>
	      <td>{{ x.description }}</td>
	      <td>{{ x.critical }}</td>
	      <td><input type="number" name="score"  min="0" max="9" step="1" class="form-control score" placeholder="0 ~ 9" ng-model="x.score"></td>
	    </tr>
 
	   	<tr ng-repeat="x in ninetofifteenitems">
	      <td>{{ x.itemnum }}</td>
	      <td>{{ x.description }}</td>
	      <td>{{ x.critical }}</td>
	      <td><input type="number" name="score"  min="0" max="4" step="1" class="form-control score" placeholder="0 ~ 4" ng-model="x.score"></td>
	    </tr>
	  </tbody>
	</table>


    <button class="btn btn-info btn-lg btn-block" type="button" ng-click="addcomment()">
      <span class="glyphicon glyphicon-edit"></span> Add comments
    </button>

    <table id="commentsTable" class="table table-striped table-bordered">
      <thread>
        <tr>
          <th>Item Number</th>
          <th>Comments</th> 

        </tr>
      </thread>

      <tbody>
        <tr ng-repeat="x in formData.comments">
          <td>{{ x.itemnum }}</td>
          <td><textarea rows="2" name="comment" class="form-control" placeholder="comment area" ng-model="x.content"></textarea></td>

        </tr>
      
      </tbody>
    </table>
    <br>


    
    <!-- The additional comments part -->


    <!-- SUBMIT BUTTON -->
    <button type="submit" class="btn btn-success btn-lg btn-block">
      <span class="glyphicon glyphicon-flash"></span> Insert Report!
    </button>
    <br>

    <button class="btn btn-primary btn-lg btn-block" type="button" ng-click="return()">
      <span class="glyphicon glyphicon-glass"></span> Cancel and Return
    </button>

  </form>


</div>
</div>
<script>

<!-- WE WILL PROCESS OUR FORM HERE -->

var commentsShow = false;
    // define angular module/app
var formApp = angular.module('formApp', []);

// create angular controller and pass in $scope and $http
function formController($scope, $http) {

  $scope.return = function() {
    location.href='inspectorMenu.php';
  }


  $scope.addcomment = function() {
   if(!commentsShow) {
    $('#commentsTable').slideDown();
    commentsShow = true;
   } else {
    $('#commentsTable').slideUp();
    commentsShow = false;
   }

  }


  //initilize item information

  //items hold itemnum, description, critical
  //formData.items hold itemnum, score

  $scope.items = [];


  for (var i = 0; i < 15; i++) {
  	//declare as an object
  	$scope.items[i] = {};
  }	
    //initialize specific items
  $scope.onetoeightitems = [];
  for (var i = 0; i < 8; i++) {
    //declare as an object
    $scope.onetoeightitems[i] = {};
  } 

  $scope.ninetofifteenitems = [];
  for (var i = 0; i < 7; i++) {
    //declare as an object
    $scope.ninetofifteenitems[i] = {};
  } 


  //preload item information
  var request = $http({
    method: "post",
    // url: "http://localhost:8888/dbphp/test.php",
    url: "getItemProcess.php",
    data: $.param({
      msg: "getItem"
    }),
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
  })
  .success(function (data) {
    console.log("post success and response!");
    $scope.items = data;

    console.log(data);

    // initialize the itemnum & description locally for databinding
    for (var i = 0; i < 15; i++) {
      //declare as an object
      if (i < 8) {
        $scope.onetoeightitems[i].itemnum = $scope.items[i].itemnum;
        $scope.onetoeightitems[i].description = $scope.items[i].description;
        $scope.onetoeightitems[i].critical = $scope.items[i].critical;

      } else {
        //for i from 9 to 14 (item 10 to 15)
        $scope.ninetofifteenitems[i - 8].itemnum = $scope.items[i].itemnum;
        $scope.ninetofifteenitems[i - 8].description = $scope.items[i].description;
        $scope.ninetofifteenitems[i - 8].critical = $scope.items[i].critical;

      }
    }

    console.log($scope.items);


   }); 



  // create a blank object to hold our form information
  // $scope will allow this to pass between controller and view
  $scope.formData = {};
  $scope.formData.iid = userInfo;


  //for comments
  //comments[] {itemnum, content}
  $scope.formData.comments = [];
  for (var i = 0; i < 15; i++) {
    $scope.formData.comments[i] = {};
    $scope.formData.comments[i].itemnum = i + 1;
    $scope.formData.comments[i].content = null;
  }


  $scope.processForm = function() {
  	//preprocess before submission

  	//for general score
  	$scope.formData.totalscore;
  	$scope.formData.passfail;
  	$scope.formData.items = [];

  	var totalscore = 0;

  	var passfail = true;
    $scope.formData.items = [];
  	for (var i = 0; i < 15; i++) {
  		//just assign the itemnum & score to the results
      $scope.formData.items[i] = {};
  		$scope.formData.items[i].itemnum = $scope.items[i].itemnum;



      //get the score from onetoeight and ninetofifteen
      if (i < 8) {
        $scope.formData.items[i].score = $scope.onetoeightitems[i].score;
      } else {
        $scope.formData.items[i].score = $scope.ninetofifteenitems[i - 8].score;
      }





  		totalscore += $scope.formData.items[i].score;

  		//critical item should not be < 8
  		if (i < 8) {
  			if ($scope.formData.items[i].score < 8) {
  				passfail = false;
  			}
  		}
  	}


  	//get the total score
  	$scope.formData.totalscore = totalscore;
  	if (totalscore < 75) {
  		passfail = false;
  	}

    // see if pass fail
    if(passfail) {
      $scope.formData.passfail = 'PASS';
    } else {
      $scope.formData.passfail = 'FAIL';
    }

    console.log($scope.formData.totalscore);
    console.log($scope.formData.passfail);
    console.log($scope.formData);

  	//the formData contains iid, rid, date, totalscore, passfail, items[] {itemnum, score},
  	//the formData also contains comments
    $http({
      method  : 'POST',
      url     : 'insertReportProcess.php',
      data    : $.param($scope.formData),  // pass in data as strings
      headers : { 'Content-Type': 'application/x-www-form-urlencoded' }  // set the headers so angular passing info as form data (not request payload)
     })
      .success(function(data) {
        console.log(data);
        if (!data.success) {
  			$scope.message = data.message;
        } else {
          // if successful, bind success message to message
          $scope.message = data.message;
          console.log( "success to insert!!!!");
          alert('Report has been inserted!');
          document.getElementById("myForm").reset();

          // var guestWindow = window.open("guestMenu.html",'_self');

        }
      });
  };
}

  console.log(userInfo);


 

</script>
</body>
</html>