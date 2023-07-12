<?php
	require "credential.php";
	
	session_start();
	// Check for connection errors
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: " . $mysqli->connect_error;
		exit();
	}
	
	//set time zone
	date_default_timezone_set('Asia/Kuala_Lumpur');
	
	//process to create new article
	if (isset($_POST['title']))
	{
		$kbID = $_POST['kbID'];
		$title = $_POST['title'];
		$description = $_POST['description'];
		$updatedby = $_SESSION['userID'];
		$updatedtime = date('Y-m-d H:i:s');

		if ($kbID <> null){
			$stmt = $mysqli->prepare("UPDATE KNOWLEDGEBASE SET TITLE=?, DESCRIPTION=?, UPDATEDBY=?, UPDATEDTIME=? WHERE KBID=?");
			$stmt->bind_param("sssss", $title, $description , $updatedby, $updatedtime, $kbID);
		} else {
			// Prepare the SQL statement
			$stmt = $mysqli->prepare("INSERT INTO KNOWLEDGEBASE (TITLE, DESCRIPTION, UPDATEDBY, UPDATEDTIME) VALUES (?,?,?,?)");
			// Bind the parameters to the statement
			$stmt->bind_param("ssss", $title, $description , $updatedby, $updatedtime);
		}


		// Execute the statement
		// set session response for sending back the response
		if ($stmt->execute()) {
			$_SESSION['response'] = "Record inserted successfully.";
		} else {
			$_SESSION['response'] = "Error: " . $mysqli->error;
		}

		// Close the statement and database connection
		$stmt->close();
		$mysqli->close();
	}
?>