<?php
	require "credential.php";
	
	session_start();
	
	//to get the user currently viewing thhe ticketing table of which agent
	if(isset($_POST['agentIDInquiry'])){
		$_SESSION['agentIDInquiry'] = $_POST['agentIDInquiry'];
	}

	if (!isset($_SESSION['agentIDInquiry'])) {
		$_SESSION['agentIDInquiry'] = $_SESSION['userID'];
	}

	if(isset($_SESSION['agentIDInquiry'])){
		$_POST['agentIDInquiry'] = $_SESSION['agentIDInquiry'];
	}
	
	
	
	// if the agent id selection is show all, then sql query no need the where clause
	// if user did not make any changes on the agent id selection, it will show current user ticketing table by default
	if (isset($_POST['agentIDInquiry'])){	
	
		if ($_POST['agentIDInquiry'] == "SHOW ALL"){	
		
			$stmt = " ";
				
		} else {
			
			$stmt = "WHERE AGENTID = '" .$_POST['agentIDInquiry']. "' AND COMPLETEDTIME IS NULL";
					
		}
					
	} else {
					
		$stmt = "WHERE AGENTID = '" .$_SESSION['userID']. "' AND COMPLETEDTIME IS NULL";
					
	}
	
	
	
	$max_rows = 10;

	// Retrieve the total number of rows from the database table
	$total_rows_query = "SELECT COUNT(*) AS total_rows FROM TICKETINGMASTER ".$stmt;
	$total_rows_result = $mysqli->query($total_rows_query);
	if (!$total_rows_result) {
	  die('Error: ' . mysqli_error($mysqli));
	}
	$total_rows_row = $total_rows_result->fetch_assoc();

	$total_rows = $total_rows_row['total_rows'];	
	// Determine the number of pages
	$total_pages = ceil($total_rows / $max_rows);
	// Get the current page number from the query string or set a default value
	$current_page = isset($_POST['page']) ? $_POST['page'] : 1;

	// Calculate the offset for the current page
	$offset = ($current_page - 1) * $max_rows;

	//for ticketing table
	echo "<div class='tblContainer'>";
		echo "<table class='tbl'>";

				echo "<thead class='tblHead'>";
					echo "<tr>";	
						$query = "SELECT * FROM TICKETINGMASTER "  .$stmt. " ORDER BY CREATEDTIME DESC LIMIT $max_rows OFFSET $offset";
						$result = $mysqli->query($query);			
						$fields = mysqli_fetch_fields($result);
						$headers = array();
						
						foreach ($fields as $field) {
							$headers[] = $field->name;
						}

						// Print the headers
						foreach ($headers as $header) {

							echo "<th>" . $header . "</th>";

						}		
									
					echo "</tr>";		
				echo "</thead>";


			echo "<tbody class='tblBody'>";


				while ($row = $result->fetch_assoc()) {
					echo "<tr onclick='selectRow(this)'>";
					for ($i = 0; $i < count($headers); $i++){
						echo "<td>" . $row[$headers[$i]] . "</td>";
					}
					echo "</tr>";
				}



			echo "</tbody>";

		echo "</table>";
	echo "</div>";

	//for pagination
	echo "<div class='pagination'>";
		// Add buttons to navigate to previous or next pages
		if ($current_page > 1) {
			echo "<button value = '".($current_page - 1)."' onclick='turnPage(this)' class='prevpage'>Previous</button>";
		}
		if ($current_page < $total_pages) {
			echo "<button value = '".($current_page + 1)."' onclick='turnPage(this)' class='nextpage'>Next</button>";
		}
	echo "</div>";
	
?>	