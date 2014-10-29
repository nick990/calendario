<?php
	require_once '/opt/lampp/htdocs/calendar/php/utils.php';
	require('/opt/lampp/htdocs/calendar/php/DBfunctions.php');
	connettiDB('127.0.0.1','calendario_db','root','');
?>


<!DOCTYPE html>	
<link rel="stylesheet" type="text/css" href="styles/print_calendar.style.css"/>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="/calendar/datepicker/public/javascript/zebra_datepicker.js"></script>
<link rel="stylesheet" href="/calendar/datepicker/public/css/default.css" type="text/css">
<form id="print_calendar_form" action="print_calendar.php" method="POST">
	<div>
		<input type="text" size="35" maxlength="35" name="title" id="title" placeholder="Titolo">
		<label class="title_error" id="error1"></label>
	</div>
	<div>
		<?php
			$gg=date("d");
			$mm=date("m");
			$aaaa=date("Y");
			$date1_string=$gg.' '.$mesi[$mm-1].' '.$aaaa;
			next_date($gg,$mm,$aaaa);
			$date2_string=$gg.' '.$mesi[$mm-1].' '.$aaaa;
		?>
		<input type="text" name="date1" id="date1" class="datepicker" size="11"  value="<?php echo $date1_string;?>"> 
		-
		<input type="text" name="date2" id="date2" class="datepicker" size="11"  value="<?php echo $date2_string;?>"> 
	</div>
		<label class="date_error" id="error2"></label>
	<div>
		<input checked type="checkbox" name="description" value="description">Mostra descrizioni eventi
	</div>
	<div>
		Calendario: 
		<select id="calendar_select" name="calendar_select">
			<?php
				$query='SELECT * FROM calendario_db.calendari';
				$result=mysql_query($query);
				while($array=mysql_fetch_array($result)){
					echo '<option value="'.$array['id'].'">'.$array['nome'].'</option>';
				}
			?>
		</select>
	</div>
	
	<!--<input id="submit" type="submit" value="Genera" />!-->
</form>
<button onclick="js:get_print_calendar()">Genera</button>
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
		 * Controllo degli errori PRE Submit
		 */
		$('.datepicker').focus(function(){
			set_error_date();
		});
		
		/*
		 * Submit
		 */		
	/*	$('#print_calendar_form').submit(function(){
			get_print_calendar();
		});
		*/
	});
	
	function set_error_date(){
		var error=false;
		/*
		 * Controllo le date
		 * Costruisco le date js, le confronto per verificare che la data di fine sia successiva o uguale a quella di inizio
		 */		
		var date1_input=$('#date1');
		var date2_input=$('#date2');
		var t1,t2;
		var date1_js=buildDate(date1_input.val(),'00:00');
		var date2_js=buildDate(date2_input.val(),'00:00');
		if(date1_js.getTime()>date2_js.getTime()){
			error=true;
			$('#error2').text('La data finale deve precedere quella iniziale');
			}else $('#error2').text('');
		return error;
	}
	/*
	 * Titolo campo obbligatorio
	 */
	function set_error_title(){
		var error=false;
		var name_input=$('#title');
		var error1=$('#error1');
		if($.trim(name_input.val()).length==0){
			error=true;
			error1.text('Titolo obbligatorio');
		}else
			error1.text('');
		return error;
	}
	
	function set_errors(){
		var errors=false;
		errors=set_error_date()||set_error_title();
		return errors;
	}
	
	function get_print_calendar(){
		if(!set_errors())
			$('#print_calendar_form').submit();
	}
	
/*
 * Costruisce e ritorna l'oggetto Date con data estratta da date e orario estratto da time
 */
function buildDate(date,time){	
	var aux=date.split(' ');
	var gg=aux[0];	
	var mm=mesi_abbr.indexOf(aux[1])+1;
	var aaaa=aux[2];
	aux=time.split(':');
	hh=aux[0];
	min=aux[1];
	var d=new Date(aaaa, mm-1, gg, hh, min);
	return d;
}
</script>
	