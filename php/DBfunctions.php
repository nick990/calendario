<?php
	 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
	/*
 	 * Crea la connessione con il database mysql 
	 */
	function connettiDB($host,$db,$user,$pwd) {
		$connessione = mysql_connect($host,$user,$pwd) or die("Connessione non riuscita: " . mysql_error());
    	// make calendario_db the current db
		$db_selected = mysql_select_db($db, $connessione);
		if (!$db_selected)
    		die ('Errore nella connessione al DB : ' . mysql_error());

    }
	 /*
	* Estraggo dal DB tutte gli eventi che hanno inizio nel giorno $gg/$mm/$aaaa
	*/
	function estraiEventi($gg,$mm,$aaaa){
		$eventi=array();
		/*AND eventi.data_fine BETWEEN '$aaaa-$mm-$gg 00:00' AND '$aaaa-$mm-$gg 23:59'  */
		$query="SELECT * FROM calendario_db.eventi WHERE eventi.data_inizio BETWEEN '$aaaa-$mm-$gg 00:00' AND '$aaaa-$mm-$gg 23:59' ORDER BY data_inizio,tipo";
		$result = mysql_query($query);
		while ($array = mysql_fetch_array($result))
		{
			$newEvento=new Event($array['id'],$array['data_inizio'],$array['data_fine'],$array['nome'],$array['descrizione'],$array['tipo']);
			$eventi[]=$newEvento;
		}
		return $eventi;
	}
	/*
	* Extracts all events from DB which start on day $gg/$mm/$aaaa and belong to chechek calendar
	*/
	function extractEventsInCheckedCalendars($gg,$mm,$aaaa){
		$eventi=array();
		//If there aren't checked calendars returns estraiEventi()
		$num_cals=count($_SESSION['cals_id']);
		if($num_cals==0)
			return;// estraiEventi($gg,$mm,$aaaa);
		//Else 
		//Build the string "(id1,id2,ecc...)" for mysql query
		$id_range='(';
		for($i=0;$i<$num_cals-1;$i++)
			$id_range.=$_SESSION['cals_id'][$i].',';
		$id_range.=$_SESSION['cals_id'][$num_cals-1];
		$id_range.=')';
		
	
		$query="SELECT * FROM calendario_db.eventi WHERE eventi.data_inizio BETWEEN '$aaaa-$mm-$gg 00:00' AND '$aaaa-$mm-$gg 23:59' AND eventi.id_calendario IN ".$id_range." ORDER BY data_inizio,tipo";
		$result = mysql_query($query);
		while ($array = mysql_fetch_array($result))
		{
			$newEvento=new Event($array['id'],$array['data_inizio'],$array['data_fine'],$array['nome'],$array['descrizione'],$array['tipo']);
			$eventi[]=$newEvento;
		}
		return $eventi;
	}

	
?>