<?php
	require('/opt/lampp/htdocs/calendar/php/DBfunctions.php');
	connettiDB('127.0.0.1','calendario_db','root','');
	$gg1=$_POST['gg1'];
	$mm1=$_POST['mm1'];
	$aaaa1=$_POST['aaaa1'];
	$gg2=$_POST['gg2'];
	$mm2=$_POST['mm2'];
	$aaaa2=$_POST['aaaa2'];
	
	$name=$_POST['name'];
	$descrizione=$_POST['descrizione'];
	$type=$_POST['type'];
	$calendar_id=$_POST['calendar_id'];
	
	
	$date1='';
	$date2='';
	
	if($type=='semplice'){
		$hh1=$_POST['hh1'];
		$min1=$_POST['min1'];
		$hh2=$_POST['hh2'];
		$min2=$_POST['min2'];
		$date1=$aaaa1.'-'.$mm1.'-'.$gg1.' '.$hh1.':'.$min1.':00.000000';
		$date2=$aaaa2.'-'.$mm2.'-'.$gg2.' '.$hh2.':'.$min2.':00.000000';	
	}else if($type=='giornaliero'){
		$date1=$aaaa1.'-'.$mm1.'-'.$gg1.' 00:00:00.000000';
		$date2=$aaaa1.'-'.$mm1.'-'.$gg1.' 23:59:00.000000';
	}
	$query='INSERT INTO calendario_db.eventi (nome,descrizione,data_inizio,data_fine,id_calendario,tipo) VALUES ("'.$name.'","'.$descrizione.'","'.$date1.'","'.$date2.'","'.$calendar_id.'","'.$type.'");';
	echo $query;
	mysql_query($query);
?>