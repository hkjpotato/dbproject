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
	$sql = "SELECT r.cuisine AS cuisine, r.name AS name, CONCAT( r.street, ' ', r.city, ' ', r.state, ' ', r.zipcode ) AS address, i.totalscore AS score
	FROM restaurant AS r, inspection AS i, (

	SELECT cuisine, MAX( totalscore ) AS ma
	FROM inspection
	NATURAL JOIN restaurant
	WHERE YEAR( idate ) = "
	.$year
	." AND county = '"
	.$county
	."'GROUP BY cuisine
	)temp
	WHERE YEAR( idate ) = "
	.$year
	." AND county = '"
	.$county
	."'AND i.rid = r.rid AND r.cuisine = temp.cuisine
	AND temp.ma = i.totalscore
	GROUP BY r.cuisine
	ORDER BY r.cuisine";



	// $sql = "SELECT r.cuisine AS cuisine, r.name AS name,CONCAT(r.street, ' ', r.city, ' ', r.state, ' ', r.zipcode) AS address, MAX(i.totalscore) as score FROM restaurant AS r,inspection AS i WHERE YEAR(idate) = "
	// .$year
	// ." and r.county = '"
	// .$county
	// ."' and i.rid = r.rid GROUP BY r.cuisine";

	$result = $conn->query($sql);
	$count = 0;
	while ($rs = $result->fetch_array(MYSQLI_ASSOC) ) {
	    //output data of each row
	    $data[$count] = array();
	    $data[$count]['cuisine'] = $rs['cuisine'];
	    $data[$count]['name'] = $rs['name'];
	    $data[$count]['address'] = $rs['address'];
	    $data[$count]['score'] = $rs['score'];
	    $count++;

	} 

	$conn->close();

	echo json_encode($data);


?> 