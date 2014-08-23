<?php
	/*
	 * Se le due date appartengono allo stesso giorno inserisco un evento,
	 * Altrimenti inserisco un evento per ogni giorno
	 */
	require('/opt/lampp/htdocs/calendar/php/DBfunctions.php');
	require('/opt/lampp/htdocs/calendar/php/utils.php');
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
		$date2=$aaaa2.'-'.$mm2.'-'.$gg2.' 23:59:00.000000';
	}
	/*
	 * Controllo se si tratta di due date nello stesso giorno
	 * SI: Inserisco un solo evento
	 * NO: Inserisco un evento per ogni giorno
	 */
	if($aaaa1==$aaaa2&&$mm1==$mm2&&$gg1==$gg2){
		$query='INSERT INTO calendario_db.eventi (nome,descrizione,data_inizio,data_fine,id_calendario,tipo) VALUES ("'.$name.'","'.$descrizione.'","'.$date1.'","'.$date2.'","'.$calendar_id.'","'.$type.'");';
		mysql_query($query);
	}else{
		//Inserisco l'evento del primo giorno
		$date1_b=$date1;
		$date2_b=$aaaa1.'-'.$mm1.'-'.$gg1.' 23:59:00.000000';
		//if($type=='semplice')
		//	$type_b='inizio';
		$query='INSERT INTO calendario_db.eventi (nome,descrizione,data_inizio,data_fine,id_calendario,tipo) VALUES ("'.$name.'","'.$descrizione.'","'.$date1_b.'","'.$date2_b.'","'.$calendar_id.'","'.$type.'");';
		mysql_query($query);
		//Inserisco l'evento dell'ultimo giorno
		$date1_b=$aaaa2.'-'.$mm2.'-'.$gg2.' 00:00:00.000000';
		$date2_b=$date2;
		//if($type=='semplice')
		//	$type_b='fine';
		$query='INSERT INTO calendario_db.eventi (nome,descrizione,data_inizio,data_fine,id_calendario,tipo) VALUES ("'.$name.'","'.$descrizione.'","'.$date1_b.'","'.$date2_b.'","'.$calendar_id.'","'.$type.'");';
		mysql_query($query);
		//Inserisco gli eventi degli eventuali giorni nel mezzo
		$gg=$gg1;
		$mm=$mm1;
		$aaaa=$aaaa1;
		next_date($gg,$mm,$aaaa);
		while($gg!=$gg2||$mm!=$mm2||$aaaa!=$aaaa2){
			$date1_b=$aaaa.'-'.$mm.'-'.$gg.' 00:00:00.000000';
			$date2_b=$aaaa.'-'.$mm.'-'.$gg.' 23:59:00.000000';
			$query='INSERT INTO calendario_db.eventi (nome,descrizione,data_inizio,data_fine,id_calendario,tipo) VALUES ("'.$name.'","'.$descrizione.'","'.$date1_b.'","'.$date2_b.'","'.$calendar_id.'","giornaliero");';
			mysql_query($query);
			next_date($gg,$mm,$aaaa);
			
		}
	}
?>