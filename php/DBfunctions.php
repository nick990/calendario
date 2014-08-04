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
	/*
	 * true: calendar exists
	 * false: calendar doesn't exists
	 */
	function existsCalendarByName($name){
		$query="SELECT * FROM calendario_db.calendari WHERE calendari.nome='$name'";
		$result = mysql_query($query);
		if(mysql_fetch_array($result))
			return true;
		return false;
	}
	/*
	 * Inserisce nel DB un nuovo calendario col nome passato,
	 * Ne estrae l'id e lo inserisce nell'array di sessione
	 */
	function insertNewCalendar($name){
		$query="INSERT INTO calendario_db.calendari (nome) VALUES ('".$name."')";
		mysql_query($query);
		$query="SELECT id from calendario_db.calendari WHERE nome='".$name."'";
		$array=mysql_fetch_array(mysql_query($query));
		addCalendarToSession($array['id']);
		
	}
	/*
	 * Ritorna il risultato della query di selezione dei calendari
	 */
	function extractCalendars(){
		$query="SELECT * FROM calendario_db.calendari";
		$result = mysql_query($query);
		return $result;
	}
	/*
	 * Elimina il calendario con id passato dal db
	 * (Dovrei eliminare anche gli eventi!!!)
	 */
	function deleteCalendar($id){
		$query="DELETE FROM calendario_db.calendari WHERE calendari.id='".$id."'";
		mysql_query($query);
		$query="DELETE FROM calendario_db.eventi WHERE eventi.id_calendario='".$id."'";
		mysql_query($query);
		removeCalendarFromSession($id);
	}
	/*
	 * Rimuove l'id passato dall'array di sessione
	 */
	function removeCalendarFromSession($id){
		if(!isset($_SESSION)) 
    	{ 
       		session_start(); 
    	}
		require_once('/opt/lampp/htdocs/calendar/php/utils.php');
		$arr2=array();
		for($i=0;$i<count($_SESSION['cals_id']);$i++){
			if($_SESSION['cals_id'][$i]!=$id)
				$arr2[]=$_SESSION['cals_id'][$i];
		}
		$_SESSION['cals_id']=null;
		$_SESSION['cals_id']=array();
		
		for($i=0;$i<count($arr2);$i++){
			$_SESSION['cals_id'][]=$arr2[$i];
		}
	}
	
	/*
	 *  Aggiunge l'id passato all'array di sessione
	 */
	 function addCalendarToSession($id){
	 	if(!isset($_SESSION)) 
    	{ 
       		session_start(); 
    	}
		$_SESSION['cals_id'][]=$id;
		
	 }
		
	
	/*
	 * Cambia il nome al calendario con id passato
	 */
	function changeCalendarName($id,$new_name){
		$query="UPDATE calendari SET nome='".$new_name."' WHERE id=".$id;
		mysql_query($query);
	}
	
	/*
	 * Sposta gli eventi del calendario 2 nel calendario 1
	 * Poi elimina il calendario 2
	 */
	function joinCalendars($id1,$id2){
		$query="UPDATE eventi SET id_calendario='".$id1."' WHERE id_calendario=".$id2;
		mysql_query($query);
		deleteCalendar($id2);
	}
?>