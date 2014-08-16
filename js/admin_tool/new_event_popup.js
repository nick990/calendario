$( document ).ready(function() {
	$('html').click(function(event){
		//if($(event.target).closest('.new_event_popup').length==0&&$(event.target).attr('class')!='new_event_btn')
		//	removeElementByClass('new_event_popup');
		//	removeElementByClass('nep_row');
	 
		
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
	removeElementByClass('new_event_popup');
	removeElementByClass('nep_row');
	
	$(".calendar_container").append("<div class='new_event_popup' id='new_event_popup_"+id+"'>"+"<div class='close_nep'></div><div class='nep_content'></div></div>");
	$(".close_nep").click(function(){removeElementByClass('new_event_popup');removeElementByClass('nep_row');});
	$(".nep_content").load('php/get_new_event_popup.php',{'day':day,'month':month,'year':year},function(){

		$(document).ready(function() {			  
		   //Date picker
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
				insert_new_event($('#name').val(),$('#description').val(),$('#date1').val(),$('#time_picker_1').val(),$('#date2').val(),$('#time_picker_2').val(),$('#calendar_select').val(),$('#giornaliero').is(':checked'));
			});
		});	
		
		
		
		/*
		 * Una volta riempito il contenuto lo posiziono e lo rendo visibile (di default il popup è invisibile)
		*/
		var pop=$('#new_event_popup_'+id);
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

function insert_new_event(name,descrizione,date1,time1,date2,time2,calendar_id,daily_checked){
	var mesi=['Gennaio','Febbraio','Marzo','Aprile','Maggio','Giugno','Luglio','Agosto','Settembre','Ottobre','Novembre','Dicembre'];
	var mesi_abbr=['Gen','Feb','Mar','Apr','Mag','Giu','Lug','Ago','Set','Ott','Nov','Dic'];
	
	var gg1,gg2,mm1,mm2,aaaa1,aaaa2,hh1,hh2,min1,min2;
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
	//Se non è giornaliero estraggo gli orari di inizio e fine
	if(daily_checked==false){
		aux=time1.split(':');
		hh1=aux[0];
		min1=aux[1];
		aux=time2.split(':');
		hh2=aux[0];
		min2=aux[1];
	}
	//controllo il tipo (per ora solo semplice e giornaliero)
	var type='semplice';
	if(daily_checked)
		type='giornaliero';
	//Controllo degli errori
	var error=0;
	var d1=new Date(aaaa1, mm1-1, gg1, hh1, min1);
	var d2=new Date(aaaa2, mm2-1, gg2, hh2, min2);
	error_msg='';
	if(d1.getTime()>d2.getTime()){
		error=1;
		error_msg+='La data di fine deve essere successiva a quella di inizio!\n';
	}
	if(name.length==0){
		error=1;
		error_msg+='Nome : campo obbligatorio!\n';
	}
	if(hh1.length<2||min1.length<2){
		error=1;
		error_msg+='L\'ora di inizio non è nel formato hh:mm\n';
	}
	if(hh2.length<2||min2.length<2){
		error=1;
		error_msg+='L\'ora di fine non è nel formato hh:mm\n';
	}
	if(error!=0)
		alert(error_msg);
	else{
		//Per fare il refresh passo il mese e l'anno dell'inizio dell'evento, poi dovrò impostare l'input text come non editabile
		
		$.post('/calendar/php/insert_event_to_db.php',{'gg1':gg1,'mm1':mm1,'aaaa1':aaaa1,'hh1':hh1,'min1':min1,'gg2':gg2,'mm2':mm2,'aaaa2':aaaa2,'hh2':hh2,'min2':min2,'name':name,'descrizione':descrizione,'calendar_id':calendar_id,'type':type},function(){
			 $('.calendar_container').load('php/refresh_calendar_container_for_admin.php',{'month':mm1,'year':aaaa1});
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
		$('#date_time_pickers').hide();
	}else{
		$('#date_time_pickers').show();
	}
	
}
