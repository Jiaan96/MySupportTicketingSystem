<?php

	session_start();

	require "credential.php";
	// Check for connection errors
	if ($mysqli->connect_errno) {
		$_SESSION['response'] = "Failed to connect to MySQL: " . $mysqli->connect_error;
		exit();
	}
	
	//Process to change password
	if (isset($_POST['oldPW']))
	{
		$userID = $_POST['userID'];
		$oldPW = $_POST['oldPW'];
		$newPW = $_POST['newPW'];
		$confirmPW = $_POST['confirmPW'];

		$stmt = $mysqli->prepare("SELECT PASSWORD FROM USERS WHERE USERID = ?");
		$stmt->bind_param("s", $userID);
		$stmt->execute();
		$result = $stmt->get_result();
		
		while ($row = $result->fetch_assoc()){
			$truePW = $row['PASSWORD'];
		}
		
		
		if ($truePW == $oldPW){
			
			if ($newPW == $confirmPW){
				// Prepare the SQL statement
				$stmt = $mysqli->prepare("UPDATE USERS SET PASSWORD = ? WHERE USERID = ?");
				$stmt->bind_param("ss", $confirmPW, $userID);
				$stmt->execute();

				// Execute the statement
				// set session response for sending back the response
				if ($stmt->execute()) {
					$_SESSION['response'] = "Password Changed Successfully";
				} else {
					$_SESSION['response'] = "Error: " . $mysqli->error;
				}
			} else {
				$_SESSION['response'] = "Password Not Match";
			}
			
		} else {
			$_SESSION['response'] = "Password Incorrect";
		}
		// Close the statement and database connection
		$stmt->close();
		$mysqli->close();
	}
	
?>  