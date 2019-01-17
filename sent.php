<table width="550" align="center">
			<tr align="center">
				<td colspan="4"><h2>See Your Sent Messages:</h2></td>
			</tr>
			<tr>
				<th>Receiver:</th>
				<th>Subject</th>
				<th>Date</th>
				<th>Reply</th>
				

			</tr>
			
		
		<?php

		 $sel_msg = " select * from messages where sender='$user_id1'  ";
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

			$get_receiver =" select * from users where user_id='$receiver' ";
			$run_receiver = mysqli_query($con,$get_receiver);
			$row = mysqli_fetch_array($run_receiver);

			$receiver_name =$row['user_name'];
		

		?>
			<tr align="center">
				<td>
				<a target="blank" href="user_profile.php?user_id=<?php echo $receiver; ?>" >
				<?php echo $receiver_name; ?>
				</a>	
				</td>
				<td><a href="my_messages.php?msg_id=<?php echo $msg_id?>"><?php echo $msg_sub; ?></a></td>
				<td><?php echo $msg_date; ?></td>
				<td><a href="my_messages.php?msg_id=<?php echo $msg_id?>">View Reply</a></td>
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

			if ($msg_content!='no_reply') {
				echo " <h2 align='center'>Messages Was Already Replied</h2> ";
				exit();
				
			}else{

			$update = " update messages set reply='$reply' where msg_id='$msg_id'  ";
			$check = mysqli_query($con,$update);

			if ($check) {
				
				echo " <h2 align='center'>Messages Was Replied</h2> ";
				}
			}
		}
exit();
		?>
