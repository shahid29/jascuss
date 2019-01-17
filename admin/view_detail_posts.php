<?php include 'home.php';?>
<?php
include 'includes/connection.php';
	
	
	
	if (isset($_GET['edit'])) {
		
		$get_id = $_GET['edit'];
		$get_post = " select * from posts where post_id='$get_id' ";

		$run_post = mysqli_query($con,$get_post);
		$row = mysqli_fetch_array($run_post);

		$topic_title = $row['topic_title'];
		$post_content = $row['post_content'];
	}

?>
<form action="" method="post" id="ct_form">

		<h2>Edit Your Post</h2>
		<input type="text" name="title"  size="83" required="required" value="<?php echo $topic_title;?>" /><br/>
		<textarea  name="content" cols="85" rows="5" placeholder="Write Description...."><?php echo $post_content;?></textarea><br/>
	
			
			
		

		</form>
		<?php
	include 'includes/connection.php';
	
		$sel_posts = " select * from posts   ";
		$run_posts = mysqli_query($con,$sel_posts);
	$row_posts= mysqli_fetch_array($run_posts);
			
			$post_id = $row_posts['post_id'];
			
	
	?>
	<td><a href="view_posts.php">Back</a></td>	

<?php
	include 'includes/connection.php';
	
		if (isset($_GET['delete'])) {

			$post_id = ['delete'];


		$del = " delete from posts where post_id='$post_id'  ";
		$run = mysqli_query($con,$del);

		if ($run){

		echo "<script>alert('Post Has been Deleted')</script>";

			echo "<script>window.open('view_posts.php?view_posts','_self')</script>";

		}
	}
		?>		
		
<?php include 'footer.php';?>