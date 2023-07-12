<?php
	session_start();

	require "credential.php";
	// Check for connection errors
	if ($mysqli->connect_errno) {
		$_SESSION['response'] = "Failed to connect to MySQL: " . $mysqli->connect_error;
		exit();
	}
	
	//Process to create new agent
	if (isset($_POST['agentID'], $_POST['password']))
	{
		$agentID = $_POST['agentID'];
		$agentname = $_POST['agentname'];
		$password = $_POST['password'];

		// Prepare the SQL statement
		$stmt = $mysqli->prepare("INSERT INTO USERS (USERID, USERNAME, PASSWORD) VALUES (?,?,?)");

		// Bind the parameters to the statement
		$stmt->bind_param("sss", $agentID, $agentname, $password);

		// Execute the statement
		// set session response for sending back the response
		if ($stmt->execute()) {
			$_SESSION['response'] = "New User Created.";
		} else {
			$_SESSION['response'] = "Error: " . $mysqli->error;
		}

		// Close the statement and database connection
		$stmt->close();
		$mysqli->close();
	}
	
?> 