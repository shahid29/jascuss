
<?php include 'home.php';?>
		<div id="content">
		
		
	<table align="center" width="750"  bgcolor="skyblue">
	<tr bgcolor="orange" border="1">
		<th>S.N</th>
		<th>Title</th>
		<th>Author</th>
		<th>Date</th>
		<th>Delete</th>
		<th>View</th>
		
		
		
	</tr>
	<?php
	include 'includes/connection.php';
	
		$sel_posts = " select * from posts ORDER by 1 DESC ";
		$run_posts = mysqli_query($con,$sel_posts);
		$i=0;
		while ($row_posts= mysqli_fetch_array($run_posts)) {
			
			$post_id = $row_posts['post_id'];
			$user_id = $row_posts['user_id'];
			$post_title = $row_posts['topic_title'];
			$post_date = $row_posts['post_date'];
			$i++;
		
			$sel = " select * from users where user_id='$user_id'  ";
			$run = mysqli_query($con,$sel);

			while ($row_users= mysqli_fetch_array($run)) {
			
			$user_name= $row_users['user_name'];
			
	?>
	<tr align="center">
		<td><?php echo $i;?></td>
		<td><?php echo $post_title;?></td>
		<td><?php echo $user_name;?></td>
		<td><?php echo $post_date;?></td>
		
		<td><a href="delete_posts.php?delete=<?php echo $post_id;?>">Delete</a></td>
		<td><a href="view_detail_posts.php?edit=<?php echo $post_id;?>">View</a></td>
	</tr>
		<?php } }?>
	</table>



<?php include 'footer.php';?>
		