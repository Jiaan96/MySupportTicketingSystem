<?php
	session_start();

	if (isset($_SESSION['userID'])) {
	  header('Location: Ticketing.php');
	  exit();
	}
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
    	<link rel="stylesheet" href="Style.css">
    	<title>Login</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    	<script src="Script.js"></script>
    </head>
    
    <body>
        <header></header>
    	<nav></nav>
    	<hr>
    	<br>
    	<br>
    	<div class="container-login" id="login-container">
    	    Login
    		<form action="Login.php" method="post" name="formLogin">
    			<div>
    				<label for = "idUser">User ID</label><br>
    				<input type = "text" id="idUser" name = "txtUserID">
    				<br>
    				<label for = "idPassword">Password</label><br>
    				<input type = "password" id="idPassword" name = "txtPassword">
    				<br>
    				<input name="btnLogin" type="submit" value="Login" />
    			</div>
    		</form>
			
    		<?php
        		// Starts the session
				//add @ to suppresss warnning
        		@session_start();
        		
        		require 'credential.php';
				
        		// Checks if the user is trying to log in
        		if (isset($_POST['txtUserID'], $_POST['txtPassword']))
        		{
					$query = "SELECT * FROM USERS WHERE USERID = '".$_POST['txtUserID']."'";
					$result = $mysqli->query($query);
					if (!$result) {
						die('Query execution failed: ' . mysqli_error($mysqli));
					}
					

					if ($result->num_rows <> 0)
					{		

						$row = $result->fetch_assoc();	
								
						if ($_POST['txtUserID'] == $row["USERID"] && $_POST['txtPassword'] == $row["PASSWORD"] && $result->num_rows > 0)
						{

							//regenerate and get current session id 
							//for prevent duplicate login purpose
							session_regenerate_id();

							$user_session_id = session_id();

							$query2 = "UPDATE USERS SET SESSIONID = '".$user_session_id."' WHERE USERID = '".$_POST['txtUserID']."'";


							$result2 = $mysqli->query($query2);
				
							$_SESSION['userID'] = $_POST['txtUserID'];
							
							$_SESSION['user_session_id'] = $user_session_id;
							
							header("Location: Ticketing.php");
						}
						else 
						{
						
							echo 'Invalid login credentials, try again.';
			
						}
						
					} 
					else 
					{
						
						echo 'Invalid login credentials, try again.';
			
					}

        		}
        	?>
			<div class="response" id="response"></div>
        </div>
		
    </body>
	
	<footer></footer>
</html>