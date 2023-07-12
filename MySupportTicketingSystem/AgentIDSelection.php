<?php
	require "credential.php";
	
	session_start();
	
	if (!isset($_SESSION['agentIDInquiry'])) {
		$_SESSION['agentIDInquiry'] = $_SESSION['userID'];
	}

	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: " . $mysqli->connect_error;
		exit();
	}
			
	$stmt = $mysqli->prepare("SELECT USERID FROM USERS");
	$stmt->execute();
	$agentresult = $stmt->get_result();
		
	// show the selection with all user, including UNASSIGNED	
	
	echo "<option value='UNASSIGNED'";
	if($_SESSION['agentIDInquiry'] == "UNASSIGNED") {
		echo "selected";
	}
	echo ">UNASSIGNED</option>";
	
	if(isset($_POST['currentaction'])){
		
		// New Ticket button will always show current user by default
		if($_POST['currentaction'] == 'openform New Ticket'){
			
			while ($agentrow = $agentresult->fetch_assoc()) {
				echo "<option value='".$agentrow['USERID']."' "; 
				
				if($_SESSION['userID'] == $agentrow['USERID']) {
					echo "selected";
				}
				echo ">" . $agentrow['USERID'] . "</option>";
			}
			
		// Edit Ticket button will need to show the agent from the selected table row
		} else if($_POST['currentaction'] == 'openform Edit Ticket') {
	
			while ($agentrow = $agentresult->fetch_assoc()) {
			
				echo "<option value='".$agentrow['USERID']."' "; 
			
				if($_POST['agent'] == $agentrow['USERID']) {
					echo "selected";
				}
				echo ">" . $agentrow['USERID'] . "</option>";
			}
		}
		
	} else {
		
		while ($agentrow = $agentresult->fetch_assoc()) {
			echo "<option value='".$agentrow['USERID']."' "; 
			
			if($_SESSION['agentIDInquiry'] == $agentrow['USERID']) {
				echo "selected";
			}
			echo ">" . $agentrow['USERID'] . "</option>";
		}
	}

	$stmt->close();
	$mysqli->close();

?>