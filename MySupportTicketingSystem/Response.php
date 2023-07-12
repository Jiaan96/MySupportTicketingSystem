<?php
	session_start();	

	//used for retrieve response sent from other php file
	if (isset($_SESSION['response'])) {
		// Display the response
		echo $_SESSION['response'];

		// Unset the session variable to avoid displaying it again
		unset($_SESSION['response']);
	}
?>