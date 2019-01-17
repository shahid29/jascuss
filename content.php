<!--Content Start Here-->
		<div id="content">
			<div>
				<img src="images/image.png" style="float:left;margin-left:-40px;"/>
			</div>
			<div id="form2">
				<form method="post" action="">
				
				<h2 style="margin-left: 150px; padding-bottom: 5px;">Sign Up Here</h2>
				<?php include 'user_insert.php'; ?>
					<table>
					<tr>
						<td align="right">Name:</td>
						<td>
							<input type="text" name="u_name" placeholder="Enter Your Name" required="required"/>
						</td>
					</tr>
					
					<tr>
						<td align="right">Password:</td>
						<td>
							<input type="text" name="u_pass" placeholder="Enter Your Password" required="required"/>
						</td>
					</tr>
					
					<tr>
						<td align="right">Email:</td>
						<td>
							<input type="email" name="u_email" placeholder="Enter Your Name" required="required"/>
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
							<select name="u_country" required="required">
								<option>Select Your Country</option>
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
							<select name="u_gender" required="required">
								<option>Select Your Gender</option>
								<option>Male</option>
								<option>Female</option>
								
							</select>
						</td>
					</tr>
				
					<tr>
						<td align="right">Birthdeay:</td>
						<td>
							<input type="date"  placeholder="dd/mm/yyyy" name="u_birthday" / >
						</td>
					</tr>
				
					<tr>
						<td colspan="6">
							<button name="sign_up">Sign Up</button>
						</td>
					</tr>
					</table>
				</form>
					
			</div>
		</div>
	<!--Content end Here-->	