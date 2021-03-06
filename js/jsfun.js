/* Chiusura di tutti i popup se chiudo fuori da un popup
 * Se clicco su un element che non è all'interno di popup chiudo tutti i popup
 */
$( document ).ready(function() {
	$('html').click(function(event){
		if($(event.target).closest('.popup').length == 0)
			eliminaTuttiPopup();		
	});	
//	div.toggle('slow');
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
	vis=$('.controller_content').css('visibility');
	$('.calendar_container').load('php/getCalendar.php',{'month':month,'year':year},function(){
		$('.controller_content').css('visibility',vis);
		
	});
}
function getNextCalendar(month,year){
	if(month!=12&&year!=3000)
		month++;
	else{
		month=1;
		year++;
	}
	vis=$('.controller_content').css('visibility');
	$('.calendar_container').load('php/getCalendar.php',{'month':month,'year':year},function(){
			$('.controller_content').css('visibility',vis);
	});
	
}

function checkbox_changed(admin,id,month,year){
	var $check = $("input[name='checkbox_"+id+"']");
	vis=$('.controller_content').css('visibility');
    if ($check.prop('checked')){
    	$('.calendar_container').load('php/addCalsId.php',{'admin':admin,'id':id,'month':month,'year':year},function(){
    		$('.controller_content').css('visibility',vis);
    		if(admin==true)
    			changeEventsToEventsForAdmin();
    	});
    }else{
    	$('.calendar_container').load('php/removeCalsId.php',{'admin':admin,'id':id,'month':month,'year':year},function(){
    		$('.controller_content').css('visibility',vis);
    		if(admin==true)
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
function changeEventsToEventsForAdmin(month,year){
	var events=$('.event');
	events.each(function( index ) {
		$('#'+$(this).attr('id')+' a').attr("href", "javascript:popup_event_for_admin("+$( this ).attr('event_id')+","+month+","+year+")");;
	});
}
function getCalendarForAdmin(){
	$('.editor').load('php/getCalendarForAdmin.php',function(){
		changeEventsToEventsForAdmin(((new Date).getMonth()-1),(new Date).getFullYear());
	});	
	}
function getCalendarForAdmin(month,year){
	$('.editor').load('php/getCalendarForAdmin.php',{'month':month,'year':year},function(){
		changeEventsToEventsForAdmin(month,year);
	});
}
function getPrevCalendarForAdmin(month,year){
	if(month!=1&&year!=2000)
		month--;
	else{
		month=12;
		year--;
	}
	getCalendarForAdmin(month,year);
	/*
	vis=$('.controller_content').css('visibility');
	$('.calendar_container').load('php/refresh_calendar_container_for_admin.php',{'month':month,'year':year},function(){
		$('.controller_content').css('visibility',vis);
		changeEventsToEventsForAdmin(month,year);
	});	
	*/
}
function getNextCalendarForAdmin(month,year){
	if(month!=12&&year!=3000)
		month++;
	else{
		month=1;
		year++;
	}
	getCalendarForAdmin(month,year);
	/*
	vis=$('.controller_content').css('visibility');
	$('.calendar_container').load('php/refresh_calendar_container_for_admin.php',{'month':month,'year':year},function(){
		$('.controller_content').css('visibility',vis);
		changeEventsToEventsForAdmin(month,year);
	});
	*/	
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
		changeEventsToEventsForAdmin(month,year);
	});	
	}
function hs_calendars(){
	div=$('.controller_content');
	if(div.css('visibility')=='hidden'){
		div.hide();
		div.css('visibility','visible');
		div.slideToggle('slow');
	//	$('.controller_hs a img').attr('src','images/hide.png');
	}else{
		//$('.controller_hs a img').attr('src','images/show.png');
		$.when( div.slideToggle('slow')).then(function(){
			div.css('visibility','hidden');
		});		
	}
//	div.toggle('slow');
}	
