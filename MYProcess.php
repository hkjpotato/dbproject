<?php 

// header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");
	// ssh academic-mysql.cc.gatech.edu khuang66 
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "cs4400";
	$data= array();
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	
	$year = $_POST['year'];
	$month = $_POST['month'];

	//get the county
	$county = array();
	$sql_query = "Select distinct county as county From restaurant order by county asc";
	$resultCounty = $conn->query($sql_query);
	$count = 0;
	while ($rs = $resultCounty->fetch_array(MYSQLI_ASSOC) ) {
	    //output data of each row
	    $county[$count] = $rs['county'];
	    $count++;
	} 


	//get the county
	$cuisine = array();
	$sql_query = "Select distinct cuisine as cuisine From cuisines order by cuisine asc";
	$resultCuisine = $conn->query($sql_query);
	$count = 0;
	while ($rs = $resultCuisine->fetch_array(MYSQLI_ASSOC) ) {
	    //output data of each row
	    $cuisine[$count] = $rs['cuisine'];
	    $count++;
	} 


	//initialize data
	$totalinspected = 0;
	$totalfail = 0;


	$data['counties'] = array();


	for ($i = 0; $i < sizeof($county); $i++)  {
		$subfail = 0;
		$data['counties'][$i] = array();
		$data['counties'][$i]['name'] = $county[$i];
		$data['counties'][$i]['subinspected'] = 0;
		// $data['counties'][$i]['subfail'] = 0;
		$data['counties'][$i]['cuisines'] = array();

		for ($j = 0; $j < sizeof($cuisine); $j++) {

			$data['counties'][$i]['cuisines'][$j] = array();
			$data['counties'][$i]['cuisines'][$j]['cuisine'] = $cuisine[$j];


			$sqlInspected = "SELECT r.rid FROM restaurant AS r, inspection AS i WHERE r.rid = i.rid AND MONTH( i.idate ) ='".$month."' AND YEAR( i.idate ) ='".$year."'AND r.county ='".$county[$i]."'AND r.cuisine ='".$cuisine[$j]."'";

			$inspectedResult = $conn->query($sqlInspected);

			$numinspected =  mysqli_num_rows($inspectedResult);


			$data['counties'][$i]['cuisines'][$j]['numinspected'] = $numinspected;
			$data['counties'][$i]['subinspected'] += $numinspected;
			$totalinspected += $numinspected;

			$sqlFail = 
			"SELECT r.rid
			FROM restaurant AS r, inspection AS i
			WHERE r.rid = i.rid
			AND MONTH( i.idate ) = '".$month."'
			AND YEAR( i.idate ) = '".$year."'
			AND r.county = '".$county[$i]."'
			AND r.cuisine = '".$cuisine[$j]."'
			AND i.passfail = 'FAIL'";
			
			$failResult = $conn->query($sqlFail);
			$numfail = mysqli_num_rows($failResult);
			$data['counties'][$i]['cuisines'][$j]['numfail'] = $numfail;
			$subfail += $numfail;
			$totalfail += $numfail;
		}

		$data['counties'][$i]['subfail'] = $subfail;
	}

	$data['totalfail'] = $totalfail;
	$data['totalinspected'] = $totalinspected;






	$conn->close();

	echo json_encode($data);


?> 