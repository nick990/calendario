$( document ).ready(function() {
	$(document).click(function(event){
		//event.stopPropagation();	
		 /* 
		 * Se clicco fuori dal popup per la creazione di un evento (.new_event_btn) 
		 * elimino tutti i popup di questo tipo se aperti.
		 * 
		 * Ignoro i click sul bottone per l'apertura di un popup per via dell'esecuzione asincrona ed dai Zebra date piker
		 */
		if((event.target.className!='new_event_btn')/*&&($(event.target).closest('.Zebra_DatePicker dp_visible').length==0)*/)	
			{	
			if($(event.target).closest('.Zebra_DatePicker').length==0)	
				if($(event.target).closest('.new_event_popup').length==0)
					if($('.new_event_popup').length!=0)
						close_all_new_event_popup();
			}		
	});
	
});

/*
 * Quando il mouse passa su un giorno(day/day_out), faccio comparire .new_event_btn
 */
$('.day').mouseover(function(){
	$('#'+this.id+" .new_event_btn").css('visibility','visible');
});
$('.day_out').mouseover(function(){
	$('#'+this.id+" .new_event_btn").css('visibility','visible');
});
/*
 * Quando il mouse esce dal giorno(day/day_out), faccio scomparire .new_event_btn
 */
$('.day').mouseout(function(){
	$('#'+this.id+" .new_event_btn").css('visibility','hidden');
});
$('.day_out').mouseout(function(){
	$('#'+this.id+" .new_event_btn").css('visibility','hidden');
});


/*
 * Crea il popup per l'aggiunta di un nuovo evento
 * 
 */
function get_new_event_popup(id,day,month,year){
	close_all_new_event_popup();
	$(".calendar_container").append("<div class='new_event_popup' id='new_event_popup_"+id+"'>"+"<div class='close_nep'></div><div class='nep_content'></div></div>");
	$(".close_nep").click(function(){close_all_new_event_popup();});
	$(".nep_content").load('php/get_new_event_popup.php',{'day':day,'month':month,'year':year},function(){
		var pop=$('#new_event_popup_'+id);
		set_position_new_event_popup(pop);
		pop.css('visibility','visible');
	});
	
}

function insert_new_event(name,descrizione,date_daily,date1,time1,date2,time2,calendar_id,daily_checked){
	
	
}
function add_nep_arrow(pop,id,posizione_y){
	
}
function check_giornaliero(){
	if($('#daily').is(':checked')){
		$('#time1').hide();
		$('#time2').hide();
	}else{
		$('#time1').show();
		$('#time2').show();
	}	
}
function close_all_new_event_popup(){
	$.when(destroy_all_datepickers()).then(function(){
		removeElementByClass('new_event_popup');
		removeElementByClass('nep_row');  		
	});
}
function destroy_all_datepickers(){
	if($('.datepicker').length != 0){
		$('#date1').data('Zebra_DatePicker').destroy();
		$('#date2').data('Zebra_DatePicker').destroy();
		$('#date_daily').data('Zebra_DatePicker').destroy();
	}
}

/*
 * Controlla che una stringa sia nel formato ora corretto
 */
function check_time(date){
	var time_pattern=/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/;
	if(!time_pattern.test(date))
		return false;
	return true;
}
/*
 * Set the popup in the middle of th calendar
 */
function set_position_new_event_popup(pop){	
		var pop_h=pop.outerHeight();
		var pop_w=pop.outerWidth();
		var cc=$(".calendar_container");
		var pop_left=cc.width()/2-pop_w/2;
		var pop_top=cc.height()/2-pop_h/2;
		pop.css('top',pop_top);
		pop.css('left',pop_left);
}
