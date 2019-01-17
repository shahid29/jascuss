<?php
session_start();
	include 'includes/connection.php';
	$send_req_by_me= $_GET['send_req_by_me'];
	
	
	$user_id = $_GET['user_id'];



$user=$_SESSION['user_email'];
			$get_user= " select * from users where user_email='$user' ";
			$run_user = mysqli_query($con,$get_user);
			$row = mysqli_fetch_array($run_user);

			$user_id1 = $row['user_id'];

	
if ($send_req_by_me == 'send') {

	mysqli_query($con,"INSERT INTO frnd_req VALUES ('','$user_id1','$user_id')");
}
header('Location:user_profile.php?user_id='.$user_id);






?>