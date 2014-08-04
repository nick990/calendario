$( document ).ready(function() {
	$('html').click(function(event){		
		if($(event.target).closest('.calendar_editor_popup').length == 0)
			removeElementByClass('calendar_editor_popup');	
		
	});
	
});

/*
 * Crea il popup per la modifica del calendario cliccato in admin_tool.php
 */
function calendarEditorPopup(id,mese,anno){
	$('#calendar_editor_'+id).append('<div class="calendar_editor_popup" id="calendar_editor_popup_'+id+'">'+'<div class="close_editor" id="close_editor_'+id+'"></div><div class ="cep_content" id="cep_content_'+id+'"></div></div>');
	$pop=$('#calendar_editor_popup_'+id);
	$source=$('#calendar_editor_'+id);
	$("#close_editor_"+id).click(function(){removeElementById("calendar_editor_popup_"+id);});
	
	$('#cep_content_'+id).load('php/get_popup_calendar_editor.php',{'id':id,'mese':mese,'anno':anno},function(){
		
		$pop_left=$source.width();
		$pop.css('left',$pop_left);
		$pop.css('visibility','visible');
		//document.getElementById("join_list").selectedIndex = -1;
		/*
		 * Pulisco l'errore quando ritento il rename
		 */
		$('#rename_cal').focus(function(){
			$('#cal_edit_form_error').text('');
		});
	});
}
function editCalendar(mese,anno,id,rename,join_check,id_join){
	/*
	 * Rendo effettive le modifiche e ristampo il calendario per l'admin
	 */
	//$('#calendar_editor_popup_'+id).append(mese+"/"+anno+" id:"+id+" rename:'"+rename+"' join_check: "+join_check+" id_join: "+id_join);
	
	$.post('php/edit_calendar.php',{'id':id,'rename':rename,'join_check':join_check,'id_join':id_join},function(risposta){
		if(risposta==0)
			getCalendarForAdmin(mese,anno);
		if(risposta==1)
			$('#cal_edit_form_error').text('Il nome '+rename+ ' e\' gia\' utilizzato!');
	});
	
}
