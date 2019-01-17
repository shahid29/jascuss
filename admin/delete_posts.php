<?php
		include 'includes/connection.php';
		if (isset($_GET['delete'])) {

			$get_id = $_GET['delete'];
			
			$delete = "  delete from posts where post_id='$get_id' ";
			$run_delete = mysqli_query($con,$delete);
			
			
		

			

			echo "<script>alert('Post Has been Deleted')</script>";

			echo "<script>window.open('view_posts.php?view_posts','_self')</script>";
		}
	?>