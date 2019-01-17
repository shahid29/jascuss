<?php
		$get_id = $_GET['post_id'];

		$get_comment = " select * from comments where post_id='$get_id' ";
		$run_comment = mysqli_query($con,$get_comment);

		while ($row = mysqli_fetch_array($run_comment)) {

			$comment = $row['comment'];
			$comment_name =$row['comment_author'];
			$date = $row['date'];

			echo "

				<div id='comments'>
				<h3>$comment_name</h3><span><i>Said</i> on $date</span>
				<p>$comment</p></div>
			";
			
			//echo "<script>window.open('single.php?post_id=$get_id','_self')</script>";

		}
?>