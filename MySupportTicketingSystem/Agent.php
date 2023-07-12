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
		<title>Agent</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<script src="Script.js"></script>
		<script src="Agent.js"></script>
	</head>

	<body>
		<header></header>
		<nav></nav>
		<hr>
		<?php
			echo "Welcome, " . $_SESSION['userID'];
		?>
		<br/>
		<button onclick="openForm()">New Agent</button>
		<button onclick="changePassword()">Change Password</button>
		
		
		<div class="response" id="response"></div>
		<br>
		<div class="form-popup" id="popupform">
			<form action="NewAgentProcess.php" method = "POST" class="form-container" id="containerform">
				<h2>New Agent</h2>
				
				<label for="agentID"><b>Agent ID</b></label>
				<input type="text" placeholder="Your Agent ID" name="agentID" required>
				<br>
				<label for="agentname"><b>Agent Name</b></label>
				<input type="text" placeholder="Your Agent Name" name="agentname">
				<br>
				<label for="password"><b>Password</b></label>
				<input type="password" placeholder="Your Password" name="password" required>
				<button class="btn" type="submit">Save</button>
				<button type="button" class="btn cancel" onclick="closeForm()">Close</button>
			</form> 
		</div>	

		<div class="form-popup" id="popupChangePWform">
			<form action="ChangePWProcess.php" method = "POST" class="form-container" id="containerChangePWform">
				<h2>Change Password</h2>
				
				<input type="hidden" id="userID" name="userID">
				
				<label for="oldPW"><b>Old Password</b></label>
				<input type="password" placeholder="Please Enter Your Old Password" name="oldPW" required>
				<br>
				<label for="newPW"><b>New Password</b></label>
				<input type="password" placeholder="Your New Password" name="newPW" required>
				<br>
				<label for="confirmPW"><b>Confirm Password</b></label>
				<input type="password" placeholder="Confirm Your New Password" name="confirmPW" required>
				<br>
				<button class="btn" type="submit">Save</button>
				<button type="button" class="btn cancel" onclick="changePasswordCloseForm()">Close</button>
			</form>

		</div>

		<br/>
		
		<div class="agenttable" id="agenttable"></div>
		<br>			
	</body>
	
	<footer></footer>
</html>