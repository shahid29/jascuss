<?php
session_start();
	include 'includes/connection.php';
	
		$cancel = $_GET['cancel'];
	
	$user_id = $_GET['user_id'];



$user=$_SESSION['user_email'];
			$get_user= " select * from users where user_email='$user' ";
			$run_user = mysqli_query($con,$get_user);
			$row = mysqli_fetch_array($run_user);

			$user_id1 = $row['user_id'];

	
if ($cancel == 'cancel') {
	
	mysqli_query($con,"DELETE FROM frnd_req WHERE from_id='$user_id1' AND to_id='$user_id'");
}
header('Location:send_request.php');





?>