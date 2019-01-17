<?php
		include 'includes/connection.php';

		if (isset($_GET['code'])) {
			
			$get_code = $_GET['code'];
 
			$get_user = " select * from users where ver_code ='$get_code' ";
			$run = mysqli_query($con,$get_user);

			$check = mysqli_num_rows($run);

			$row = mysqli_fetch_array($run);
			$user_id = $row['user_id'];

			if ($check==1) {
				$update = " update users set status='verified' where user_id='$user_id' ";
				$run_update = mysqli_query($con,$update);
				
				echo "
				<h2>Thanks, your account has been active now!</h2> Please <a href='http://www.socail-network.com'>Login to our website</a>

				";
			}else{
				echo "<h2>Sorry, Your Account is not verified!</h2>";
			}
		}
?>