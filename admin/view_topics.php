<?php include 'includes/connection.php';
	include 'home.php';?>
<table width="750" align="center" bgcolor="pink"> 

	
	<tr align="center">
		<td colspan="6"><h2>View All Topics Here</h2></td>
	</tr>
	
	<tr bgcolor="orange" border="1">
		<th>S.N</th>
		<th>Topics Title</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>
	<?php 
	include 'includes/connection.php';
	
	$get_topic = "select * from topics";
	
	$run_topic = mysqli_query($con, $get_topic); 
	
	$i = 0;
	
	while ($row_topic=mysqli_fetch_array($run_topic)){
		
		$topic_id = $row_topic['topic_id'];
		$topic_title = $row_topic['topic_title'];
		$i++;
	
	?>
	<tr align="center">
		<td><?php echo $i;?></td>
		<td><?php echo $topic_title;?></td>
		<td><a href="edit_topics.php?edit=<?php echo $topic_id; ?>">Edit</a></td>
		<td><a href="delete_topics.php?delete=<?php echo $topic_id;?>">Delete</a></td>
	
	</tr>
	<?php } ?>




</table>
<?php include 'footer.php';?>