<html>
	<head>
		<title>Welcome User!</title>
		<link rel="stylesheet" href="../styles/home_style.css" media="all" />
	</head>
<body>
<?php
	$con= mysqli_connect("localhost","root","","social_network") or die("Connection was not established");

//function for getting topics
			function getTopics(){
				global $con;
					$get_topics= "select * from topics";
					$run_topics = mysqli_query($con ,$get_topics);

					while($row=mysqli_fetch_array($run_topics)) {

						
						$topic_id = $row['topic_id'];
						$topic_title = $row['topic_title'];

						echo "<option value='$topic_id'>$topic_title</option>";
					}
				}	


//function for inserting post
		function insertPost(){


			if (isset($_POST['sub'])) {
				
				global $con;
			global $user_id1;
				$title= addslashes($_POST['title']);
				$content= addslashes($_POST['content']);
				$topic= $_POST['topic'];

				if ($topic=='') {
					echo "<h3 style='color:red'>Topic Must Not be Empty</h3></script>";
					
				}else{
					if ($content=='') {
						echo "<h3 style='color:red'>You have to must weite the Des</h3></script>";
					}
				else{


				$insert = " insert into posts (user_id,topic_id,topic_title,post_content,post_date) values ('$user_id1','$topic','$title','$content',NOW()) ";

				$run = mysqli_query($con,$insert);

				if ($run) {
					echo " <h2>Posted to timeline , Looks great!</h2>";

					$update ="update users set posts='yes' where user_id='$user_id1' " ;
					$run_update = mysqli_query($con,$update);
					}
				}	
			}
		}	

}
		//function for displaying post
		function get_posts(){
			global $con;
			$per_page = 5;
			if (isset($_GET['page'])) {
					$page = $_GET['page'];
			}
			else{
			$page = 1;
		}
		$start_from = ($page-1)*$per_page;
		$get_posts = " select * from posts ORDER by 1 DESC LIMIT $start_from, $per_page ";
		$run_posts = mysqli_query($con,$get_posts);

		while ($row_posts= mysqli_fetch_array($run_posts)) {
			
			$post_id = $row_posts['post_id'];
			$user_id1 = $row_posts['user_id'];
			$topic_title = $row_posts['topic_title'];
			$content = $row_posts['post_content'];
			$post_date = $row_posts['post_date'];


			//getting the user who has posted the thread

			$user = " select * from users where user_id = '$user_id1' AND posts ='yes' ";

			$run_user = mysqli_query($con,$user);
			$row_user = mysqli_fetch_array($run_user);
			$user_name = $row_user['user_name'];
			$user_image = $row_user['user_image'];

			

			//now dispalying all at one

			echo "
				<div id='posts'>
					<p><img src='user/user_images/$user_image' width='50' height='50'/></p>
					<h3><a href='user_profile.php?user_id=$user_id1'>$user_name</a></h3>
					<h3>$topic_title</h3>
					<p>$post_date</p>
					<p>$content</p>

					<a href='single.php?post_id=$post_id' style='float:right; padding-top:5px;'><button>See Replies or Reply to This</button></a>
					
					</div><br/>
					
			";

		}
		include 'pagination.php';
}

