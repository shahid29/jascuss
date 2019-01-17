<?php
if (isset($_GET['user_id'])) {
			
			$user_id = $_GET['user_id'];
			$select = " select * from users where user_id='$user_id' ";
			$check = mysqli_query($con,$select);
			$check_row = mysqli_fetch_array($check);
			$user_id=$check_row['user_id'];
		}
?>

<?php

	global $con;
		 	$user=$_SESSION['user_email'];
			$get_user= " select * from users where user_email='$user' ";
			$run_user = mysqli_query($con,$get_user);
			$row = mysqli_fetch_array($run_user);

			$user_id1 = $row['user_id'];

if ($user_id == $user_id1) {
	$query = "select * from posts where user_id='$user_id1'";
	$result = mysqli_query($con,$query);

	//count the total records

	$total_posts = mysqli_num_rows($result);

	// using ceil function to divided the total records on per page
	$total_pages = ceil($total_posts/$per_page);

	//goging to frist page
	echo " 
			<center>
				<div id ='pagination'>
				<a href='my_posts.php?user_id=$user_id1&page=1'>First Page</a>
				

			
	";

	for ($i=1; $i<=$total_pages; $i++){
		echo " <a href= 'my_posts.php?user_id=$user_id1&page=$i'>$i</a> ";
	}
	//going to last page
	echo " <a href='my_posts.php?user_id=$user_id1&page=$total_pages'>Last Page</a></center></div> ";
}else{


	
			$query = "select * from posts where user_id='$user_id'";
	$result = mysqli_query($con,$query);

	//count the total records

	$total_posts = mysqli_num_rows($result);

	// using ceil function to divided the total records on per page
	$total_pages = ceil($total_posts/$per_page);

	//goging to frist page
	echo " 
			<center>
				<div id ='pagination'>
				<a href='my_posts.php?user_id=$user_id&page=1'>First Page</a>
				

			
	";

	for ($i=1; $i<=$total_pages; $i++){
		echo " <a href= 'my_posts.php?user_id=$user_id&page=$i'>$i</a> ";
	}
	//going to last page
	echo " <a href='my_posts.php?user_id=$user_id&page=$total_pages'>Last Page</a></center></div> ";
}

?>

