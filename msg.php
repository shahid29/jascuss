
<?php
	session_start();
	include 'includes/connection.php';
	include 'functions/functions.php';

	if (!isset($_SESSION['user_email'])) {
		
		header('location:index.php');
	}else{
?>

<!DOCTYPE html>


<html>
	<head>
		<title>Welcome User!</title>
		<link rel="stylesheet" href="styles/home_style.css" media="all" />
	</head>
<body>

<!--container Start-->
<div class="container">
<!--head_wrap Start-->
	<div id="head_wrap">
	<!--header Start-->
		<div id="header">
			<ul id="menu">
				<li><a href="home.php">Home</a></li>
				<li><a href="members.php">Members</a></li>
				<strong>Topics :</strong>

				<?php
					

					$get_topics= "select * from topics";
					$run_topics = mysqli_query($con ,$get_topics);

					while($row=mysqli_fetch_array($run_topics)) {

						
						$topic_id = $row['topic_id'];
						$topic_title = $row['topic_title'];

						echo "<li><a href='topic.php?topic=$topic_id'>$topic_title</a></li>";
					}
				?>
			</ul>
			<form method="get" action="results.php" id="form1">
				<input type="text" name="user_query" placeholder="Search a topic"/>
				<input type="submit" name="search" value="Search" />
			</form>
		</div>
<!--header ends here-->
	</div>
<!--head_wrap ends here-->


<!--Content Starts here-->
<div class="content">
<!--User timeline Starts here-->
	<div id="user_timeline">
<!--User details Starts here-->	
		<div id="user_details">
		<?php
			
			$user=$_SESSION['user_email'];
			$get_user= " select * from users where user_email='$user' ";
			$run_user = mysqli_query($con,$get_user);
			$row = mysqli_fetch_array($run_user);

			$user_id = $row['user_id'];
			$user_id1 = $row['user_id'];
			$user_name = $row['user_name'];
			$user_country = $row['user_country'];
			$user_image = $row['user_image'];
			$register_date= $row['register_date'];
			$last_login = $row['last_login'];

			$user_posts = " select * from posts where user_id='$user_id'";
			$run_posts = mysqli_query($con,$user_posts);
			$posts = mysqli_num_rows($run_posts);

			//count numbering messages
			 $sel_msg = " select * from messages where receiver='$user_id' AND status ='unread' ";
			$run_msg = mysqli_query($con,$sel_msg);

			$count_msg = mysqli_num_rows($run_msg);

			//count Friend Request
			 $sel_frnd_req = " select * from frnd_req where to_id='$user_id' ";
			$run_frnd_req= mysqli_query($con,$sel_frnd_req);

			$count_frnd_req = mysqli_num_rows($run_frnd_req);


//------------------------------count Friend Are Online-----------------------------------------------------------------------------
			$user=$_SESSION['user_email'];
			$get_user= " select * from users where user_email='$user' ";
			$run_user = mysqli_query($con,$get_user);
			$row = mysqli_fetch_array($run_user);



			$user_id1 = $row['user_id'];
			$my_friend_list_query = mysqli_query($con,"SELECT user_one,user_two FROM frnds WHERE user_one='$user_id1' OR user_two='$user_id1'");
			$sn =0;

			while($run_frnd= mysqli_fetch_array($my_friend_list_query)){
				$user_one= $run_frnd['user_one'];
				$user_two= $run_frnd['user_two'];
				if ($user_one==$user_id1) {
					
					$user_id=$user_two;
				}else{
					$user_id = $user_one;
				}
				//$user_name = $user_id;

				//Online Friend are available or not

				$sel=mysqli_query($con,"SELECT * FROM online WHERE user_session_id='$user_id'");
				$run_sel=mysqli_num_rows($sel);
				if ($run_sel==1) {
				//End online friends are avialable or not	
				

			$get_sender =" select * from users where user_id='$user_id' ";
			$run_sender = mysqli_query($con,$get_sender);
			$row = mysqli_fetch_array($run_sender);


			$sender_name =$row['user_name'];

				$sn++;

}}
//------------------------------count Friend Are Online END----------------------------------------------------------------------------
			
			echo "
				<center><img src='user/user_images/$user_image' width='200px' height='200px'/></center>
				<div id='user_mention'>
				<p><strong>Name :</strong><a href='user_profile.php?user_id=$user_id1'>$user_name</a></p>
				<p><strong>Country :</strong> $user_country</p>
				<p><strong>Last Login :</strong> $last_login</p>
				<p><strong>Member Since:</strong> $register_date</p>
				<p><a href='my_posts.php?u_id=$user_id1'>Timeline</a></p>
				<p><a href='search_people.php?u_id=$user_id1'>Search People</a></p>
				<p><a href='my_messages.php?u_id=$user_id1'>Messages ($count_msg)</a></p>
				<p><a href='my_posts.php?u_id=$user_id1'>My Posts ($posts)</a></p>
				<p><a href='friends.php?u_id=$user_id1'>Friends($count_frnd_req)</a></p>
				<p><a href='online_frnd.php?u_id=$user_id1'>Friends Are Online($sn)</a></p>
				<p><a href='edit_profile.php?u_id=$user_id1'>Edit My Account</a></p>
				<p><a href='logout.php'>Logout</a></p>
				</div>
			";

			?>
		</div>
<!--User details ends here-->			
	</div>
<!--User timeline ends here-->	
	

		<?php

		if (isset($_GET['user_id'])) {
			
			$user_id = $_GET['user_id'];

			$select = " select * from users where user_id='$user_id'  ";
			$run = mysqli_query($con,$select);
			$row = mysqli_fetch_array($run);
			$user_name = $row['user_name'];
			$user_image = $row['user_image'];
			$reg_date = $row['register_date'];

		}

		?>
		<div id="content_timeline">
<h2>Send a message to <span style='color:red'><?php echo $user_name;?></span></h2>

	<div class="box clr">
		<ul>
		<?php
		$user=$_SESSION['user_email'];
			$get_user= " select * from users where user_email='$user' ";
			$run_user = mysqli_query($con,$get_user);
			$row = mysqli_fetch_array($run_user);

	
			$user_id1 = $row['user_id'];

			$sel=mysqli_query($con,"SELECT * FROM msg WHERE sender='$user_id1' ORDER BY id DESC ");
			while ($run=mysqli_fetch_array($sel)) {
				$user_id1=$run['sender'];
				$name=$run['name'];
				$body=$run['body'];
				$time=$run['timee'];

				
?>
				<li><span><?php echo $time;?></span> - <b><?php echo $name;?></b> <?php echo $body;?></li>
			
					
<?php }?>



		</ul>
		<ul>
	
<?php
		if (isset($_GET['user_id'])) {
			
			$user_id = $_GET['user_id'];

			//$select = " select * from users where user_id='$user_id'  ";
			

			$sel=mysqli_query($con,"SELECT * FROM msg  WHERE sender='$user_id' ORDER BY id DESC ");
			while ($run=mysqli_fetch_array($sel)) {
				$user_id=$run['sender'];
				$body=$run['body'];
				$name=$run['name'];
				$time=$run['timee'];

				
?>
				<li><span><?php echo $time;?></span> - <b><?php echo $name;?></b> <?php echo $body;?></li>
			
					
<?php }}?>


		</ul>
		
	</div>

	<div class="shoutform clr">
	<form method="POST" action="messages.php?user_id=<?php echo $user_id ;?>">
		<table>
			
			<tr>
				<td>Body</td>
				<td>:</td>
				<td><input type="text" name="body" required></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td><input type="submit" name="message" value="Send"></td>
			</tr>
		</table>
	</form>
		
	</div>
		
	</section>

	<br/>
		<img style="border:2px solid blue; border-radius:5px" width="100" height="100" src="user/user_images/<?php echo $user_image;?>" />

		<p><strong><?php echo $user_name;?></strong>is member of this site since: <?php echo $reg_date;?> </p>
		

	
</div>
<!--Content ends here-->

<?php
$user=$_SESSION['user_email'];
			$get_user= " select * from users where user_email='$user' ";
			$run_user = mysqli_query($con,$get_user);
			$row = mysqli_fetch_array($run_user);

			$user_name = $row['user_name'];
	if (isset($_POST['message'])) {
		
		
	date_default_timezone_get('Asia/Dhaka');
			$time = date('h:i:s A',time()+18000);
			$body = $_POST['body'];

		$insert_msg =" insert into msg(sender,receiver,name,body,timee) values('$user_id1','$user_id','$user_name','$body','$time') ";

		$check = mysqli_query($con,$insert_msg);


	}	

?>



</div>
<!--container end-->

</body>	
</html>
<?php }?>