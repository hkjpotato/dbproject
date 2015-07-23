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

	
	$userInfo = $_POST['userInfo'];
    // $msg = $_POST['msg'];

	$sql = "SELECT rid, name, CONCAT(rid, '  ', name, ' ', street, ' ', city, ' ', state, ' ', zipcode) AS info 
	FROM restaurant
	WHERE email = '"
	.$userInfo
	."'";



	$result = $conn->query($sql);
	$count = 0;
	while ($rs = $result->fetch_array(MYSQLI_ASSOC) ) {
	    //output data of each row
	    $data[$count] = array();
	    $data[$count]['rid'] = $rs['rid'];
	    $data[$count]['name'] = $rs['name'];
	    $data[$count]['info'] = $rs['info'];
	    $count++;

	} 

	$conn->close();

	echo json_encode($data);


?> 
