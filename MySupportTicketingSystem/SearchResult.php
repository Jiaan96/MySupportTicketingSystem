<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
	$('form[id^="editcontainerform_"]').submit(function(e) {
		//prevent refresh the page after submit form
		e.preventDefault(); 
			
		var formData = $(this).serializeArray();
		
		// form data send to another php file to handle post request
		// refresh the search result
		$.post('ArticleProcess.php',formData, function(){
			
			$('#response').load('Response.php');
						
			$('.form-popup').css('display', 'none');
			
			$('#result').load('SearchResult.php');
			
		});
		
		document.getElementsByClassName("form-container").reset();
	});
</script>

<?php

	require "credential.php";
	
	session_start();

	if (isset($_SESSION['result'])){
		
		$result = $_SESSION['result'];
		
		// display the search result
		// result are able to clicked for edit
		 foreach ($result as $row) {
			echo "<hr>";
			echo "<div class='kbresult' onclick='openKBForm(".$row['KBID'].")'>";	
				echo "<h2>Title : ".$row['TITLE']."</h2>";
				echo "<pre>";
					echo $row['DESCRIPTION'];
				echo "</pre>";
			
			echo "</div>";
			echo "<br>";
			echo "<div class='form-popup' id='popupKBform_".$row['KBID']."'>";
				echo "<form action='ArticleProcess.php' method = 'POST' class='form-container' id='editcontainerform_".$row['KBID']."'>";
					echo "<h2>Edit Article</h2>";

					echo "<input type='hidden' id='kbID' name='kbID' value=" .$row['KBID'].">";


					echo "<label for='title'><b>Title</b></label>";
					echo "<input type='text' placeholder='Title' id='title' name='title' value='".$row['TITLE']."' required>";
					echo "<br>";
					echo "<label for='description'><b>Description :</b></label>";
					echo "<br>";
					echo "<textarea id='description' name='description' rows='20' cols='180'>".$row['DESCRIPTION']."</textarea>";
					echo "<br>";
					echo "<button type='submit' class='btn'>Save</button>";
					echo "<button type='button' class='btn cancel' onclick='closeKBForm(".$row['KBID'].")'>Close</button>";
				echo "</form>";
			echo "</div>";
		}
		
		unset($_SESSION['result']);
		
	}

?>