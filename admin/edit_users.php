<?php include 'home.php';?>
<?php
include 'includes/connection.php';
	
	
	if (isset($_GET['edit'])) {
		
		$get_id = $_GET['edit'];
	
		$sel_users = " select * from users where user_id='$get_id' ";
		$run_users = mysqli_query($con,$sel_users);
		
		$row_users= mysqli_fetch_array($run_users);
			
			$user_id = $row_users['user_id'];
			$user_name = $row_users['user_name'];
			$user_country = $row_users['user_country'];
			$user_gender = $row_users['user_gender'];
			$user_image = $row_users['user_image'];
			$user_reg_date= $row_users['register_date'];
			$user_pass = $row_users['user_pass'];
			$user_email = $row_users['user_email'];
		
	?>

<form method="POST" action="" name ="update" id="ct_form"  enctype="multipart/form-data">
				
				
					<table>
					<tr align="center">
						<td colspan="6"><h2>Edit User:</h2></td>
					</tr>
					<tr>
						<td align="right">Name:</td>
						<td>
							<input type="text" name="u_name"  required="required" value="<?php echo $user_name;?>"/>
						</td>
					</tr>
					
					<tr>
						<td align="right">Password:</td>
						<td>
							<input type="text" name="u_pass" required="required" value="<?php echo $user_pass;?>"/>
						</td>
					</tr>
					
					<tr>
						<td align="right">Email:</td>
						<td>
							<input type="email" name="u_email"  required="required" value="<?php echo $user_email;?>"/>
						</td>
					</tr>
					<!--
					<tr>
						<td align="right">Phone:</td>
						<td>
							<input type="text" name="u_phone" placeholder="Enter Your Phone Number" required="required"/>
						</td>
					</tr>-->
				
					<tr>
						<td align="right">Country:</td>
						<td>
							<select name="u_country">
								<option><?php echo $user_country;?></option>
								<option>Argentina</option>
								<option>Brasil</option>
								<option>Bangladesh</option>
								<option>United Kindom(UK)</option>
								<option>United States(US)</option>
								
							</select>
						</td>
					</tr> 
					<tr>
						<td align="right" >Gender:</td>
						<td>
							<select name="u_gender">
								<option><?php echo $user_gender;?></option>
								<option>Male</option>
								<option>Female</option>
								
							</select>
						</td>
					</tr>
					<tr>
						<td align="right">Image:</td>
						<td>
							<input type="file"  name="u_image" required="required"/ >
						</td>
					</tr>
				<!--
					<tr>
						<td align="right">Birthdeay:</td>
						<td>
							<input type="date"  name="u_birthday" / >
						</td>
					</tr>-->
				
					<tr>
						<td colspan="6">
							<input type="submit" name="update" value="Update"/>
						</td>
					</tr>
					</table>
			
				</form>
				<?php }?>
			

			<?php 
				if(isset($_POST['update'])) {
		global $con;
			
					$u_name = $_POST['u_name'];
					$u_pass = $_POST['u_pass'];
					$u_email = $_POST['u_email'];
					$u_country = $_POST['u_country'];
					$u_gender = $_POST['u_gender'];
					
					$u_image = $_FILES['u_image']['name'];
					$image_tmp = $_FILES['u_image']['tmp_name'];
					
					move_uploaded_file($image_tmp,'../user/user_images/$u_image');
					

			

					$updated ="UPDATE users SET user_name='$u_name', user_pass='$u_pass', user_email='$u_email', user_country='$u_country',user_gender='$u_gender', user_image='$u_image' WHERE user_id ='$get_id'";

					if(mysqli_query($con,$updated)) {
						
						//echo "<h3 style='color:green'>Profile Updated Successfully</h3>";
					echo "<script>alert('Your Profile Updated Successfully')</script>";
					echo "<script>window.open('view_users.php','_self')</script>";
						//echo "<script>window.open('home.php','_self')</script>";
					}else{
							echo "<script>alert('Something Went Wrong!! Pls try againg ')</script>";
						//echo "<h3 style='color:red'>Profile Not Updated </h3>";
					}

			
				}
			
			?>	
<?php include 'footer.php';?>