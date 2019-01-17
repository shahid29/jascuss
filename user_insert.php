<?php
include 'includes/connection.php';


if (isset($_POST['sign_up'])) {

		
		$name= mysqli_real_escape_string($con, $_POST['u_name']);
		$pass= mysqli_real_escape_string($con,$_POST['u_pass']);
		$email= mysqli_real_escape_string($con,$_POST['u_email']);
		$country= mysqli_real_escape_string($con,$_POST['u_country']);
		$gender= mysqli_real_escape_string($con,$_POST['u_gender']);
		$b_day= $_POST['u_birthday'];
		
		$status= "unverified";
		$posts= "No";

		$verification_code = mt_rand();

		$get_email= " select * from users where user_email='$email' AND status='verified' ";
		$run_email= mysqli_query($con,$get_email);
		$check= mysqli_num_rows($run_email);

		if ($check==1) {
			echo "<script>alert('Email is already existed!')</script>";
			exit();
		}
		if (strlen($pass)<8) {
			echo "<script>alert('Password should be minimum 8 character')</script>";
			exit();
		}
		else{
			$insert=" INSERT INTO users (user_name,user_pass,user_email,user_country,user_gender,user_b_day,user_image,user_cover_photo,register_date,last_login,status,ver_code,posts) VALUES ('$name','$pass','$email','$country','$gender','$b_day','default.jpg','default.jpg',NOW(),NOW(),'$status','$verification_code','$posts')";

			$run_insert=mysqli_query($con,$insert);

			if ($run_insert) {
				
				
				echo "<h3 style='color:green'>Hi $name , registration is almost complete.</h3>
				<h3 style='color:green'> We have sent an email to $email</h3> 
				<h3 style='color:green'>Please check your inbox or spam folder.</h3>";
				
			}
		}



//emil send for verification

		$to = $email;
		$subject = "Verify Your Email Address";

		$message ="

		<html>

				Hello <strong>$name</strong>! You have just created an account on www.social-network.com, Please active your account by clicking below link:

				<a href='http://www.social-network.com/verify.php?code=$verification_code'>Click To Active Your Account</a> <br/>

				<strong>Thank You for create an Accout</strong>

		</html>

		";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: <admin@social-network.com>' . "\r\n";

mail($to,$subject,$message,$headers);


	}
?>