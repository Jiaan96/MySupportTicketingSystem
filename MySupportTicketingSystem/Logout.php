<?php
	session_id($_SESSION['user_session_id']);
	session_start();
	session_destroy();
	header("Location: Login.php");
?>