<?php
	session_start();

	if (!isset($_SESSION['userID'])) {
		$_SESSION['response'] = "Please sign in first!";
		header('Location: Login.php');
		exit();
	}
?>

<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="Style.css">
		<title>Knowledge Base</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<script src="Script.js"></script>
		<script src="KnowledgeBase.js"></script>
	</head>

	<body>
		<header></header>
		<nav></nav>
		<hr>
		<?php
			echo "Welcome, " . $_SESSION['userID'];
		?>
		<br/>
		<button onclick="openForm()">New Article</button>
		
		<div class="response" id="response"></div>

		<div class="form-popup" id="popupform">
			<form action="ArticleProcess.php" method = "POST" class="form-container" id="containerform">
				<h2>New Article</h2>
				
				<input type="hidden" id="kbID" name="kbID">
				
				<label for="title"><b>Title</b></label>
				<input type="text" placeholder="Title" id="title" name="title" required>
				<br>
				<label for="description"><b>Description :</b></label>
				<br>
				<textarea id="description" name="description" rows="20" cols="180"></textarea>
				<br>
				<button type="submit" class="btn">Save</button>
				<button type="button" class="btn cancel" onclick="closeForm()">Close</button>
			</form>
				  
		</div>

		<br/>
		
		<form action="SearchArticleProcess.php" method="POST" class="form-container-search" id="searchcontainerform">
			<input type="text" name="search" id="search" placeholder="Type here to search">
			<button type="submit" name="submit">Search</button>
		</form>
		
	
	<div class="result" id="result"></div>	
				
	</body>
	
	<footer></footer>
</html>