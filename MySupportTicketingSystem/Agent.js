$(document).ready(function(){
	$('#agenttable').load('./AgentTable.php');	

	$('#containerform').submit(function(e) {
		//prevent refresh the page after submit form
		e.preventDefault(); 
			
		var formData = $(this).serializeArray();
			
		// form data send to another php file to handle post request
		// referesh the table only without refresh the whole page
		$.post('NewAgentProcess.php',formData, function(){
			
			$('#response').load('Response.php');
			
			$('#agenttable').load('AgentTable.php');
			
			$('#popupform').css('display', 'none');
		});
		document.getElementById("containerform").reset();
	});
	
	$('#containerChangePWform').submit(function(e) {
		//prevent refresh the page after submit form
		e.preventDefault(); 
			
		var formData = $(this).serializeArray();
		
		// form data send to another php file to handle post request
		// referesh the table only without refresh the whole page		
		$.post('ChangePWProcess.php',formData, function(){
			
			$('#response').load('Response.php');
			
			$('#agenttable').load('AgentTable.php');
			
			$('#popupChangePWform').css('display', 'none');
		});
		document.getElementById("containerChangePWform").reset();
	});
	
});

function turnPage(pages) {
	
	var newPage = pages.value;
	
    $('#agenttable').load('AgentTable.php', {
		page: newPage
    });
}


//open pop up form
function openForm() {
  document.getElementById("popupform").style.display = "block";
}

//Close the popup form
function closeForm() {
	var popupform = document.getElementById("popupform");
	document.getElementById("containerform").reset();
	popupform.style.display = "none";
}

// open change pw form
function changePassword() {
  var selectedRow = document.querySelector("tr.selected");
  var userID = selectedRow.cells[0].textContent;

  // Populate the form fields with the data
  document.getElementById("userID").value = userID;
  // Show the pop-up form
  document.getElementById("popupChangePWform").style.display = "block";
};

//close change pw form
function changePasswordCloseForm() {
	document.getElementById("containerChangePWform").reset();
	document.getElementById("popupChangePWform").style.display = "none";
};