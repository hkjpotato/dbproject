<?php 
// header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");
	// ssh academic-mysql.cc.gatech.edu khuang66 
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "cs4400";
	$data= array();

    $msg = $_POST['msg'];

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 


	$sqlItem = "SELECT itemnum, description, critical from item";

	$result = $conn->query($sqlItem);
	$count = 0;
	while ($rs = $result->fetch_array(MYSQLI_ASSOC)) {
	    //output data of each row
	    $data[$count] = array();
	    $data[$count]['itemnum'] = $rs['itemnum'];
	    $data[$count]['description'] = $rs['description'];
	    $data[$count]['critical'] = $rs['critical'];
	    $count++;
	} 

	$conn->close();

	echo json_encode($data);

?> 
