<?php

include 'includes/connection.php';


?>
<!DOCTYPE html>


<html>
	
	<head>
		<title>Welcome To Admin Area</title>
		<link rel="stylesheet" type="text/css" href="admin_style.css" media="all" />
	</head>

<body>
	
	<div class="container">
		<div id="head">
			<img src="bg-header.jpg" />
		</div>
		
		
		<div id="sidebar">
			<h2>Manage Content:</h2>
			<ul id="menu">
				<li><a href="view_users.php">View Users</a></li>
				<li><a href="view_posts.php">View Posts</a></li>
				<li><a href="add_topics.php">Add New Topics</a></li>
				<li><a href="view_topics.php">View Topics</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
			</div>