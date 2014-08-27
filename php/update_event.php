<?php
	/*
	 * Se le due date appartengono allo stesso giorno inserisco un evento,
	 * Altrimenti inserisco un evento per ogni giorno
	 */
	require('/opt/lampp/htdocs/calendar/php/DBfunctions.php');
	require('/opt/lampp/htdocs/calendar/php/utils.php');
	connettiDB('127.0.0.1','calendario_db','root','');
	$id=$_POST['id'];
	$gg=$_POST['gg'];
	$mm=$_POST['mm'];
	$aaaa=$_POST['aaaa'];
	
	$name=$_POST['name'];
	$description=$_POST['description'];
	$type=$_POST['type'];
	$calendar_id=$_POST['calendar_id'];
	
	$date1='';
	$date2='';
	
	if($type=='semplice'){
		$hh1=$_POST['hh1'];
		$min1=$_POST['min1'];
		$hh2=$_POST['hh2'];
		$min2=$_POST['min2'];
		$date1=$aaaa.'-'.$mm.'-'.$gg.' '.$hh1.':'.$min1.':00.000000';
		$date2=$aaaa.'-'.$mm.'-'.$gg.' '.$hh2.':'.$min2.':00.000000';	
	}else if($type=='giornaliero'){
		$date1=$aaaa.'-'.$mm.'-'.$gg.' 00:00:00.000000';
		$date2=$aaaa.'-'.$mm.'-'.$gg.' 23:59:00.000000';
	}

	$query='UPDATE eventi SET nome="'.$name.'",descrizione="'.$description.'",data_inizio="'.$date1.'",data_fine="'.$date2.'",id_calendario="'.$calendar_id.'",tipo="'.$type.'" WHERE id="'.$id.'";';
	mysql_query($query);
	
?>