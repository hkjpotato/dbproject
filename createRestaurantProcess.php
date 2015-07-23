<?php


$errors = array();  // array to hold validation errors
$data = array();        // array to pass back data
$conn;


// validate the variables ========
if (empty($_POST['hpID']))
  $errors['hpID'] = 'health permit ID is required.';
 
if (empty($_POST['hpIDDate']))
  $errors['hpIDDate'] = 'xxx is required.';

if (empty($_POST['cuisine']))
  $errors['cuisine'] = 'xxx is required.';

if (empty($_POST['name']))
  $errors['complaint'] = 'xxx is required.';

if (empty($_POST['street']))
  $errors['street'] = 'xxx is required.';

if (empty($_POST['city']))
  $errors['city'] = 'xxx is required.';

if (empty($_POST['state']))
  $errors['state'] = 'xxx is required.';


if (empty($_POST['zipcode']))
  $errors['zipcode'] = 'xxx is required.';

if (empty($_POST['county']))
  $errors['county'] = 'xxx is required.';

if (empty($_POST['phone']))
  $errors['phone'] = 'xxx is required.';

// return a response ==============

// response if there are errors
if ( !empty($errors)) {
  // if there are items in our errors array, return those errors
  $data['success'] = false;
  $data['errors']  = $errors;
  $data['message'] = 'Sorry, fail to create the restaurant!';

} else {
	$servername = "localhost";
	$dbusername = "root";
	$dbpassword = "root";
	$dbname = "cs4400";

  	$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$phone = $_POST['phone'];
	$name = $_POST['name'];
	$county = $_POST['county'];
	$street = $_POST['street'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$zipcode = $_POST['zipcode'];
	$cuisine = $_POST['cuisine'];
	$email = $_POST['email'];

	$hpID = $_POST['hpID'];
	$hpIDDate = $_POST['hpIDDate'];


	$sqlRestaurant = 
	"INSERT INTO restaurant
	VALUES (
	(
	SELECT COUNT(m.rid ) +1
	FROM restaurant as m
	), '"
	. $phone
	. "','"
	. $name
	. "','"
	. $county
	. "','"
	. $street
	. "','"
	. $city
	. "','"
	. $state
	. "','"
	. $zipcode
	. "','"
	. $cuisine
	. "','"
	. $email
	. "')";

	$sqlHP = 
	"INSERT INTO healthpermit
	VALUES ('"
	.$hpID
	. "','"
	.$hpIDDate
	. "',(
	SELECT MAX(rid) 
	FROM restaurant
	)
	)";


	$result1 = $conn->query($sqlRestaurant);

	//attention to the query order
	if ($result1) {
		$result2 = $conn->query($sqlHP);
		if ($result2) {
	  		$data['message'] = 'New Restaurant Created!';
	  		$data['success'] = true;

	  		// $data['rid'] = $rid;
	  		// $data['firstName'] = $complaint;
  		} else {
  			$data['message'] = 'fail to insert into healthpermit table';
  			// $data['message']
  			$data['success'] = false;
  		}
	} else {
  		$data['message'] = 'faile to create restaurant!';
  		$data['success'] = false;
  		$data['phone'] = $phone;
  		$data['email'] = $email;


	}

	$conn->close();

}

// return all our data to an AJAX call
echo json_encode($data);