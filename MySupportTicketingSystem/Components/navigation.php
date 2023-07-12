<a href= "./Home.php">Home</a>
<a href= "./Ticketing.php">Ticketing</a>
<a href= "./KnowledgeBase.php">KnowledgeBase</a>
<a href= "./Agent.php">Agent</a>
<!-- To show login or logout button dynamically-->
<?php
	session_start();

	if (isset($_SESSION['userID'])) {
	  echo "<a style='float: right;' href= javascript:void(0); onclick='logout()'>Logout</a>";
	} else if (!isset($_SESSION['userID'])) {
		echo "<a style='float: right;' href= './Login.php'>Login</a>";
	}
?>

