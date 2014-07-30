
function getCalendar(month,year){
	$('.calendar_container').load('php/getCalendar.php',{'month':month,'year':year});
}


