<?php
	$day=$_POST['day'];
	if($day<10)
		$day='0'.$day;
	$month=$_POST['month'];
	$year=$_POST['year'];
	require_once '/opt/lampp/htdocs/calendar/php/utils.php';
	require('/opt/lampp/htdocs/calendar/php/DBfunctions.php');
	connettiDB('127.0.0.1','calendario_db','root','');
?>


<!DOCTYPE html>	
<script type="text/javascript" src="/calendar/datepicker/public/javascript/zebra_datepicker.js"></script>
<link rel="stylesheet" href="/calendar/datepicker/public/css/default.css" type="text/css">
<form id="new_event_form" action="javascript:void(0)" onsubmit="">
	<div>
		<input type="text" size="15" maxlength="15" name="name" id="name" placeholder="Nome evento">
		<label class="new_event_error" id="error1"></label>
	</div>
	<label class="new_event_error" id="error2"></label>
	<div>
		<input type="text" name="date1" id="date1" class="datepicker" size="11"  value="<?php echo $day.' '.$mesi[$month-1].' '.$year ?>"> 
		<input type="text" name="time1" id="time1" class="time_picker" size="5" maxlength="5" placeholder="hh:mm">
		-
		<input type="text" name="date2" id="date2" class="datepicker" size="11"  value="<?php echo $day.' '.$mesi[$month-1].' '.$year ?>"> 
		<input type="text" name="time2" id="time2" class="time_picker" size="5" maxlength="5" placeholder="hh:mm">
	</div>
		<label class="new_event_error" id="error3"></label>
	<div>
		<input type="checkbox" name="daily" id="daily" checked="checked" onchange="javascript:check_giornaliero()">
		Tutto il giorno
	</div>
	<div>
		Calendario: 
		<select id="calendar_select" >
			<?php
				$query='SELECT * FROM calendario_db.calendari';
				$result=mysql_query($query);
				while($array=mysql_fetch_array($result)){
					echo '<option value="'.$array['id'].'">'.$array['nome'].'</option>';
				}
			?>
		</select>
	</div>
	<div>
		<textarea name="description" id="description" max_length="50" rows="5" cols="40" placeholder="Descrizione (MAX 50)"></textarea>
	</div>
	<input id="submit" type="submit" value="Inserisci" />
</form>
<script type="text/javascript">
	$( document ).ready(function() {
		mesi=['Gennaio','Febbraio','Marzo','Aprile','Maggio','Giugno','Luglio','Agosto','Settembre','Ottobre','Novembre','Dicembre'];
		mesi_abbr=['Gen','Feb','Mar','Apr','Mag','Giu','Lug','Ago','Set','Ott','Nov','Dic'];
		/*
		 * Imposto i date picker
		 */
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
		/*
		 * Giornaliero, inizialmente è checked quindi i due input time sono nascosti
		 */		
		$('#time1').hide();
		$('#time2').hide();
		/*
		 * Imposto il numero massimo di carratteri per la descrizione
		 */
		var des=$('#description');
		var max = parseInt(des.attr('max_length'));
		des.bind('change keyup keydown',function(){
			var len=des.val().length;
			if(len>max)
				des.val(des.val().substr(0,max));
		});
		/*
		 * Controllo degli errori PRE Submit
		 */
		$('.datepicker').focus(function(){
			set_error_date();
		});
		$('#time1').change(function(){
			set_error_time(1,false);
			set_error_date();
		});
		$('#time2').change(function(){
			set_error_time(2,false);
			set_error_date();	
		});
		$('#daily').change(function(){			
			if($('#daily').is(':checked'))
				$('.time_picker').val('');
			set_error_date();
		});
		/*
		 * Submit
		 */		
		$('#new_event_form').submit(function(){
			insert_new_event();
		});
	});
	
	
</script>
	