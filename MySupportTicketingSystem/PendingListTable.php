<?php

	require "credential.php";
	
	$query = "SELECT a.USERNAME, COUNT(b.TICKETID) AS TOTALPENDING FROM USERS a 
			LEFT JOIN TICKETINGMASTER b ON a.USERID = b.AGENTID 
			WHERE b.COMPLETEDTIME IS NULL 
			GROUP BY a.UserName 
			ORDER BY `TOTALPENDING` DESC";
	$result = $mysqli->query($query);			
	$fields = mysqli_fetch_fields($result);
	$headers = array();
	
	
	// to show the total number of pending ticket by agents
	echo "<div class='tblContainer'>";
		echo "<table class='tbl'>";
			echo "<thead class='tblHead'>";
				echo "<tr>";	
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

?>