//display single post
function single_post(){

	if (isset($_GET['post_id'])) {
		global $con;
		
		$get_id = $_GET['post_id'];

		$get_posts = " select * from posts where post_id='$get_id' ";
		$run_posts = mysqli_query($con,$get_posts);

		$row_posts= mysqli_fetch_array($run_posts);
			
			$post_id = $row_posts['post_id'];
			$user_id = $row_posts['user_id'];
			$topic_title = $row_posts['topic_title'];
			$content = $row_posts['post_content'];
			$post_date = $row_posts['post_date'];


			//getting the user who has posted the thread

			$user = " select * from users where user_id = '$user_id' AND posts ='yes' ";

			$run_user = mysqli_query($con,$user);
			$row_user = mysqli_fetch_array($run_user);
			$user_name = $row_user['user_name'];
			$user_image = $row_user['user_image'];

			//getting ther user session
			$user_comment=$_SESSION['user_email'];
			$get_comment= " select * from users where user_email='$user_comment' ";
			$run_comment = mysqli_query($con,$get_comment);
			$row = mysqli_fetch_array($run_comment);

			$user_comment_id = $row['user_id'];
			$user_comment_name = $row['user_name'];

			//now dispalying all at one

			echo "
				<div id='posts'>
					<p><img src='user/user_images/$user_image' width='50' height='50'/></p>
					<h3><a href='user_profile.php?user_id=$user_id'>$user_name</a></h3>
					<h3>$topic_title</h3>
					<p>$post_date</p>
					<p>$content</p>
					</div>";

					include 'comments.php';
					echo "
					<form action='' method='post' id='reply'>
					<textarea cols='50' rows='5' name='comment' placeholder='Write your reply...'></textarea><br/>
					<input type='submit' name='reply' value='Reply to This' />
					</form>";

			if (isset($_POST['reply'])) {
						
					$comment = $_POST['comment'];

					$insert = " insert into comments (post_id,user_id,comment,comment_author,date) values ('$post_id','$user_id','$comment','$user_comment_name',NOW()) ";

					$run_insert = mysqli_query($con,$insert);

					echo "Added";
						
					}		
	}
}


//function for displaying all categorywise post
		function get_cats(){
			global $con;
			$per_page = 5;
			if (isset($_GET['page'])) {
					$page = $_GET['page'];
			}
			else{
			$page = 1;
		}
		$start_from = ($page-1)*$per_page;

		if (isset($_GET['topic'])) {

			$topic_id= $_GET['topic'];
		}
		$get_posts = " select * from posts where topic_id='$topic_id' ORDER by 1 DESC LIMIT $start_from, $per_page ";
		$run_posts = mysqli_query($con,$get_posts);

		while ($row_posts= mysqli_fetch_array($run_posts)) {
			
			$post_id = $row_posts['post_id'];
			$user_id = $row_posts['user_id'];
			$topic_title = $row_posts['topic_title'];
			$content = $row_posts['post_content'];
			$post_date = $row_posts['post_date'];


			//getting the user who has posted the thread

			$user = " select * from users where user_id = '$user_id' AND posts ='yes' ";

			$run_user = mysqli_query($con,$user);
			$row_user = mysqli_fetch_array($run_user);
			$user_name = $row_user['user_name'];
			$user_image = $row_user['user_image'];

			

			//now dispalying all at one

			echo "
				<div id='posts'>
					<p><img src='user/user_images/$user_image' width='50' height='50'/></p>
					<h3><a href='user_profile.php?user_id=$user_id'>$user_name</a></h3>
					<h3>$topic_title</h3>
					<p>$post_date</p>
					<p>$content</p>

					<a href='single.php?post_id=$post_id' style='float:right; padding-top:5px;'><button>See Replies or Reply to This</button></a>
					
					</div><br/>
					
			";

		}
		include 'pagination.php';
}


//function for getting search result
function search_result(){
			global $con;
			$per_page = 5;
			if (isset($_GET['page'])) {
					$page = $_GET['page'];
			}
			else{
			$page = 1;
		}
		$start_from = ($page-1)*$per_page;

		if (isset($_GET['user_query'])) {

			$search_term= $_GET['user_query'];
		}
		$get_posts = " SELECT * FROM posts WHERE topic_title like '%$search_term%' ORDER by 1 DESC LIMIT $start_from, $per_page ";


		$run_posts = mysqli_query($con,$get_posts);
		$no_result = mysqli_num_rows($run_posts);

		if ($no_result==0) {
			echo "<h3 style='background:black; color:white;padding:10px;' >No result fouund !";
		}

		while ($row_posts= mysqli_fetch_array($run_posts)) {
			
			$post_id = $row_posts['post_id'];
			$user_id = $row_posts['user_id'];
			$topic_title = $row_posts['topic_title'];
			$content = $row_posts['post_content'];
			$post_date = $row_posts['post_date'];


			//getting the user who has posted the thread

			$user = " select * from users where user_id = '$user_id' AND posts ='yes' ";

			$run_user = mysqli_query($con,$user);
			$row_user = mysqli_fetch_array($run_user);
			$user_name = $row_user['user_name'];
			$user_image = $row_user['user_image'];

			

			//now dispalying all at one

			echo "
				<div id='posts'>
					<p><img src='user/user_images/$user_image' width='50' height='50'/></p>
					<h3><a href='user_profile.php?user_id=$user_id'>$user_name</a></h3>
					<h3>$topic_title</h3>
					<p>$post_date</p>
					<p>$content</p>

					<a href='single.php?post_id=$post_id' style='float:right; padding-top:5px;'><button>See Replies or Reply to This</button></a>
					
					</div><br/>
					
			";

		}
		include 'pagination.php';
}


