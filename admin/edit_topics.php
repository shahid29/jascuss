<?php 
include("includes/connection.php"); 
include 'home.php';

if(isset($_GET['edit'])){

	$topic_id = $_GET['edit']; 
	
	$get_topic = "select * from topics where topic_id='$topic_id'";

	$run_topic = mysqli_query($con, $get_topic); 
	
	$row_topic = mysqli_fetch_array($run_topic); 
	
	$topic_id = $row_topic['topic_id'];
	$topic_title = $row_topic['topic_title'];
}


?>
<form action="" method="post" style="padding:80px;">

<b>Update Topics:</b>
<input type="text" name="new_topic" value="<?php echo $topic_title;?>"/> 
<input type="submit" name="update_topic" value="Update Topic" /> 

</form>

<?php 


	if(isset($_POST['update_topic'])){
	
	$update_id = $topic_id;
	
	$new_topic = $_POST['new_topic'];
	
	$update_topic = "update topics set topic_title='$new_topic' where topic_id='$update_id'";

	$run_topic = mysqli_query($con, $update_topic); 
	
	if($run_topic){
	
	echo "<script>alert(' Topic has been updated!')</script>";
	echo "<script>window.open('view_topics.php?view_topics','_self')</script>";
	}
	}

?>
<?php include 'footer.php';?>