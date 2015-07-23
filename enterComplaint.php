<?php

// header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");
// ssh academic-mysql.cc.gatech.edu khuang66 


$errors = array();  // array to hold validation errors
$data = array();        // array to pass back data
$conn;


// validate the variables ========
if (empty($_POST['date']))
  $errors['date'] = 'date is required.';
 
if (empty($_POST['firstName']))
  $errors['firstName'] = 'first name is required.';

if (empty($_POST['lastName']))
  $errors['firstName'] = 'last name is required.';

if (empty($_POST['complaint']))
  $errors['complaint'] = 'complaint is required.';

if (empty($_POST['phone']))
  $errors['phone'] = 'phone is required.';



// return a response ==============

// response if there are errors
if ( !empty($errors)) {
  // if there are items in our errors array, return those errors
  $data['success'] = false;
  $data['errors']  = $errors;
  $data['message'] = 'Sorry, fail to submit the complaint!';

} else {

  // if there are no errors, return a message
  // $data['success'] = true;
  // $data['message'] = 'Success!';
  //goto sql query the registered user database
  // Create connection

	$servername = "localhost";
	$dbusername = "root";
	$dbpassword = "root";
	$dbname = "cs4400";

  	$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$rid = $_POST['rid'];
	$date = $_POST['date'];
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$phone = $_POST['phone'];
	$complaint = $_POST['complaint'];

	// $phone = '6669666';
	// $date='2012-09-10';
	// $complaint='haha';
	// $firstName = 'kj';
	// $lastName = 'kj';




	$sqlCustomer = "INSERT INTO customer
	VALUES ('"
	. $phone
	. "','"
	. $firstName
	. "','"
	. $lastName
	. "')";


	$sqlComplaint = "INSERT INTO complaint
	VALUES ('"
	. $rid
	. "','"
	. $phone
	. "','"
	. $date
	. "','"
	. $complaint
	. "')";


// $sqlComplaint = "INSERT INTO complaint
// VALUES ('1', '55555', '2019-09-19','hahahahaah')";

// $sqlCustomer = "INSERT INTO customer VALUES ('55555', 'kaijie', 'huang' )";

	$result1 = $conn->query($sqlCustomer);
	$result2 = $conn->query($sqlComplaint);

	if ($result1 && $result2) {
  		$data['message'] = 'Submit success!';
  		$data['success'] = true;

  		$data['rid'] = $rid;
  		$data['firstName'] = $complaint;

	} else {
  		$data['message'] = 'Submit fail!';
  		// $data['message']
  		$data['success'] = false;
  		$data['phone'] = $phone;


	}

	$conn->close();

}

// return all our data to an AJAX call
echo json_encode($data);

?>