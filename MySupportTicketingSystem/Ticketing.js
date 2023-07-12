$(document).ready(function(){

	$('#ticketingtable').load('TicketingTable.php');
			
	$('#containerform').submit(function(e) {
		//prevent refresh the page after submit form
		e.preventDefault(); 
			
		var formData = $(this).serializeArray();
			
		// form data send to another php file to handle post request
		// referesh the table only without refresh the whole page
		$.post('TicketingProcess.php',formData, function(){
			
			$('#response').load('Response.php');
			
			$('#ticketingtable').load('TicketingTable.php',{				
								
				agentIDInquiry: agentIDSelection.value
			});
			
			$('#popupform').css('display', 'none');
			
		});
		
		document.getElementById("containerform").reset();
	});	
});

// changing the agent id selection from ticketing page will refresh the table
function refreshTicketTable() {
	
	var agentIDSelection = document.getElementById("agentIDSelection");
	
    $('#ticketingtable').load('TicketingTable.php', {
        agentIDInquiry: agentIDSelection.value
    });
}

function turnPage(pages) {
	
	var agentIDSelection = document.getElementById("agentIDSelection");
	var newPage = pages.value;
	
    $('#ticketingtable').load('TicketingTable.php', {
        agentIDInquiry: agentIDSelection.value,
		page: newPage
    });
}

//open popup form 
function openForm(button) {
	
	var buttontext = button.value;

        $('h2').text(buttontext);
		
		//New ticket button simply open form
		//Edit ticket button will need load the data from the ticketing table
		if (buttontext === 'New Ticket'){
			
			$('#ticketID').val(null);
			
		} else if (buttontext === 'Edit Ticket') {

			var selectedRow = $("table").find("tr.selected");
			var ticketID = selectedRow.find("td:eq(0)").text();
			var product = selectedRow.find("td:eq(1)").text();
			var clientname = selectedRow.find("td:eq(2)").text();
			var contactno = selectedRow.find("td:eq(3)").text();
			var emailaddress = selectedRow.find("td:eq(4)").text();
			var agentID = selectedRow.find("td:eq(5)").text();
			var subject = selectedRow.find("td:eq(6)").text();
			var ticketdescription = selectedRow.find("td:eq(7)").text();
			var completed = selectedRow.find("td:eq(9)").text();

			$('#ticketID').val(ticketID);
			$('#product').val(product);
			$('#clientname').val(clientname);
		    $('#contactno').val(contactno);
		    $('#emailaddress').val(emailaddress);
		    $('#subject').val(subject);
		    $('#ticketdescription').val(ticketdescription);
			
			if (completed !== ""){
				$('#complete').prop('checked', true);
			}
			
		}
	
			$('.agentID').load('./AgentIDSelection.php', {
			currentaction: 'openform '+ buttontext,
			agent: agentID
		});	

	var hasSelectedClass = $("table").find("tr.selected").hasClass("selected");

	if (buttontext === 'New Ticket' || hasSelectedClass === true){
		$('#popupform').css('display', 'block');
	}
}


//Close the popup form
function closeForm() {
	var popupform = document.getElementById("popupform");
	document.getElementById("containerform").reset();
	popupform.style.display = "none";
}
