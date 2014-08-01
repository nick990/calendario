
/*
 * Crea il popup relativo all'evento con id passato
 * Prima di crearlo e aggiungerlo al DOM chiude ed elimina eventuali popup aperti, così facendo ho
 * sempre la certezza di avere un solo popup aperto.
 */
function popupEventById(id){
	eliminaTuttiPopup();	
	$(".calendar_container").append("<div class='popup' id='popup_"+id+"'>"+"<div class='chiudi' id='chiudi_"+id+"'></div><div class='popup_content'></div></div>");
	var pop=$("#popup_"+id);
	
	$("#chiudi_"+id).click(function(){eliminaPopupById(id);});
	
	$("#popup_"+id).find(".popup_content").load("/calendar/php/get_popup_event.php",{'id':id},function(){
		/*
		 * Una volta riempito il contenuto lo posiziono e lo rendo visibile (di default il popup è invisibile)
		 */
		
		
		var pop_h=pop.outerHeight();
		var pop_w=pop.outerWidth();		
		var giorno=$("#evento"+id).closest(".day");
		if(giorno.length<=0)
			giorno=$("#evento"+id).closest(".day_out");
			
		var row=25;//altezza freccia
		
		var pop_left=giorno.position().left+giorno.width()/2-pop_w/2;
		var pop_top=giorno.position().top-pop_h-row;
		
		/*
		 * Controllo la posizione
		 * 5<=left<=max_left
		 * 0<=top<=max_top
		 */
	
		var max_left=giorno.closest(".calendar_container").width()-pop_w-2; 
		//posizione del popup rispetto all'evento(giorno)
		posizione_y='sopra';
		
		//Se è troppo a Dx lo faccio rientrare verso sx
		if (pop_left>max_left){
			pop_left=max_left;
			
		}
		//Se è troppo a Sx lo faccio rientrare a Dx
		if (pop_left<0){
			pop_left=2;
			
		}
		//Se è troppo in alto lo sposto sotto il giorno
		if(pop_top<0){
			pop_top=giorno.height()+giorno.position().top+row;
			posizione_y='sotto';
		}
		pop.css('top',pop_top);
		pop.css('left',pop_left);
		
		pop.css("visibility","visible");
		aggiungiFreccia(pop,id,posizione_y);
	});
}
	
/*
 * Chiude (eliminando) tutti i popup tranne quelli con id passato
 */
function eliminaPopupTranne(id){
	$(".popup").not("#popup_"+id).remove();
	$(".row").not("#row_"+id).remove();
	return;
}

/*
 * Chiude (eliminando) tutti i popup 
 */
function eliminaTuttiPopup(){
	$(".popup").remove();
	$(".row").remove();
	return;
}

/*
 * Chiudde (eliminando) il popup con l'id passato
 */
function eliminaPopupById(id){
	$("#popup_"+id).remove();
	$("#row_"+id).remove();
	return;
}
/*
 * Aggiunge l'immagine freccia al popup sulla base della posizione
 */
function aggiungiFreccia(pop,id,posizione_y){
	pop.closest(".calendar_container").append('<div class="row" id="row_'+id+'"></div>');
	row=$('.row');
	//row.css('width',pop.outerWidth());
	row.css('left',pop.position().left);
	if(posizione_y=='sotto')	
		row.css('top',pop.position().top-row.height()+1);
	if(posizione_y=='sopra')
		row.css('top',pop.position().top+pop.height()+1);
	row.append('<img src="images/images_row/'+posizione_y+'.png">');
	
	/*
	 * posizione orrizzontale: nel mezzo della dimensione del giorno
	 */
	var giorno=$("#evento"+id).closest(".day");
	if(giorno.length<=0)
		giorno=$("#evento"+id).closest(".day_out");
	row.css('left',giorno.position().left+giorno.width()/2-row.width()/2);
	row.css("visibility","visible");
	return;
}



