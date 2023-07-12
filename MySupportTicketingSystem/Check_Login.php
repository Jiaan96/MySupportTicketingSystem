<?php 

require "credential.php";

session_start();

$query = "SELECT SESSIONID FROM USERS WHERE USERID = '".$_SESSION['userID']."'";

$result = $mysqli->query($query);

$result_array = $result -> fetch_array();

$sessID = $result_array['SESSIONID'];

//check current session id and the session id from the database
//if not same, then will logout
if($_SESSION['user_session_id'] === $sessID)
{
	$data['output'] = 'login';
}
else
{
	$data['output'] = 'logout';
}

echo json_encode($data);

?>