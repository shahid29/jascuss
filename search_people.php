<?php
	session_start();
	include 'includes/connection.php';
	include 'functions/functions.php';
	include 'functions/search_people_function.php';

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
<style>
		
	.message p a:hover, #active{background:black;color:white;}
	#search_people{
	    float: left;
    line-height: 35px;
    padding-top: 0;
    margin-right: 11px;
}
}

	</style>
	<div class="message">
		<form  method="get" action="search_people.php" id="search_people">
				<input style='width: 341px;margin-left: 78px;' type="text" name="find_people" placeholder="Search People"/>
				<input type="submit" name="search" value="Search" />
			</form>

		
		<?php 
		if (isset($_GET['sent'])) {

			include 'sent.php';

		}
		?>

	
	

		<table width="550" align="center">

			<tr align="center">
				<td colspan="4"><h2>Your Search Result:</h2></td>
			</tr>
			<tr>
				<th>SN.:</th>
				<th>Name:</th>
				<th>Image:</th>
				<th>Add Friend</th>
				

			</tr>
<?php

global $con;

			$user=$_SESSION['user_email'];
			$get_user= " select * from users where user_email='$user' ";
			$run_user = mysqli_query($con,$get_user);
			$row = mysqli_fetch_array($run_user);

			$user_id1 = $row['user_id'];
			$per_page = 5;
			
		if (isset($_GET['find_people'])) {

			$search_term= $_GET['find_people'];
		
		$get_users = " SELECT * FROM users WHERE user_name like '%$search_term%' ORDER by 1 DESC  ";


		$run_users = mysqli_query($con,$get_users);
		$no_result = mysqli_num_rows($run_users);

		if ($no_result==0) {
			echo "<h3 style='background:black; color:white;padding:10px;' >No result fouund !";
		}
		$sn=0;
		while ($row_users= mysqli_fetch_array($run_users)) {
			
		
			$user_id = $row_users['user_id'];
			$user_name = $row_users['user_name'];
			$user_image = $row_users['user_image'];
		

$sn++;
			//<p><img src='user/user_images/$user_image' width='50' height='50'/></p>

	?>		

		

			

		
	
		


			<tr align="center">
		
				<td>
					<?php echo $sn;  ?>
				</td>
				<td>
					<a target="blank" href="user_profile.php?user_id=<?php echo $user_id ; ?>" >
				<?php echo $user_name; ?>
				</td>
				<td>
					<a target="blank" href="user_profile.php?user_id=<?php echo $user_id ; ?>" >
				<?php echo "<img src='user/user_images/$user_image' width='50' height='50'/>"; ?>
				</td>
				<td><?php
				if ($user_id != $user_id1 ) {
	$chenk_frnd_query =mysqli_query($con,"SELECT id FROM frnds WHERE (user_one='$user_id1' AND user_two='$user_id' ) OR (user_one='$user_id' AND user_two='$user_id1' ) ");

	if (mysqli_num_rows($chenk_frnd_query)==1) {
		}else{
		$from= mysqli_query($con,"SELECT id FROM frnd_req WHERE from_id='$user_id' AND to_id='$user_id1'" );
		$to= mysqli_query($con,"SELECT id FROM frnd_req WHERE from_id='$user_id1' AND to_id='$user_id'" );


		if(mysqli_num_rows($from)==1){
			}elseif (mysqli_num_rows($to)==1) {
			}else{
			echo "<a  href='send_req_by_me.php?send_req_by_me=send&user_id=$user_id' ><button>Send Freind Rrequest</button></a>";
	
		}
	
	}
	
}
		?>			
				</td>


			</tr>
	<?php }}?>
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