function find_people(){
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

			

			//now dispalying all at one

			echo "
					
					<p><img src='user/user_images/$user_image' width='50' height='50'/></p>   <a href='user_profile.php?user_id=$user_id'><button>$user_name</button></a><br/>
					
					
					
					
			";

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

		}
	}
		
}



//update user profile
function update_account(){
	if(isset($_POST['update'])) {
		global $con;
			
					$u_name = $_POST['u_name'];
					$u_pass = $_POST['u_pass'];
					$u_email = $_POST['u_email'];
					
					$u_image = $_FILES['u_image']['name'];
					$image_tmp = $_FILES['u_image']['tmp_name'];
					
					move_uploaded_file($image_tmp,"user/user_images/$u_image");
					

			$user=$_SESSION['user_email'];
			$get_user= " select * from users where user_email='$user' ";
			$run_user = mysqli_query($con,$get_user);
			$row = mysqli_fetch_array($run_user);

			$user_id = $row['user_id'];

					$updated ="UPDATE users SET user_name='$u_name', user_pass='$u_pass', user_email='$u_email', user_image='$u_image' WHERE user_id ='$user_id'";

					if(mysqli_query($con,$updated)) {
						
						echo "<h3>Profile Updated Successfully</h3>";
					//echo "<script>alert('Your Profile Updated Successfully')</script>";
						//echo "<script>window.open('home.php','_self')</script>";
					}else{
						//	echo "<script>alert('Something Went Wrong!! Pls try againg ')</script>";
						echo "<h3>Profile Not Updated </h3>";
					}

			
				}
			}

			//update cover photo

function update_cover_photo(){
	if(isset($_POST['update_cp'])) {
		global $con;
			
					$cover_photo = $_FILES['cover_photo']['name'];
					$image_tmp = $_FILES['cover_photo']['tmp_name'];
					
					move_uploaded_file($image_tmp,"user/user_images/$cover_photo");
					

					$user=$_SESSION['user_email'];
			$get_user= " select * from users where user_email='$user' ";
			$run_user = mysqli_query($con,$get_user);
			$row = mysqli_fetch_array($run_user);

			$user_id = $row['user_id'];

					$updated ="UPDATE users SET  user_cover_photo='$cover_photo' WHERE user_id ='$user_id'";

					if(mysqli_query($con,$updated)) {
						
						echo "<h3>Cover Photo Updated Successfully</h3>";
					//echo "<script>alert('Your Profile Updated Successfully')</script>";
						//echo "<script>window.open('home.php','_self')</script>";
					}else{
						//	echo "<script>alert('Something Went Wrong!! Pls try againg ')</script>";
						echo "<h3>Cover Photo  Not Updated </h3>";
					}

			
				}
			}

