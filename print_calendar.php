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
	$date1=$_POST['date1'];
	$date2=$_POST['date2'];
	$title=$_POST['title'];
	$calendar_id=$_POST['calendar_select'];
	$description = isset($_POST['description']) ? true : false;
	
	echo '<div id="title_calendar">'.$title.'</div>';
	
	$date1_pieces = explode(" ",$date1);
	$date2_pieces = explode(" ",$date2);
	
	$gg1=$date1_pieces[0];
	$mm1=array_search($date1_pieces[1], $mesi)+1;
	$aaaa1=$date1_pieces[2];
	
	$gg2=$date2_pieces[0];
	$mm2=array_search($date2_pieces[1], $mesi)+1;
	$aaaa2=$date2_pieces[2];
	
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
	
		
		
		
	});
</script>
</html>