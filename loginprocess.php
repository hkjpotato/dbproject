<?php
session_start();
$errors = array();  // array to hold validation errors
$data = array();        // array to pass back data
$conn;
$username;
$password;


// validate the variables ========
if (empty($_POST['name']))
  $errors['name'] = 'Name is required.';
 
if (empty($_POST['password']))
  $errors['password'] = 'Password is required.';

// return a response ==============

// response if there are errors
if (!empty($errors)) {
  // if there are items in our errors array, return those errors
  $data['success'] = false;
  $data['errors']  = $errors;


} else {

  // if there are no errors, return a message
  // $data['success'] = true;
  // $data['message'] = 'Success!';
  //goto sql query the registered user database
  // Create connection
	$servername = "localhost";
	$dbusername = "root";
	$dbpassword = "1234";
	$dbname = "cs4400";

  	$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$username = $_POST['name'];
	$password = $_POST['password'];

	$data['userName'] = $username;


	$sqlLog ="SELECT COUNT( * ) as user 
	FROM registereduser 
	WHERE username = '"
	. $username
	. "' AND password = '"
	. $password
	. "'";

	// $outp ="";
	$result = $conn->query($sqlLog);

	if ($rs = $result->fetch_array(MYSQLI_ASSOC)) {
		 $data['user'] = $rs["user"];

		 //if user does exit
		 if ($rs["user"] != 0) {
  			$data['success'] = true;
  			$data['message'] = 'Success!';

  			//check whether it is a user or a inspector
			$sqlOp = 
				"SELECT COUNT( * ) as num, email
				FROM operatorowner
				WHERE username
				IN (
				SELECT username
				FROM registereduser
				WHERE username = '"
				. $username
				."' AND PASSWORD = '"
				. $password
				. "')";	

			$sqlIp =
				"SELECT COUNT( * ) as num, iid
				FROM inspector
				WHERE username
				IN (
				SELECT username
				FROM registereduser
				WHERE username = '"
				. $username
				."' AND PASSWORD = '"
				. $password
				. "')";


			$result1 = $conn->query($sqlOp);

			if (($op = $result1->fetch_array(MYSQLI_ASSOC)) && ($op["num"] != 0)) {

				$data['userType'] = "operator";
				$data['userInfo'] = $op["email"];


				$_SESSION['userType'] = "operator";
				$_SESSION['userInfo'] = $op["email"];
				// header("location:operatorMenu.html");
  			   	$data['message'] = 'Operator Login Success!';

			} else {
				$result2 = $conn->query($sqlIp);
				if (($ip = $result2->fetch_array(MYSQLI_ASSOC)) && ($ip["num"] != 0)) {
					$data['userType'] = "inspector";
					$data['userInfo'] = $ip["iid"];
  					$data['message'] = 'Inspector Login Success!';
  					$_SESSION['userType'] = "inspector";
					$_SESSION['userInfo'] = $ip["iid"];
					// header("location:inspectorMenu.html");


				}
			}

		 } else {
		 	//the user does not exit
		 	$data['user'] = $rs["user"];
		 	$data['success'] = false;
  			$errors['name'] = 'Check if name is correct.';
  			$errors['password'] = 'Check if password is correct.';
  			$data['errors']  = $errors;
  			$data['message'] = 'Cannot find the user!';


		 }


	}

	$conn->close();

}

// return all our data to an AJAX call
echo json_encode($data);

?>

