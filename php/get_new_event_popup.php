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
	<div>
		<input type="text" name="date1" id="date1" class="datepicker" size="11"  value="<?php echo $day.' '.$mesi[$month-1].' '.$year ?>"> 
		<input type="text" name="time1" id="time1" class="time_picker" size="5" maxlength="5" placeholder="hh:mm">
		-
		<input type="text" name="date2" id="date2" class="datepicker" size="11"  value="<?php echo $day.' '.$mesi[$month-1].' '.$year ?>"> 
		<input type="text" name="time2" id="time2" class="time_picker" size="5" maxlength="5" placeholder="hh:mm">
	</div>
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
</form>
<script type="text/javascript">
	$( document ).ready(function() {
		/*
		 * Giornaliero
		 */		
		$('#time1').hide();
		$('#time2').hide();
		/*
		 * Gestione degli errori
		 */
		errors=false;
		error1=$('#error1');
		var name_input=$('#name');
		var hh1_input=$('#time1');
		var hh2_input=$('#time2');
		//Nome campo obbligatorio
		name_input.bind('change keyup',function(){
			if($.trim(name_input.val()).length==0){
				errors=true;
				error1.text('Nome obbligatorio');
			}else{
				errors=false;
				error1.text('');
			}
		});
		/*
		 * Formato Orario
		 * Diventa rosso onChange errato, ritorna bianco non appena viene corretto
		 */
		hh1_input.change(function(){
			if(check_time(hh1_input.val())==false){
				errors=true;
				hh1_input.css('background-color','#FFF0F0');
			}else{
				errors=false;
				hh1_input.css('background-color','WHITE');
			}
		});
		hh1_input.keyup(function(){
			if(check_time(hh1_input.val())==true){
				errors=false;
				hh1_input.css('background-color','WHITE');
			}
		});
		hh2_input.change(function(){
			if(check_time(hh2_input.val())==false){
				errors=true;
				hh2_input.css('background-color','#FFF0F0');
			}else{
				errors=false;
				hh2_input.css('background-color','WHITE');
			}
		});
		hh2_input.keyup(function(){
			if(check_time(hh2_input.val())==true){
				errors=false;
				hh2_input.css('background-color','WHITE');
			}
		});
		/*
		 * 
		 */
	});
</script>
	