//display all post of user
function user_posts(){
			global $con;

			$per_page = 5;
			if (isset($_GET['page'])) {
					$page = $_GET['page'];
			}
			else{
			$page = 1;
		}
			$user=$_SESSION['user_email'];
			$get_user= " select * from users where user_email='$user' ";
			$run_user = mysqli_query($con,$get_user);
			$row = mysqli_fetch_array($run_user);

			$user_id = $row['user_id'];
			$user_id1 = $row['user_id'];


		if (isset($_GET['user_id'])) {
			$user_id= $_GET['user_id'];
		}
		$start_from = ($page-1)*$per_page;
		$get_posts = " select * from posts where user_id='$user_id' ORDER by 1 DESC LIMIT $start_from, $per_page ";
		$run_posts = mysqli_query($con,$get_posts);

		while ($row_posts= mysqli_fetch_array($run_posts)) {
			
			$post_id = $row_posts['post_id'];
			$user_id = $row_posts['user_id'];
			$topic_title = $row_posts['topic_title'];
			$content = $row_posts['post_content'];
			$post_date = $row_posts['post_date'];


			//getting the user who has posted the thread

			$user = " select * from users where user_id = '$user_id' AND posts ='yes' ";

			$run_user = mysqli_query($con,$user);
			$row_user = mysqli_fetch_array($run_user);
			$user_name = $row_user['user_name'];
			$user_image = $row_user['user_image'];

			if ($user_id != $user_id1) {

			//now dispalying all at one

			echo "
				<div id='posts'>
					<p><img src='user/user_images/$user_image' width='50' height='50'/></p>
					<h3><a href='user_profile.php?user_id=$user_id'>$user_name</a></h3>
					<h3>$topic_title</h3>
					<p>$post_date</p>
					<p>$content</p>

			
					<a href='single.php?post_id=$post_id' style='float:right; padding-top:5px;'><button>View</button></a></div></br>
					
					
					
			";
			
				}else{
			
						echo "
				<div id='posts'>
					<p><img src='user/user_images/$user_image' width='50' height='50'/></p>
					<h3><a href='user_profile.php?user_id=$user_id'>$user_name</a></h3>
					<h3>$topic_title</h3>
					<p>$post_date</p>
					<p>$content</p>
					<a href='single.php?post_id=$post_id' style='float:right; padding-top:5px;'><button>View</button></a>
				<a href='functions/delete_my_post.php?post_id=$post_id' style='float:right; padding-top:5px;'><button>Delete</button></a>
				<a href='edit_my_post.php?post_id=$post_id' style='float:right; padding-top:5px;'><button>Edit</button></a></div></br>";
						
							}
			include 'delete_my_post.php';

		}
		include 'my_post_pagination.php';
}


	

//user_profile information page
function user_profile(){

	if (isset($_GET['user_id'])) {
		
		
		global $con;
			$user=$_SESSION['user_email'];
			$get_user= " select * from users where user_email='$user' ";
			$run_user = mysqli_query($con,$get_user);
			$row = mysqli_fetch_array($run_user);

			$user_id1 = $row['user_id'];
			

		$user_id = $_GET['user_id'];
		$select = " select * from users where user_id='$user_id' ";
		$run = mysqli_query($con,$select);
		$row = mysqli_fetch_array($run);

		$id= $row['user_id'];
		$image= $row['user_image'];
		$name= $row['user_name'];
		$country= $row['user_country'];
		$gender= $row['user_gender'];
		$last_login= $row['last_login'];
		$register_date= $row['register_date'];
		
		


		
		
			echo "<div id='user_profile'>

					<img src='user/user_images/$image' width='150' height='150' />
					<br/>
					<p><strong>Name :</strong> $name</p>
					<p><strong>Gender :</strong> $gender</p>
					<p><strong>Country :</strong> $country</p>
					<p><strong>Last Login :</strong> $last_login</p>
					<p><strong>Member Since :</strong> $register_date</p>
					<br/>
					<br/>
					<br/>
					<a style='float:left' href='my_posts.php?user_id=$user_id'><button>Timeline</button></a>";
			
					
							if ($user_id != $user_id1) {
			echo "<a style='float:left'  href='messages.php?user_id=$id'><button>Send Message</button></a>";
		}
	

				
				}
			

}

// new member calling function
function new_members(){

	global $con;

	$user = " select * from users LIMIT 0,20 ";
	$run_user = mysqli_query($con,$user);

	echo "<br/><h2>New Members on this site:</h2><hr>";

	while ($row_user=mysqli_fetch_array($run_user)) {
		
		$user_id = $row_user['user_id'];
		$user_name = $row_user['user_name'];
		$user_image = $row_user['user_image'];

		echo "

			<span>
			<a href='user_profile.php?user_id=$user_id'>
			<img src ='user/user_images/$user_image' width='50' height='50' title='$user_name' style='float:left;' /></a>
			</span>

		";

	}
}

function InsertUser(){
	global $con;
	
}



?>