$(document).ready(function(){
	//load all default element
	$('header').load('Components/header.php');
	$('nav').load('Components/navigation.php');
	$('#response').load('Response.php');
	$('footer').load('Components/footer.php');
});

function logout(){
	
	var xhttp = new XMLHttpRequest();

	// Define the callback function to handle the response from the server
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			// Redirect the user to the login page
			window.location.replace("Login.php");
		}
	};

	// Send a POST request to the logout script
	xhttp.open("POST", "Logout.php", true);
	xhttp.send();
	
}

//allow table row able to be selected when clicked
function selectRow(row) {
  // Remove the "selected" class from all rows
  var rows = document.getElementsByTagName("tr");
  for (var i = 0; i < rows.length; i++) {
    rows[i].classList.remove("selected");
  }
  
  // Add the "selected" class to the selected row
  row.classList.add("selected");
}



//check the check login php reponds login or logout
function check_session_id()
{
    var session_id = "<?php echo $_SESSION['user_session_id']; ?>";

    fetch('Check_Login.php').then(function(response){

        return response.json();

    }).then(function(responseData){

        if(responseData.output == 'logout')
        {
            window.location.href = 'Logout.php';
        }

    });
}

//session id will be check for every 10 second
setInterval(function(){

    check_session_id();
    
}, 10000);


