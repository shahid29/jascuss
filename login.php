<?php
session_start();
include 'includes/connection.php';

if (isset($_POST['login'])) {



		
		$email= mysqli_real_escape_string($con, $_POST['email']);
		$pass= mysqli_real_escape_string($con,$_POST['pass']);


		$get_user= " select * from users where user_email='$email' AND user_pass='$pass' AND status='verified' ";
		$run_user= mysqli_query($con,$get_user);
		$check= mysqli_num_rows($run_user);



		if ($check==1) {
			$_SESSION['user_email']= $email;



//for online frnd 
			$get_user= " select * from users where user_email='$email' ";
			$run_user = mysqli_query($con,$get_user);
			$row = mysqli_fetch_array($run_user);

			$user_id = $row['user_id'];
			$user_name = $row['user_name'];
			$user_email=$row['user_email'];

			$online_insert = mysqli_query($con,"INSERT INTO online(user_session_id,user_session_name,user_session_email) VALUES('$user_id','$user_name','$user_email')");
			

				echo "<script>window.open('home.php','_self')</script>";
		}
		else{
			echo "<script>alert('Email or Password Not Correct.')</script>";
		}

	}

?>


