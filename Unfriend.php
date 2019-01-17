<?php
session_start();
	include 'includes/connection.php';
	$action = $_GET['Unfriend'];
	$user_id = $_GET['user_id'];



$user=$_SESSION['user_email'];
			$get_user= " select * from users where user_email='$user' ";
			$run_user = mysqli_query($con,$get_user);
			$row = mysqli_fetch_array($run_user);

			$user_id1 = $row['user_id'];
if ($action == 'Unfriend') {
	
	mysqli_query($con,"DELETE  FROM frnds WHERE (user_one='$user_id1' AND user_two='$user_id' ) OR (user_one='$user_id' AND user_two='$user_id1' ) ");

}

header('Location:my_friends.php');

?>