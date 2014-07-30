<?php
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
	
?>