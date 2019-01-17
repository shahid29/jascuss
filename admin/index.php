<?php
session_start();

include 'includes/connection.php';
if (!isset($_SESSION['admin_email'])) {
	
	header('location:login.php');
}else
{

include 'home.php';

 include 'footer.php';
 }?>