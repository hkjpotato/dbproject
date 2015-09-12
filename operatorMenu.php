<?php
include('session.php');
?>
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
      height: 490px;
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
<div class="col-md-12 col-md-offset-0">
  <!-- PAGE TITLE -->
  <div class="page-header">
    <h1><span class="glyphicon glyphicon-user"></span> Operator Menu</h1>
  </div>




  <button type="button" class="btn btn-success btn-lg btn-block" onClick="create()">
    <!-- <span class="glyphicon glyphicon-user"></span> --> Creat a new restaurant!
  </button>
  <br>
  <button type="button" class="btn btn-danger btn-lg btn-block" onClick="show()">
    <!-- <span class="glyphicon glyphicon-user"></span> --> Show your reports
  </button>
  <br>
  <br>
  <button type="button" class="btn btn-default btn-lg btn-block" onClick="back()">
    <span class="glyphicon glyphicon-flash"></span> Exit
  </button>
</div>
</div>
<script>

  console.log(userInfo);

  function create() {
    location.href='createRestaurant.php';

  } 

  function show() {
    location.href='operatorShowReport.php';

  }
  function back() {
    // var guestSearchWindow = window.open("index.html","_self");
    location.href='logout.php';

  } 

</script>
</body>
</html>