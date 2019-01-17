<?php
session_start();
	include 'includes/connection.php';
	$action = $_GET['action'];
	
	
	$user_id = $_GET['user_id'];



$user=$_SESSION['user_email'];
			$get_user= " select * from users where user_email='$user' ";
			$run_user = mysqli_query($con,$get_user);
			$row = mysqli_fetch_array($run_user);

			$user_id1 = $row['user_id'];

	
if ($action == 'send') {

	mysqli_query($con,"INSERT INTO frnd_req VALUES ('','$user_id1','$user_id')");
}


if ($action == 'cancel') {
	
	mysqli_query($con,"DELETE FROM frnd_req WHERE from_id='$user_id1' AND to_id='$user_id'");
}

header('Location:user_profile.php?user_id='.$user_id);

if ($action == 'ignore') {
	
	mysqli_query($con,"DELETE FROM frnd_req WHERE from_id='$user_id' AND to_id='$user_id1'");
}


if ($action == 'accept') {
	
	mysqli_query($con,"DELETE FROM frnd_req WHERE from_id='$user_id' AND to_id='$user_id1'");

	mysqli_query($con,"INSERT INTO frnds VALUES('','$user_id','$user_id1')");

}



if ($action == 'unfriend') {
	
	mysqli_query($con,"DELETE  FROM frnds WHERE (user_one='$user_id1' AND user_two='$user_id' ) OR (user_one='$user_id' AND user_two='$user_id1' ) ");
}










?>