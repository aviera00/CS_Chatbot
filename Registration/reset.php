<?php
session_start();

$username = $_SESSION['username'];
$errors = array(); 

//Connect to the database
$db = mysqli_connect("localhost", "root", "root", "hw2_witAI");

// REGISTER USER
if (isset($_POST['change_pass'])) {
  //Receive all input values from the form
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "Passwords do not match");
  }



  //Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//Encrypt the password before saving in the database

  	$query = "UPDATE user
              SET password = '$password'
              WHERE username = '$username'";
  	mysqli_query($db, $query);

  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
}
  
?>
