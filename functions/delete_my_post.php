<?php
$con= mysqli_connect("localhost","root","","social_network") or die("Connection was not established");

	if (isset($_GET['post_id'])) {
		
		$post_id =$_GET['post_id'];

		$delete = " delete from posts where post_id='$post_id' ";
		$check = mysqli_query($con,$delete);

		if ($check) {
			
			echo "<script>alert('Post has been deleted')</script>";
			echo "<script>window.open('../home.php','_self')</script>";
		}

		}

?>