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
	<style>
.message{padding: 10px;line-height: 20px;background: pink;margin: 0 auto;}
.message th{border:3px solid green;background: white;}
.message table,td{padding: 10px;}
.message a{color:blue;text-decoration: none;font-size: 18px;}
.message a:hover{color:brown;text-decoration: none;font-weight:bold;}
	</style>
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
	<div class="message">
		<p align="center">
			
			<a href="my_messages.php?inbox">Inbox</a> ||
			<a href="my_messages.php?sent">Sent</a>

		</p>
		<?php 
		if (isset($_GET['sent'])) {

			include 'sent.php';

		}
		?>

	
	

		<table width="550" align="center">
			<tr align="center">
				<td colspan="4"><h2>See Your Messages:</h2></td>
			</tr>
			<tr>
				<th>Sender:</th>
				<th>Subject</th>
				<th>Date</th>
				<th>Reply</th>
				

			</tr>
			
		
		<?php

		 $sel_msg = " select * from messages where receiver='$user_id1' ";
		$run_msg = mysqli_query($con,$sel_msg);

		$count_msg = mysqli_num_rows($run_msg);

		while ($row_msg= mysqli_fetch_array($run_msg)) {
			
			$msg_id = $row_msg['msg_id'];
			$receiver = $row_msg['receiver'];
			$sender = $row_msg['sender'];
			$msg_sub = $row_msg['msg_sub'];
			$msg_topic = $row_msg['msg_topic'];
			$msg_date = $row_msg['msg_date'];
			$msg_id = $row_msg['msg_id'];

			$get_sender =" select * from users where user_id='$sender' ";
			$run_sender = mysqli_query($con,$get_sender);
			$row = mysqli_fetch_array($run_sender);

			$sender_name =$row['user_name'];
		

		?>
			<tr align="center">
				<td>
				<a target="blank" href="user_profile.php?user_id=<?php echo $sender; ?>" >
				<?php echo $sender_name; ?>
				</a>	
				</td>
				<td><a href="my_messages.php?msg_id=<?php echo $msg_id?>"><?php echo $msg_sub; ?></a></td>
				<td><?php echo $msg_date; ?></td>
				<td><a href="my_messages.php?msg_id=<?php echo $msg_id?>">Reply</a></td>
			</tr>
			<?php }?>
		</table>
		<?php

		if (isset($_GET['msg_id'])) {
			
			$msg_id = $_GET['msg_id'];
			$select = " select * from messages where msg_id='$msg_id' ";
			$check = mysqli_query($con,$select);
			$check_row = mysqli_fetch_array($check);

			$msg_sub = $check_row['msg_sub'];
			$msg_topic = $check_row['msg_topic'];
			$msg_content = $check_row['reply'];

			//Updating the unread message to read
		$update = " update messages set status ='read' where msg_id='$msg_id' ";
		$run = mysqli_query($con,$update);

			
			echo "<center><br/><hr>

			<h2>$msg_sub</h2>
		
			<p><b>Messages:</b> $msg_topic</p>
			<p><b>My Reply:</b> $msg_content</p>



			<form action='' method='post'>

			<textarea cols='50' rows='5' name='reply' placeholder='Write Something...'></textarea><br/>
			<input type='submit' name='reply_msg' value='Reply to this' />

			</form>

			</center>";

		}

		if (isset($_POST['reply_msg'])) {
			
			$reply = $_POST['reply'];

			//if ($msg_content!='no_reply') {
			//	echo " <h2 align='center'>Messages Was Already Replied</h2> ";
				//exit();
				
			//}else{

			$update = " update messages set reply='$reply' where msg_id='$msg_id'  ";
			$check = mysqli_query($con,$update);

			echo " <h2 align='center'>Messages Was Replied</h2> ";
				
			//}
		}

		?>
</div>


</div>
<!--container end-->

</body>	
</html>
<?php }?>