<?php
	require "credential.php";
	
	session_start();
	
	// Check for connection errors
	if ($mysqli->connect_errno) {
		$_SESSION['response'] = "Failed to connect to MySQL: " . $mysqli->connect_error;
		exit();
	}
	
	//set time zone
	date_default_timezone_set('Asia/Kuala_Lumpur');
	
	// process to create / edit ticket
	if (isset($_POST['product']))
	{
		$ticketID = $_POST['ticketID'];
		$product = $_POST['product'];
		$clientname = $_POST['clientname'];
		$contactno = $_POST['contactno'];
		$emailaddress = $_POST['emailaddress'];
		$agentID = $_POST['agentID'];
		$subject = $_POST['subject'];
		$ticketdescription = $_POST['ticketdescription'];
		$createdtime = date('Y-m-d H:i:s');
		
		if (isset($_POST['complete'])) {
			$completedtime = date('Y-m-d H:i:s');
		} else {
			$completedtime = null;
		}
	
	
		// if there is no ticket id, then is new ticket, else is edit existing ticket
		if ($ticketID <> null){
			$stmt = $mysqli->prepare("UPDATE TICKETINGMASTER SET PRODUCT=?, CLIENTNAME=?, CONTACTNO=?, EMAILADDRESS=?, AGENTID=?, SUBJECT=?, TICKETDESCRIPTION = ?, COMPLETEDTIME = ? WHERE TICKETID=?");
			$stmt->bind_param("sssssssss", $product, $clientname, $contactno, $emailaddress, $agentID, $subject, $ticketdescription, $completedtime, $ticketID);
		} else {
			// Prepare the SQL statement
			$stmt = $mysqli->prepare("INSERT INTO TICKETINGMASTER (PRODUCT, CLIENTNAME, CONTACTNO, EMAILADDRESS, AGENTID, SUBJECT, TICKETDESCRIPTION, CREATEDTIME, COMPLETEDTIME) VALUES (?,?,?,?,?,?,?,?,?)");
			// Bind the parameters to the statement
			$stmt->bind_param("sssssssss", $product, $clientname, $contactno, $emailaddress, $agentID, $subject, $ticketdescription, $createdtime, $completedtime);
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