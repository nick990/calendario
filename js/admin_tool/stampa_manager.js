/*
 * tolgo l'errore se vado sull'input text
 * 
 */
$(document).ready(function() {
	// Handler for .ready() called.
	$('#new_cal_name').focus(function(){
		$('#new_cal_error').text('');
	});
	$('#new_cal_name').keydown(function(){
		$('#new_cal_error').text('');
	});
	$('#new_cal_name').click(function(){
		$('#new_cal_error').text('');
	});
	
	
});