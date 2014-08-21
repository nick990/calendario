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
		
		 $('input.datepicker').Zebra_DatePicker({
			//   direction: true,
			format: 'd M Y',
			days_abbr: ['Dom','Lun','Mar','Mer','Gio','Ven','Sab'],
			months:['Gennaio','Febbraio','Marzo','Aprile','Maggio','Giugno','Luglio','Agosto','Settembre','Ottobre','Novembre','Dicembre'],
			first_day_of_week: 1,
			show_icon: false,
			show_clear_date: false,
			show_select_today: false,
			zero_pad: true,
			default_position: 'below'	
		 });
		
		
		
		$('#new_event_form').submit(function(){
			insert_new_event($('#name').val(),$('#description').val(),$('#date_daily').val(),$('#date1').val(),$('#time_picker_1').val(),$('#date2').val(),$('#time_picker_2').val(),$('#calendar_select').val(),$('#giornaliero').is(':checked'));
		});
		
		//Inizialmente il check 'tutto il giorno' non è selezionato
		$('#date_daily').hide();
		
		/*
		 * Una volta riempito il contenuto lo posiziono e lo rendo visibile (di default il popup è invisibile)
		*/
		var pop=$('#new_event_popup_'+id);
	
		var pop_h=pop.outerHeight();
		var pop_w=pop.outerWidth();	
		pop.css('height',pop_h);
		var pop_h=pop.outerHeight();
		var pop_w=pop.outerWidth();		
		var giorno=$("#day_"+id);
		var row=25;//altezza freccia
		var pop_left=giorno.position().left+giorno.width()/2-pop_w/2;
		var pop_top=giorno.position().top-pop_h-row;
		/*
		 * Controllo la posizione
		 * 5<=left<=max_left
		 * 0<=top<=max_top
		 */
		var max_left=giorno.closest(".calendar_container").width()-pop_w-10; 
		posizione_y='sopra';
		//Se è troppo a Dx lo faccio rientrare verso sx
		if (pop_left>max_left){
			pop_left=max_left;
			
		}
		//Se è troppo a Sx lo faccio rientrare a Dx
		if (pop_left<0){
			pop_left=7;
			
		}
		//Se è troppo in alto lo sposto sotto il giorno
		if(pop_top<62+35){
			pop_top=giorno.height()+giorno.position().top+row;
			//pop_top=62+35;
			posizione_y='sotto';
		}
		pop.css('top',pop_top);
		pop.css('left',pop_left);
		
		pop.css("visibility","visible");
		add_nep_arrow(pop,id,posizione_y);		
	});
}

function insert_new_event(name,descrizione,date_daily,date1,time1,date2,time2,calendar_id,daily_checked){
	var mesi=['Gennaio','Febbraio','Marzo','Aprile','Maggio','Giugno','Luglio','Agosto','Settembre','Ottobre','Novembre','Dicembre'];
	var mesi_abbr=['Gen','Feb','Mar','Apr','Mag','Giu','Lug','Ago','Set','Ott','Nov','Dic'];
	var gg1,gg2,mm1,mm2,aaaa1,aaaa2,hh1,hh2,min1,min2;
	//controllo il tipo (per ora solo semplice e giornaliero)
	var type='semplice';
	if(daily_checked)
		type='giornaliero';
	//Se non è giornaliero estraggo le date e gli orari di inizio e fine
	if(type=='semplice'){
		//Estraggo la data di inizio
		var aux=date1.split(' ');
		gg1=aux[0];	
		mm1=mesi_abbr.indexOf(aux[1])+1;
		aaaa1=aux[2];
		//Estraggo la data di fine
		var aux=date2.split(' ');
		gg2=aux[0];
		mm2=mesi_abbr.indexOf(aux[1])+1;
		aaaa2=aux[2];
		//Estrago l'orario di  inizio
		aux=time1.split(':');
		hh1=aux[0];
		min1=aux[1];
		//Estraggo l'orario di fine'
		aux=time2.split(':');
		hh2=aux[0];
		min2=aux[1];
	}
	//Se è giornaliero metto in gg1 mm1 aaaa1 la data 
	if(type=='giornaliero'){
		var aux=date_daily.split(' ');
		gg1=aux[0];	
		mm1=mesi_abbr.indexOf(aux[1])+1;
		aaaa1=aux[2];
	}
	
	
	//Controllo degli errori
	var error=0;
	var d1=new Date(aaaa1, mm1-1, gg1, hh1, min1);
	var d2=new Date(aaaa2, mm2-1, gg2, hh2, min2);
	if(d1.getTime()>d2.getTime()){
		error=1;
		$('#error4').text('La data di fine deve essere successiva a quella di inizio');
	}
	if(name.length==0){
		error=1;
		$('#error1').text('campo obbligatorio');
	}
	if(type=='semplice'){
		if(!check_date(time1)){
			error=1;
			$('#error2').text('L\'ora non è nel formato (h)h:mm');
		}
		if(!check_date(time2)){
			error=1;
			$('#error3').text('L\'ora non è nel formato (h)h:mm');
		}
	}
	if(error==0){
		//Per fare il refresh passo il mese e l'anno dell'inizio dell'evento, poi dovrò impostare l'input text come non editabile
		$.post('/calendar/php/insert_event_to_db.php',{'gg1':gg1,'mm1':mm1,'aaaa1':aaaa1,'hh1':hh1,'min1':min1,'gg2':gg2,'mm2':mm2,'aaaa2':aaaa2,'hh2':hh2,'min2':min2,'name':name,'descrizione':descrizione,'calendar_id':calendar_id,'type':type},function(){
			$.when(close_all_new_event_popup()).then(function(){
				$('.calendar_container').load('php/refresh_calendar_container_for_admin.php',{'month':mm1,'year':aaaa1});		
			});
			
		});
	
	}	
}
function add_nep_arrow(pop,id,posizione_y){
	pop.closest(".calendar_container").append('<div class="nep_row"></div>');
	row=$('.nep_row');
	row.css('left',pop.position().left);
	if(posizione_y=='sotto')	
		row.css('top',pop.position().top-row.height()+1);
	if(posizione_y=='sopra')
		row.css('top',pop.position().top+pop.height()+1);
	row.append('<img src="images/images_row/'+posizione_y+'.png">');
	
	/*
	 * posizione orrizzontale: nel mezzo della dimensione del giorno
	 */
	
	var giorno=$("#day_"+id);	
	row.css('left',giorno.position().left+giorno.width()/2-row.width()/2);
	row.css("visibility","visible");
	
	return;
}
function check_giornaliero(){
	if($('#giornaliero').is(':checked')){
		$('#date_time_pickers_1').hide();
		$('#date_time_pickers_2').hide();	
		$('#date_daily').show();	
	}else{
		$('#date_time_pickers_1').show();
		$('#date_time_pickers_2').show();
		$('#date_daily').hide();
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
function check_date(date){
	var time_pattern=/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/;
	if(!time_pattern.test(date))
		return false;
	return true;
}
