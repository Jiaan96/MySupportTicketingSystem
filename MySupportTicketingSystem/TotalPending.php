<?php 
	require "credential.php";
	
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: " . $mysqli->connect_error;
	} else {
	
		// show the total of pending ticketS
	
		$query = "SELECT COUNT(TICKETID) AS TOTAL FROM TICKETINGMASTER WHERE COMPLETEDTIME IS NULL";
		$result = $mysqli->query($query);
		$row = $result->fetch_assoc();

		echo $row['TOTAL'];
	}
?>