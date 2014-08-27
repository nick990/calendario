<?php
		require_once('/opt/lampp/htdocs/calendar/php/utils.php');
		require_once('/opt/lampp/htdocs/calendar/php/DBfunctions.php');
		 connettiDB("127.0.0.1","calendario_db","root","");
	/*
	 * Estraggo dal DB le informazioni relative all'evento con ID passato tramite POST e le stampo
	 */
	$id=$_POST['id'];
	$query="SELECT eventi.nome,eventi.descrizione,eventi.tipo,eventi.id_calendario,DATE_FORMAT(eventi.data_inizio,'%d') AS giorno_inizio,DATE_FORMAT(eventi.data_inizio,'%m') AS mese_inizio,DATE_FORMAT(eventi.data_inizio,'%Y') AS anno_inizio,TIME_FORMAT(TIME(eventi.data_inizio),'%H:%i') AS ora_inizio,DATE_FORMAT(eventi.data_fine,'%d') AS giorno_fine,DATE_FORMAT(eventi.data_fine,'%m') AS mese_fine,DATE_FORMAT(eventi.data_fine,'%Y') AS anno_fine,TIME_FORMAT(TIME(eventi.data_fine),'%H:%i') AS ora_fine FROM eventi WHERE id='$id'";
	$result = mysql_query($query);
	$array = mysql_fetch_array($result);
	$name=$array['nome'];
	$description=$array['descrizione'];
	
?>
<!DOCTYPE html>	
<script type="text/javascript" src="/calendar/datepicker/public/javascript/zebra_datepicker.js"></script>
<link rel="stylesheet" href="/calendar/datepicker/public/css/default.css" type="text/css">
<form id="event_editor_form" action="javascript:void(0);">
	<div>
		<input type="text" size="15" maxlength="15" name="name" id="name" placeholder="Nome evento" value="<?php echo $name;?>">
		<label class="new_event_error" id="error1"></label>
	</div>
	<label class="new_event_error" id="error2"></label>
	<div>
		<input type="text" name="date" id="date" class="datepicker" size="11"  value="<?php echo $array['giorno_inizio'].' '.$mesi[$array['mese_inizio']-1].' '.$array['anno_inizio'] ?>"> 
		<input type="text" name="time1" id="time1" class="time_picker" size="5" maxlength="5" placeholder="hh:mm" value="<?php echo $array['ora_inizio'];?>">
		<label id="-">-</label>	 
		<input type="text" name="time2" id="time2" class="time_picker" size="5" maxlength="5" placeholder="hh:mm" value="<?php echo $array['ora_fine'];?>">
	</div>
		<label class="new_event_error" id="error3"></label>
	<div>
		<input type="checkbox" name="daily" id="daily" onchange="javascript:check_daily_in_eep()" <?php if($array['tipo']=='giornaliero') echo 'checked';?>>
		Tutto il giorno
	</div>
	<div>
		Calendario: 
		<select id="calendar_select" >
			<?php
				$query2='SELECT * FROM calendario_db.calendari';
				$result2=mysql_query($query2);
				while($array2=mysql_fetch_array($result2)){
					echo '<option value="'.$array2['id'].'" ';
					if($array2['id']==$array['id_calendario'])
						echo 'selected';
					echo'>'.$array2['nome'].'</option>';
				}
				mysql_close();
			?>
		</select>
	</div>
	<div>
		<textarea name="description" id="description" max_length="50" rows="5" cols="40" placeholder="Descrizione (MAX 50)" ><?php echo $description;?></textarea>
	</div>
	<input id="submit" type="submit" value="Salva" />
	<button id="reset_btn" type="button">Ripristina</button>
</form>
<script type="text/javascript">
	$(document).ready(function(){
		/*
		 * Reset
		 */
		name_old=$('#name').val();
		date_old=$('#date').val();
		check_old=$('#daily').is(':checked');
		time1_old=$('#time1').val();
		time2_old=$('#time2').val();
		description_old=$('#description').val();
		id_calendar_old=$('#calendar_select').val();
		$('#reset_btn').click(function(){reset_event_editor(name_old,date_old,time1_old,time2_old,check_old,description_old,id_calendar_old)
			});
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
		 * Nascondo gli orari in caso di evento giornaliero
		 */
		if($('#daily').is(':checked')){
			$('.time_picker').hide();
			$('#-').hide();
		}
		/*
		 * Controllo degli errori pre-submit
		 */
		$('.time_picker').change(function(){
			set_errors_time(false);
			set_error_date_in_eep();
		});
		
	});
</script>
