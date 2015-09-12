<?php include 'session.php'; ?>
<!-- index.html -->
<!doctype html>
<html>
<head>
  <title>Angular Forms</title>

  <!-- LOAD BOOTSTRAP CSS -->
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css">


<script type="text/javascript">
    <?php echo 'var userInfo = "'.$_SESSION['userInfo'].'";'; ?>
</script>
<style type="text/css">
  .container {
      position: absolute;

      /*margin-top: 10px;*/
      width: 374px;
      height: 510px;
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

</head>
<body>

<div class="container">
<div class="col-md-6 col-md-offset-3">
  <!-- PAGE TITLE -->
  <div class="page-header">
    <h1><span class="glyphicon glyphicon-eye-open"></span> Inspector Menu</h1>
  </div>

  <button type="button" class="btn btn-success btn-lg btn-block" onClick="create()">
    <!-- <span class="glyphicon glyphicon-user"></span> --> Insert a report
  </button>
  <br>
  <button type="button" class="btn btn-info btn-lg btn-block" onClick="showMY()">
    <!-- <span class="glyphicon glyphicon-user"></span> --> Summary by Month/Year
  </button>
  <br>
  <button type="button" class="btn btn-info btn-lg btn-block" onClick="showYC()">
    <!-- <span class="glyphicon glyphicon-user"></span> --> Summary by Year/County
  </button>
  <br>
  <button type="button" class="btn btn-info btn-lg btn-block" onClick="showYCR()">
    <!-- <span class="glyphicon glyphicon-user"></span> --> Summary by Year/County (Top Rate)
  </button>
  <br>
  <button type="button" class="btn btn-info btn-lg btn-block" onClick="showCS()">
    <!-- <span class="glyphicon glyphicon-user"></span> --> Summary by Complaints/Score
  </button>
  <br>
  <button type="button" class="btn btn-default btn-lg btn-block" onClick="back()">
    <span class="glyphicon glyphicon-flash"></span> Exit
  </button>
</div>
</div>
<script>

  console.log(userInfo);

  function create() {
    location.href='insertReport.php';

  } 

  function showMY() {
    location.href='inspectorDisplayMY.php';

  }
  function showYC() {
    location.href='inspectorDisplayYC.php';

  }
  function showYCR() {
    location.href='inspectorDisplayYCR.php';
  }
  function showCS() {
    //bug
    location.href='inspectorDisplayCS.php';
  }
  function back() {
    // var guestSearchWindow = window.open("index.html","_self");
    location.href='logout.php';

  } 

</script>
</body>
</html>