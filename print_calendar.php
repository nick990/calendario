<!DOCTYPE html>
<html>
<head>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="styles/print_calendar.style.css"/>
<title>Calendario</title>

</head>

<body>
<?php
	require_once('php/utils.php');
	require_once('php/DBfunctions.php');
	connettiDB("localhost","calendario_db","root",""); 
	/*$gg1=$_POST['gg1'];
	$mm1=$_POST['mm1'];
	$aaaa1=$_POST['aaaa1'];
	
	$gg2=$_POST['gg2'];
	$mm2=$_POST['mm2'];
	$aaaa2=$_POST['aaaa2'];
	*/
	$gg1="01";
	$mm1="07";
	$aaaa1="2014";
	
	$gg2="03";
	$mm2="07";
	$aaaa2="2014";	
	
	$calendar_id=5;
	
	$description=true;
	
	$days=get_days_in_range($gg1,$mm1,$aaaa1,$gg2,$mm2,$aaaa2);
	
	echo '<table class="table_for_print">';
		foreach ($days as $day) {
			echo '<tr>';	
				$day->stampa_for_print_calendar($calendar_id,$description);
			echo '</tr>';
		}
	echo '</table>';
	
	
?>
</body>
<script type="text/javascript">
	$( document ).ready(function() {
	/*	$('.table_for_print tr .event').each(function(i) {
			if(i%2==0){
				$(this).css('background-color','#eeeeee');
			}
		});*/
		
		
		
	});
</script>
</html>