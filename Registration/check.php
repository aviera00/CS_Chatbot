<?php
session_start();

//Initializing variables
$username = "";
$errors = array(); 

//Connect to the database
$db = mysqli_connect("localhost", "root", "root", "hw2_witAI");

//Reset password
if (isset($_POST['reset_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
  
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
  
    if (count($errors) == 0) {
        $query = "SELECT * FROM user WHERE username='$username'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
          header('location: new_pass.php');
        }else {
            array_push($errors, "Username does not exist");
        }
    }
  }
  
?>