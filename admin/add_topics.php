<?php include 'includes/connection.php';
	include 'home.php';
?>

<form action="" method="post" style="padding:80px;">

<b>Insert New Category:</b>
<input type="text" name="new_topic" required/> 
<input type="submit" name="add_topic" value="Add Topics" /> 

</form>

<?php 
include 'includes/connection.php';

	if(isset($_POST['add_topic'])){
	
	$new_topic = $_POST['new_topic'];
	
	$insert_topic = "insert into topics (topic_title) values ('$new_topic')";

	$run_topic = mysqli_query($con, $insert_topic); 
	
	if($run_topic){
	
	echo "<script>alert('New Topic has been inserted!')</script>";
	echo "<script>window.open('view_topics.php','_self')</script>";
	}
	}

?>
<?php 
	include 'footer.php';
?>