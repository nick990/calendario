$( document ).ready(function() {
	$('html').click(function(event){
		
		if($(event.target).closest('.calendar_editor_popup').length == 0)
			removeElementByClass('calendar_editor_popup');	
		//if($(event.target).attr('class')!='popup')
		//	eliminaTuttiPopup();
	});
});

/*
 * Crea il popup per la modifica del calendario cliccato in admin_tool.php
 */
function calendarEditorPopupById(id){
	$('#calendar_editor_'+id).append('<div class="calendar_editor_popup" id="calendar_editor_popup_'+id+'">'+'<div class="close_editor" id="close_editor_'+id+'"></div>'+id+'</div>');
	$pop=$('#calendar_editor_popup_'+id);
	$source=$('#calendar_editor_'+id);
	$("#close_editor_"+id).click(function(){removeElementById("calendar_editor_popup_"+id);});
	
	
	
	
	
	
	
	$pop_left=$source.width();
	$pop.css('left',$pop_left);
	$pop.css('visibility','visible');
}
