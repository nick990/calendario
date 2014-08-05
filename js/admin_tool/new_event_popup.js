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

