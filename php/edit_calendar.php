<?php
	/*
	 * 0: modifiche applicate con successo
	 * 1: il nuovo nome desiderato è già utilizzato da un altro calendario, consigliare join
	 */
	$id=$_POST['id'];
	$rename=$_POST['rename'];
	$join_check=$_POST['join_check'];
	$id_join=$_POST['id_join'];
	
	require_once('DBfunctions.php');
	connettiDB("127.0.0.1","calendario_db","root","");
	if(existsCalendarByName($rename))
		echo 1;
	else{
		//Rinomino se rename è settato
		if(strlen($rename)>0)
		 	changeCalendarName($id,$rename);	
		/*
		 * Effettuo il join con il calendario selezionato se join_check è TRUE
		 * Se è settato anche il rename, sarà il nome del nuovo calendario
		 */		
		if($join_check=='true')
			joinCalendars($id,$id_join);
		echo 0;	
	}
	mysql_close();
?>