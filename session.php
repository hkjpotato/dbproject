<?php
session_start();// Starting Session
// Storing Session
$userInfo=$_SESSION['userInfo'];
$userType=$_SESSION['userType'];

if(!isset($_SESSION['userType'])){
	header('Location: index.php'); // Redirecting To Home Page
}

?>