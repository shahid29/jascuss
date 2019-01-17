<?php

	session_start();
	unset($_SESSION['SESS_MEMBER_ID']);
    unset($_SESSION['SESS_FIRST_NAME']);
    unset($_SESSION['SESS_LAST_NAME']);
   
	include 'functions/functions.php';
	include 'template/header.php';
	include 'template/content.php';
	include 'template/footer.php';
	include 'login.php';
	 if (isset($_SESSION['user_email'])) {
		header('location:home.php');
		
	}
	
?>


 