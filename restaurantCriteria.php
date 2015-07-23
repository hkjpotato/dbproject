<?php 
// header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");
	// ssh academic-mysql.cc.gatech.edu khuang66 
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "cs4400";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	
   //Collect all Details from Angular HTTP Request.
    // $postdata = file_get_contents("php://input");
    // $postdata = $_POST;
    // $request = json_decode($postdata);



	// echo$_POST[''];

    $scoreCriteria = $_POST['scoreCriteria'];
    // $scoreCriteria = $request->scoreCriteria;


    $zipcode = $_POST['zipcode'];
    // $zipcode = $request->zipcode;

	$criteria = "WHERE " 
	."ifinal.totalscore " . $scoreCriteria
	." AND r.zipcode = '" . $zipcode ."'";

	// if ($_POST['name'] !="") {
	// 	$name = $_POST['name'];
	// 	$criteria .= " AND r.name = '" .$name ."'";
	// }

	if (!empty($_POST['name'])) {
		$name = $_POST['name'];
		$criteria .= " AND r.name = '" .$name ."'";
	}


	if (!empty($_POST['cuisine'])) {
		$cuisine = $_POST['cuisine'];
		$criteria .= " AND r.cuisine = '" .$cuisine ."'";
	}


	$sql = "SELECT r.name AS Restaurant, CONCAT( r.county, '  ', r.street, '  ', r.city, '  ',r.state, '  ', r.zipcode ) AS Address, r.cuisine AS Cuisine, ifinal.totalscore AS 'Last Inspection Score', ifinal.idate AS 'Date of Last Inspection'
	FROM restaurant AS r
	NATURAL JOIN (
	SELECT i.rid, i.idate, i.totalscore
	FROM inspection AS i
	NATURAL JOIN (
	SELECT rid, MAX( idate ) idate
	FROM inspection
	GROUP BY rid
	) imaxdate
	) AS ifinal "
	. $criteria
	. " ORDER BY ifinal.totalscore DESC";

	$outp ="";
	$result = $conn->query($sql);
	while ($rs = $result->fetch_array(MYSQLI_ASSOC) ) {
	    //output data of each row
	    if ($outp != "") {
	    	$outp .= ",";
	    }

	    $outp .= '{"restaurant":"' . $rs["Restaurant"] .'",';
	    $outp .= '"address":"' . $rs["Address"] .'",';
	    $outp .= '"cuisine":"' . $rs["Cuisine"] .'",';
	    $outp .= '"lastInspectionScore":"' . $rs["Last Inspection Score"] .'",';
	    $outp .= '"dateOfLastInspection":"' . $rs["Date of Last Inspection"] .'"}';

	} 
	$outp = '{"records":['.$outp.']}';
	$conn->close();

	echo($outp);

?> 

