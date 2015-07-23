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
	$county = $_POST['county'];


	$sql = "SELECT MONTH(i.idate) AS month, COUNT(*) as inspected
	FROM restaurant AS r,inspection AS i
	WHERE YEAR(idate) = "
	.$year
	." and r.county = '"
	.$county
	."' and i.rid = r.rid 
	GROUP BY MONTH(i.idate)";

	$result = $conn->query($sql);
	$count = 0;
	while ($rs = $result->fetch_array(MYSQLI_ASSOC) ) {
	    //output data of each row
	    $data[$count] = array();
	    $data[$count]['month'] = $rs['month'];
	    $data[$count]['inspected'] = $rs['inspected'];
	    $count++;

	} 

	$conn->close();

	echo json_encode($data);


?> 