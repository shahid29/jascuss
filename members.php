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
		#header ul li a:hover, #active{background:black;color:white;}
		#color a{color:white;}
	</style>
<body>

<!--container Start-->
<div class="container">
<!--head_wrap Start-->
	<div id="head_wrap">
	<!--header Start-->
	<?php
$path=$_SERVER['SCRIPT_FILENAME'];
$currentPage=basename($path,'.php');
			?>
		<div id="header">
			<ul id="menu">
				<li><a href="home.php">Home</a></li>
				<li id="color"><a <?php
						if($currentPage=='members') {
							echo 'id="active"';
						}?> href="members.php">Members</a></li>
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
	<div id="content_timeline">
		
		<h2>All Registered User on This Site :</h2><br/>
		

				<?php
				

			$get_members= " select * from users ";
			$run_members = mysqli_query($con,$get_members);
			while($row = mysqli_fetch_array($run_members)){

			$user_id = $row['user_id'];
			$user_name = $row['user_name'];
			$user_image = $row['user_image'];
			


			echo "
			<a href='user_profile.php?user_id=$user_id'>
				<img src='user/user_images/$user_image' width=50px' height='50px' title='$user_name'/></a>
				
			"; }
				?>
				
		</div>	
	
</div>
<!--Content ends here-->
</div>
<!--container end-->

</body>	
</html>
<?php }?>