$( document ).ready(function() {
	$(document).click(function(event){
		/* 
		 * Se clicco fuori dal popup per la modifica di un evento 
		 * elimino tutti i popup di questo tipo se aperti.
		 * 
		 */
		if($(event.target).closest('.Zebra_DatePicker').length==0)	
			if($(event.target).closest('.event_editor_popup').length==0)
				if($('.event_editor_popup').length!=0)
					close_all_event_editor_popup();
	});	
});
function popup_event_for_admin(id){
	$.when(popupEventById(id)).then(function(){
		pop=$('#popup_'+id);
		//Aggiungo il bottone per l'apertura dell'editor
		pop.append('<a href="javascript:get_event_editor('+id+')" class="edit_event" id="edit_event_'+id+'" ></a>');
		edit=$('#edit_event_'+id);
		edit.css('left',pop.outerWidth()-20-10-edit.outerWidth());		
	});	
	return;
}
function get_event_editor(id){
	eliminaTuttiPopup();
	$(".calendar_container").append("<div class='event_editor_popup' id='event_editor_popup_"+id+"'><div class='close_eep'></div><div class='eep_content'></div></div>");
	$(".close_eep").click(function(){close_all_event_editor_popup();});	
	$(".eep_content").load('php/get_event_editor_popup.php',{'id':id},function(){
		var pop=$('#event_editor_popup_'+id);
		set_position_eep(pop);
		pop.css('visibility','visible');
	});	
}
function close_all_event_editor_popup(){
	$.when(destroy_eep_datepicker()).then(function(){
		removeElementByClass('event_editor_popup');		
	});
}
function destroy_eep_datepicker(){
	if($('#event_editor_form .datepicker').length != 0){
		$('#date').data('Zebra_DatePicker').destroy();
	}
	
}
function set_position_eep(pop){
	var pop_h=pop.outerHeight();
	var pop_w=pop.outerWidth();
	var cc=$(".calendar_container");
	var pop_left=cc.width()/2-pop_w/2;
	var pop_top=cc.height()/2-pop_h/2;
	pop.css('top',pop_top);
	pop.css('left',pop_left);
}
function edit_event(id){
	var errors=set_errors_eep();
		if(!errors){
			var gg,mm,aaaa,hh1,min1,hh2,min2,name,descriptiom,type,calendar_id;
			//Tipo
			type='semplice';
			if($('#daily').is(':checked'))
				type='giornaliero';
			//Nome,Descrizione,Calendario
			name=$('#name').val();
			description=$('#description').val();
			calendar_id=$('#calendar_select').val();
			//Data
			var date=$('#date').val();
			var aux=date.split(' ');
			gg=aux[0];	
			mm=mesi_abbr.indexOf(aux[1])+1;
			aaaa=aux[2];
			//Orari
			time1=$('#time1').val();
			time2=$('#time2').val();
			if(type=='semplice'){
				aux=time1.split(':');
				hh1=aux[0];
				min1=aux[1];
				aux=time2.split(':');
				hh2=aux[0];
				min2=aux[1];
			}
			if(type=='giornaliero'){
				hh1='00';
				min1='00';
				hh2='23';
				min2='59';
			}
			hh1=pad_zero_h(hh1);
			hh2=pad_zero_h(hh2);
			$.post('/calendar/php/update_event.php',{'id':id,'gg':gg,'mm':mm,'aaaa':aaaa,'hh1':hh1,'min1':min1,'hh2':hh2,'min2':min2,'name':name,'description':description,'calendar_id':calendar_id,'type':type},function(){
				$.when(close_all_event_editor_popup()).then(function(){
					refresh_cc_for_admin(mm,aaaa);
				});
			});
			return;
		}else{
			return;
		}
}
function set_errors_eep(){
	return set_error_name()|set_errors_time(true)|set_error_date_in_eep();
}
/*
 *Nome campo obbligatorio
 */
function set_error_name(){
	var error=false;
	var name_input=$('#name');
	var error1=$('#error1');
	if($.trim(name_input.val()).length==0){
		error=true;
		error1.text('campo obbligatorio');
	}else
		error1.text('');
	return error;
}
function set_error_date_in_eep(){
	var error=false;
	var type='semplice';
	var daily_check=$('#daily');
	if(daily_check.is(':checked'))
		type='giornaliero';
	var time1_input=$('#time1');
	var time2_input=$('#time2');
	/*
	 * Controllo le date
	 * Costruisco le date js, le confronto per verificare che la data di fine sia successiva o uguale a quella di inizio
	 */		
	var date_input=$('#date');
	var t1,t2;
	t1=time1_input.val();
	t2=time2_input.val();
	if(time1_input.val().length==0||time2_input.val().length==0||type=='giornaliero'){
		t1='00:00';
		t2='00:00';
	}
	var date1_js=buildDate(date_input.val(),t1);
	var date2_js=buildDate(date_input.val(),t2);
	if(date1_js.getTime()>date2_js.getTime()){
		error=true;
		$('#error2').text('L\'orario finale deve precedere quello iniziale');
		}else $('#error2').text('');
	return error;
}
function check_daily_in_eep(){
	if($('#daily').is(':checked')){
			$('.time_picker').hide();
			$('#-').hide();
		}else{
			$('.time_picker').val('');
			$('.time_picker').show();
			$('#-').show();
		}
}
function reset_event_editor(name_old,date_old,time1_old,time2_old,check_old,description_old,id_calendar_old){
	$('#name').val(name_old);
	$('#date').val(date_old);
	if(check_old==true){
		$('#daily').prop('checked',true);
		$('.time_picker').hide();
		$('#-').hide();
	}
	else{
		$('#daily').removeAttr('checked');
		$('.time_picker').show();
		$('#-').show();
		$('#time1').val(time1_old);
		$('#time2').val(time2_old);
	}
	$('#description').val(description_old);
	$("#calendar_select").val(id_calendar_old);
}
