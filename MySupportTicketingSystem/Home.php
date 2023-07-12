<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="Style.css">
		<title>My Support Ticketing System</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<script src="Script.js"></script>
		<script src="Home.js"></script>
	</head>

	<body>
		<header></header>
		<nav></nav>
		<hr/>
		<div>
			<?php 
				session_start();
				
				if (isset($_SESSION['userID'])) {
					echo "Welcome, " . $_SESSION['userID']; 
				}
			?>
		</div>
		<div class = "container-left" id="left-container">
			<div class = "container-unassigned" id="unassigned-container">
				<h1>Total Unassigned</h1>
				<p></p>
			</div>
			<div class = "container-pending" id="pending-container">
				<h1>Total Pending</h1>
				<p></p>
			</div>
		</div>
		<div class = "container-right" id = "right-container">
			<div class = "container-agent" id="agent-container">
				<h1>Pending List By Agent</h1>
				<div id = "pending-List-Table"></div>
			</div>
		</div>
	</body>
	
	<footer></footer>
</html>