$(document).ready(function(){
	$('#unassigned-container p').load('TotalUnassigned.php');
	$('#pending-container p').load('TotalPending.php');
	$('#pending-List-Table').load('PendingListTable.php');
});

//these table are refersh for every 10 second
setInterval(function(){

    $('#unassigned-container p').load('TotalUnassigned.php');
	$('#pending-container p').load('TotalPending.php');
	$('#pending-List-Table').load('PendingListTable.php');
    
}, 10000);