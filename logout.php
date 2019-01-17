<?php
$con= mysqli_connect("localhost","root","","social_network") or die("Connection was not established");
	session_start();


$user=$_SESSION['user_email'];
			$get_user= " select * from users where user_email='$user' ";
			$run_user = mysqli_query($con,$get_user);
			$row = mysqli_fetch_array($run_user);

			$user_id = $row['user_id'];
			$user_name = $row['user_name'];
			$user_email = $row['user_email'];

$del_ll=mysqli_query($con,"DELETE last_login FROM users WHERE user_id='$user_id'");


$last_login =mysqli_query($con,"UPDATE users SET last_login=NOW() WHERE user_id='$user_id'");
	
$del_online_session=mysqli_query($con,"DELETE FROM online WHERE user_session_id='$user_id' AND user_session_name='$user_name' AND user_session_email='$user_email'");

	

		
		
	session_destroy();
	header("location:index.php");
?>



	