<?php
		include 'includes/connection.php';
		if (isset($_GET['delete'])) {

			$get_id = $_GET['delete'];
			
			$delete = "  delete from topics where topic_id='$get_id' ";
			$run_delete = mysqli_query($con,$delete);
			
			
			echo "<script>alert('Topics Has been Deleted')</script>";

			echo "<script>window.open('view_topics.php?view_topics','_self')</script>";
		}
	?>