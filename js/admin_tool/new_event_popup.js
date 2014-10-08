$( document ).ready(function() {
	$(document).click(function(event){
		//event.stopPropagation();	
		 /* 
		 * Se clicco fuori dal popup per la creazione di un evento 
		 * elimino tutti i popup di questo tipo se aperti.
		 * 
		 * Ignoro i click sul bottone per l'apertura di un popup per via dell'esecuzione asincrona ed dai Zebra date piker
		 */
		if((event.target.className!='new_event_btn'))	
			{	
			if($(event.target).closest('.Zebra_DatePicker').length==0)	
				if($(event.target).closest('.new_event_popup').length==0)
					if($('.new_event_popup').length!=0)
						close_all_new_event_popup();
			}		
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
	if($('#new_event_form .datepicker').length != 0){
		$('#date1').data('Zebra_DatePicker').destroy();
		$('#date2').data('Zebra_DatePicker').destroy();
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
function insert_new_event(){
		var errors=setErrors();
		if(!errors){
			var name=$.trim($('#name').val());
			var description=$.trim($('#description').val());
			var type='semplice';
			if($('#daily').is(':checked'))
				type='giornaliero';
			//Estraggo la data di inizio
			var gg1,mm1,aaaa1;
			var date1=$('#date1').val();
			var aux=date1.split(' ');
			gg1=aux[0];	
			mm1=mesi_abbr.indexOf(aux[1])+1;
			aaaa1=aux[2];
			//Estraggo la data di fine
			var date2=$('#date2').val();
			var aux=date2.split(' ');
			gg2=aux[0];
			mm2=mesi_abbr.indexOf(aux[1])+1;
			aaaa2=aux[2];
			//Estraggo gli orari
			time1=$('#time1').val();
			time2=$('#time2').val();
			var hh1,min1,hh2,min2;
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
			//Estraggo l'id dela calendario selezionato
			var calendar_id=$('#calendar_select').val();
			//alert("nome:'"+name+"' \ndescrizione:'"+description+"'\ntipo:"+type+"\n"+gg1+"-"+mm1+"-"+aaaa1+" "+hh1+":"+min1+"\n"+gg2+"-"+mm2+"-"+aaaa2+" "+hh2+":"+min2+"\n");
			$.post('/calendar/php/insert_event_to_db.php',{'gg1':gg1,'mm1':mm1,'aaaa1':aaaa1,'hh1':hh1,'min1':min1,'gg2':gg2,'mm2':mm2,'aaaa2':aaaa2,'hh2':hh2,'min2':min2,'name':name,'descrizione':description,'calendar_id':calendar_id,'type':type},function(){
				$.when(close_all_new_event_popup()).then(function(){
					refresh_cc_for_admin(mm1,aaaa1);
				});
			});
		}
			
	}
/*
 * Aggiunge uno 0 alle ore espresse con una sola cifra
 */
function pad_zero_h(h){
	if(h.length==1)
		return '0'+h;
		else return h;
}

/*
 * Controlla tutti gli input del form e ritorna true/false indicando la presenza di errori
 * Inoltre mette i messaggi di errore
 */
function setErrors(){		
	var errors=false;
	var errors_time2=false;
	errors=set_error_date()|set_error_name()|set_errors_time(true);
	return errors;
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
function set_errors_time(on_submit){
	var error=false;
	var type='semplice';
	var daily_check=$('#daily');
	if(daily_check.is(':checked'))
		type='giornaliero';
	var time1=$('#time1');
	var time2=$('#time2');
	if(type=='semplice'){		
		if((time1.val().length!=0&&!check_time(time1.val()))||(time2.val().length!=0&&!check_time(time2.val()))){
			$('#error3').text('Inserire ora nel formato corretto (hh:mm)');
			error=true;
		}else $('#error3').text('');
		if(time1.val().length==0||time2.val().length==0){
			error=true;
			if(on_submit)
				$('#error3').text('Inserire ora nel formato corretto (hh:mm)');
		}
	}
	return  error;
}

function set_error_date(){var error=false;
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
	var date1_input=$('#date1');
	var date2_input=$('#date2');
	var t1,t2;
	t1=time1_input.val();
	t2=time2_input.val();
	if(time1_input.val().length==0||time2_input.val().length==0||type=='giornaliero'){
		t1='00:00';
		t2='00:00';
	}
	var date1_js=buildDate(date1_input.val(),t1);
	var date2_js=buildDate(date2_input.val(),t2);
	if(date1_js.getTime()>date2_js.getTime()){
		error=true;
		$('#error2').text('La data finale deve precedere quella iniziale');
		}else $('#error2').text('');
	return error;
}
/*
 * Costruisce e ritorna l'oggetto Date con data estratta da date e orario estratto da time
 */
function buildDate(date,time){
	
	var aux=date.split(' ');
	var gg=aux[0];	
	var mm=mesi_abbr.indexOf(aux[1])+1;
	var aaaa=aux[2];
	aux=time.split(':');
	hh=aux[0];
	min=aux[1];
	var d=new Date(aaaa, mm-1, gg, hh, min);
	return d;
}
