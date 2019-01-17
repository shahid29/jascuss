
<?php
$con= mysqli_connect("localhost","root","","social_network") or die("Connection was not established");

//============================================================Search People=============================================//
function find_people_sn(){
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
					
					$sn";

			

		}
	}
		
}





function find_people_name(){
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
					
					<a href='user_profile.php?user_id=$user_id'><button>$user_name</button></a>
					
					
					
					
			";

		

		}
	}
		
}

function find_people_image(){
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
					
					<img src='user/user_images/$user_image' width='50' height='50'/>   
					
					
					
			";

	

		}
	}
		
}





function find_people_sendRequest(){
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

//============================================================Search People ENd =============================================//
?>