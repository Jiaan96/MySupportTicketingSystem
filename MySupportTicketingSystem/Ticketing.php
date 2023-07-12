<?php
	session_start();

	if (!isset($_SESSION['userID'])) {
		$_SESSION['response'] = "Please sign in first!";
		header('Location: Login.php');
		exit();
	}
?>

<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="Style.css">
		<title>Ticketing</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<script src="Script.js"></script>
		<script src="Ticketing.js"></script>
	</head>

	<body>
		<header></header>
		<nav></nav>
		<hr>		
		<?php 
			echo "Welcome, " . $_SESSION['userID']; 
		?>
		<br/>
		<button value = "New Ticket" onclick="openForm(this)">New Ticket</button>
		<button value = "Edit Ticket" onclick="openForm(this)">Edit Ticket</button>
		<br>
		
		<select name="agentIDSelection" id="agentIDSelection" onchange="refreshTicketTable()">
			<?php
				require "AgentIDSelection.php";
				
				echo "<option value='SHOW ALL'";
				if($_SESSION['agentIDInquiry'] == "SHOW ALL") {
					echo "selected";
				}
				echo ">SHOW ALL</option>";
			?>
		</select >		
			
		<div class="response" id="response"></div>		

		<div class="form-popup" id="popupform">
			<form action="TicketingProcess.php" method = "POST" class="form-container" id="containerform">
				<h2></h2>
				<input type="hidden" id="ticketID" name="ticketID">
				<br>
				
				<button class="btn" type="submit">Save</button>
				<button onclick="closeForm()" class="btn cancel" type="button">Close</button>
				<br>
				
				<label for="complete"><b>Complete?</b></label>
				<input type="checkbox" id="complete" name="complete">
				<br>
				
				<label for="product"><b>Product Name</b></label>
				<input type="text" placeholder="Product Name" id="product" name="product">
				<br>
				
				<label for="clientname"><b>Client Name</b></label>
				<input type="text" placeholder="Client Name" id="clientname" name="clientname" required>
				<br>
				
				<label for="contactno"><b>Contact No.</b></label>
				<input type="text" placeholder="Contact No." id="contactno" name="contactno">
				<br>
				
				<label for="emailaddress"><b>Client Email</b></label>
				<input type="text" placeholder="Email Address" id="emailaddress" name="emailaddress">
				<br>
				
				<label for="agentID"><b>Agent</b></label>
				<select class="agentID" id="agentID" name="agentID"></select>			
				<br>
				
				<label for="subject"><b>Subject</b></label>
				<input type="text" placeholder="Subject" id="subject" name="subject">			
				<br>
				
				<label for="ticketdescription"><b>Description</b></label>
				<br>
				<textarea rows="10" cols="180" ID="ticketdescription" name="ticketdescription" ></textarea>			
			</form>
		</div>
		<br/>
		
		<div class="ticketingtable" id="ticketingtable"></div>
		<br>
		
	</body>
	
	<footer></footer>
</html>