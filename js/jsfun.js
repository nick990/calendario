/* Chiusura di tutti i popup se chiudo fuori da un popup
 * Se clicco su un element che non è all'interno di popup chiudo tutti i popup
 */
$( document ).ready(function() {
	$('html').click(function(event){
		if($(event.target).closest('.popup').length == 0)
			eliminaTuttiPopup();
	 
		
	});
});

function getCalendar(){
	$('.calendar_container').load('php/getCalendar.php');
}
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

function checkbox_changed(admin,id,month,year){
	var $check = $("input[name='checkbox_"+id+"']");
    if ($check.prop('checked')){
    	$('.calendar_container').load('php/addCalsId.php',{'admin':admin,'id':id,'month':month,'year':year},function(){
    		changeEventsToEventsForAdmin();
    	});
    }else{
    	$('.calendar_container').load('php/removeCalsId.php',{'admin':admin,'id':id,'month':month,'year':year},function(){
    		changeEventsToEventsForAdmin();
    	});
    }

}

function logout(){
	$.post('php/logout.php',function(){
   		document.location='login_page.php';
   	});
}
/*
 * Cambio la funzione js da chiamare quando clicco sul link di un evento
 */
function changeEventsToEventsForAdmin(){
	var events=$('.event');
	events.each(function( index ) {
		$('#'+$(this).attr('id')+' a').attr("href", "javascript:popup_event_for_admin("+$( this ).attr('event_id')+")");;
	});
}
function getCalendarForAdmin(){
	$('.editor').load('php/getCalendarForAdmin.php',function(){
		changeEventsToEventsForAdmin();
	});	
	}
function getCalendarForAdmin(month,year){
	$('.editor').load('php/getCalendarForAdmin.php',{'month':month,'year':year},function(){
		changeEventsToEventsForAdmin();
	});
}
function getPrevCalendarForAdmin(month,year){
	if(month!=1&&year!=2000)
		month--;
	else{
		month=12;
		year--;
	}
	//
	$('.calendar_container').load('php/refresh_calendar_container_for_admin.php',{'month':month,'year':year},function(){
		changeEventsToEventsForAdmin();
	});	
}
function getNextCalendarForAdmin(month,year){
	if(month!=12&&year!=3000)
		month++;
	else{
		month=1;
		year++;
	}
	$('.calendar_container').load('php/refresh_calendar_container_for_admin.php',{'month':month,'year':year},function(){
		changeEventsToEventsForAdmin();
	});	
}
/*
 * Aggiugne un nuovo calendario nel DB con il nome passato,
 * poi ristampa l'editor
 */
function addCalendar(name,month,year){
	
	if(name.length==0)
		return;
	$.post('php/addCalendar.php',{'name':name},function(risposta){
			if(risposta==0){
				
				getCalendarForAdmin(month,year);
				//return false;
			}
			else if(risposta==1){
				$('#new_cal_error').append('Il calendario <b><font color="black">'+name+'</font></b> e\' gia\' presente!');
	
			}
		});	
}
function deleteCalendar(id,month,year){
	$.post('php/deleteCalendar.php',{'id':id},function(){
		getCalendarForAdmin(month,year);
	});
}
function removeElementById(id){
	$('#'+id).remove();
}
function removeElementByClass(aclass){
	$('.'+aclass).remove();
}
function refresh_cc_for_admin(month,year){
	$('.calendar_container').load('php/refresh_calendar_container_for_admin.php',{'month':month,'year':year},function(){
		changeEventsToEventsForAdmin();
	});	
	}		
