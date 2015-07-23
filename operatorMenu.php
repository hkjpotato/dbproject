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


</head>
<body>

<div class="container">
<div class="col-md-6 col-md-offset-3">
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