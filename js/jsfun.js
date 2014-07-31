
function getCalendar(month,year){
	$('.calendar_container').load('php/getCalendar.php',{'month':month,'year':year},function(){
		
	});
}
function getPrevCalendar(month,year){
	if(month!=1&&year!=2000)
		month--;
	else{
		month=12;
		year--;
	}
	$('.calendar_container').load('php/getCalendar.php',{'month':month,'year':year},function(){
		
	});
}
function getNextCalendar(month,year){
	if(month!=12&&year!=3000)
		month++;
	else{
		month=1;
		year++;
	}
	$('.calendar_container').load('php/getCalendar.php',{'month':month,'year':year},function(){
		
	});
	
}


