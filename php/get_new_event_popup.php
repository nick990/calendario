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
			<input type="text" size="15" maxlength="15" name="name" id="name" placeholder="Nome evento">
			<label class="new_event_error" id="error1"></label>
			<div>
				<input type="checkbox" name="giornaliero" id="giornaliero" onchange="javascript:check_giornaliero()">
				Tutto il giorno
				 <input type="text" name="date_daily" id="date_daily" class="datepicker" size="11"  value="<?php echo $day.' '.$mesi[$month-1].' '.$year ?>"> 
			</div>
			
			<div id="date_time_pickers_1">
				<label for="date1">inizio</label>
				<input type="text" name="date1" id="date1" class="datepicker" size="11"  value="<?php echo $day.' '.$mesi[$month-1].' '.$year ?>"> 
				<input type="text" name="time_picker_1" id="time_picker_1" class="time_picker" size="5" maxlength="5" placeholder="hh:mm">
				<label class="new_event_error" id="error2"></label>
			</div>
			
			<div id="date_time_pickers_2">
				<label id="label_fine" for="date2">fine</label>
				<input type="text" name="date2" id="date2" class="datepicker" size="11" value="<?php echo $day.' '.$mesi[$month-1].' '.$year ?>">
				<input type="text" name="time_picker_2" id="time_picker_2" class="time_picker" size="5" maxlength="5" placeholder="hh:mm">
				<label class="new_event_error" id="error3"></label>
			</div>
			<label class="new_event_error" id="error4"></label>
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
			<textarea name="description" id="description" rows="5" cols="40" placeholder="Descrizione"></textarea>
			</br>
			<input id="submit" type="submit" value="Inserisci" />
			
		</form>
		<script type="text/javascript">
			$( document ).ready(function() {
				/*
				 * Nome evento
				 */
				$('#name').change(function(){
					if($('#name').val().length==0){
						$('#error1').text('campo obbligatorio');
						
					}						
				});
				$('#name').keyup(function(){
					if($('#name').val().length!=0)
						$('#error1').text('');
				});
				/*
				 * Orari
				 */
				$('#time_picker_1').change(function(){
					if(!check_date($('#time_picker_1').val()))
						$('#error2').text('L\'ora non è nel formato (h)h:mm');
					else
						$('#error2').text('');
				});
				$('#time_picker_2').change(function(){
					if(!check_date($('#time_picker_2').val()))
						$('#error3').text('L\'ora non è nel formato (h)h:mm');
					else
						$('#error3').text('');
				});
				
			});
		</script>
	