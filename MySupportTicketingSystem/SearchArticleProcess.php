<?php

	// Connect to the database
	require "credential.php";

	session_start();

	// Check for errors
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: " . $mysqli->connect_error;
		exit();
	}
	
	
	// process to search article
	if (isset($_POST['search'])){
	// Get the search query from the form input
		$search = $_POST['search'];

		// Prepare the SQL statement
		$stmt = $mysqli->prepare("SELECT * FROM KNOWLEDGEBASE WHERE TITLE LIKE ? OR DESCRIPTION LIKE ?");

		// Add the search query to the SQL statement
		$search_query = "%".$search."%";
		$stmt->bind_param("ss", $search_query, $search_query);

		// Execute the SQL statement
		$stmt->execute();

		// Get the results of the SQL query
		$result = $stmt->get_result();
		
		$result_array = array();
		
		while ($row = $result->fetch_assoc()) {
			$result_array[] = $row;
		}

		//send to SearchResult.php to used
		$_SESSION['result'] = $result_array;
					
	}
	
	// Close the database connection
	$mysqli->close();
?>