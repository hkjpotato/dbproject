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

	
	//The only criteria we gain from the post
    $rid = $_POST['rid'];

    //first get the inspection result


    $sqlInspection = "select idate, totalscore, passfail from inspection where rid = '"
	.$rid
	."' order by idate desc";

	$inspection = $conn->query($sqlInspection);

	$count = 0;
	while ($rs = $inspection->fetch_array(MYSQLI_ASSOC) ) {
	    //output data of each row
	    $data[$count] = array();
	    $data[$count]['date'] = $rs['idate'];
	    $data[$count]['totalscore'] = $rs['totalscore'];
	    $data[$count]['passfail'] = $rs['passfail'];
	    $count++;
	} 

	for ($i = 0; $i < sizeof($data); $i++) {
		//get the scores for each inspection
		$data[$i]['scores'] = array();

		//get the date of the inspection, use it together with rid as criteria
		$date = $data[$i]['date'];

		$sqlScore = "SELECT score from contains where rid = '"
		.$rid
		."' and idate = '"
		.$date
		."' order by itemnum asc";

		$scores = $conn->query($sqlScore);

		$itemnum = 0;
		while ($rs = $scores->fetch_array(MYSQLI_ASSOC) ) {
		    //output data of each row
		    $data[$i]['scores'][$itemnum] = $rs['score'];
		    $itemnum++;
		} 
	}

	$conn->close();

	echo json_encode($data);

?> 

