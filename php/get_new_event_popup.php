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
	</br>
	<div><input type="checkbox" name="giornaliero" id="giornaliero" onchange="javascript:check_giornaliero()">Tutto il giorno</div>
	<div id="date_time_pickers">
		<div>
			<label for="date1">inizio</label>
			<input type="text" name="date1" id="date1" class="datepicker" size="11"  value="<?php echo $day.' '.$mesi[$month-1].' '.$year ?>"> 
			<input type="text" name="time_picker_2" id="time_picker_1" class="time_picker" size="5" maxlength="5" placeholder="hh:mm">
		</div>
		<div>
			<label for="date2">fine</label>
			<input type="text" name="date2" id="date2" class="datepicker" size="11" value="<?php echo $day.' '.$mesi[$month-1].' '.$year ?>">
			<input type="text" name="time_picker_2" id="time_picker_2" class="time_picker" size="5" maxlength="5" placeholder="hh:mm">
		</div>
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
	<textarea name="description" id="description" rows="5" cols="25" placeholder="Descrizione"></textarea>
	</br>
	<input id="submit" type="submit" value="Inserisci" />
</form>
<script type="text/javascript">
	
</script>
