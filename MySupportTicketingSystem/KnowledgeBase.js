$(document).ready(function(){
			
	$('#containerform').submit(function(e) {
		//prevent refresh the page after submit form
		e.preventDefault(); 
			
		var formData = $(this).serializeArray();
			
		// form data send to another php file to handle post request
		$.post('ArticleProcess.php',formData, function(){
			
			$('#response').load('Response.php');
						
			$('#popupform').css('display', 'none');
			
			
		});
		
		document.getElementById("containerform").reset();
	});	
	
	$('#searchcontainerform').submit(function(e) {
		//prevent refresh the page after submit form
		e.preventDefault(); 
			
		var formData = $(this).serializeArray();
		
		// form data send to another php file to handle post request, then load the result
		$.post('SearchArticleProcess.php',formData, function(e){
			
			$('#result').load('SearchResult.php');
			
		});
		
	});	
	
});

//open the popup form
function openForm() {
  document.getElementById("popupform").style.display = "block";
}

//Close the popup form
function closeForm() {
	var popupform = document.getElementById("popupform");
	document.getElementById("containerform").reset();
	popupform.style.display = "none";
}

//open the pop up form based on different article id
function openKBForm(kbID) {
  document.getElementById("popupKBform_" + kbID).style.display = "block";
}

// Close the popup form based on different article id
function closeKBForm(kbID) {
  document.getElementById("popupKBform_" + kbID).style.display = "none";
}