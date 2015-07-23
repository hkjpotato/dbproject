<?php 
// header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");
	// ssh academic-mysql.cc.gatech.edu khuang66 
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "cs4400";
	$data= array();


  	$data['success'] = false;
  	$data['message'] = "";


	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	//The only criteria we gain from the post
    $rid = $_POST['rid'];
    $iid = $_POST['iid'];
    $date = $_POST['date'];
    $items = $_POST['items'];
    $comments = $_POST['comments'];
    $totalscore = $_POST['totalscore'];
    $passfail = $_POST['passfail'];


    $sqlInspection = "INSERT INTO inspection VALUES ("
    .$rid
    .","
    .$iid
    .",'"
    .$date
    ."',"
    .$totalscore
    .",'"
    .$passfail
    ."')";



	$sqlContains = "INSERT INTO contains (itemnum, rid, idate, score) VALUES ";

	for ($i = 0; $i < sizeof($items); $i++) {
		if ($i != 0) {
			$sqlContains = $sqlContains.",";
		}
		$sqlContains = $sqlContains
		."("
		.$items[$i]['itemnum']
		.","
		.$rid
		.",'"
		.$date
		."',"
		.$items[$i]['score']
		.")";
	}
	$haveComments = 0;
	$sqlIncludes;
	//see if comments exist
	if (sizeof($comments) != 0) {
		$sqlIncludes = "INSERT INTO `includes` (itemnum, rid, idate, comment) VALUES ";

		for ($i = 0; $i < sizeof($comments); $i++) {
			//check if it is a valid comment
			$content = trim($comments[$i]['content']);
			if (!empty($content)) {

				$haveComments = 1;

				if ($i != 0) {
					$sqlIncludes = $sqlIncludes.",";
				}
				$sqlIncludes = $sqlIncludes
				."("
				.$comments[$i]['itemnum']
				.","
				.$rid
				.",'"
				.$date
				."','"
				.$content
				."')";
			}
		}

	}

	$result1 = $conn->query($sqlInspection);

	if ($result1) {
		$result2 = $conn->query($sqlContains);
		if ($result2) {
			if ($haveComments == 1) {
				$result3 = $conn->query($sqlIncludes);
				if ($result3) {
					$data['message'] = "Insert Success with comments!";
					$data['success'] = true;
				} else {
					$data['message'] = "fail to insert into includes!";
				}
			} else {
				$data['message'] = "Insert Success!";
				$data['success'] = true;
			}

		} else {
  			$data['message'] = "fail to insert into contains!";
		}
	} else {
  		$data['message'] = "fail to insert into inspection!";
	}


	$conn->close();

	echo json_encode($data);

?> 