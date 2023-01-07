<?php
require 'Config.php';
if(isset($_POST['reg_btn'])){
 $username= mysqli_real_escape_string($config,$_POST['username']);
 $email = mysqli_real_escape_string($config,$_POST['email']);
 $password = mysqli_real_escape_string($config,$_POST['password']);
 $role = mysqli_real_escape_string($config,$_POST['role']);

$query = "INSERT INTO user (username,email,password,role) VALUES
('$username','$email','$password','$role')";
$query_run = mysqli_query($config , $query);
if($query_run){
    $_SESSION['message'] = "student created successfully";
    header("location: login.php ");
    exit(0);
}
else{
    $_SESSION['message'] = "student not created";
    header("location: registration.php ");
    exit(0);
}
 
	


}

?>