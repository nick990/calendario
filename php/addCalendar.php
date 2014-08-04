<?php
	/*
	 * [Devo aggiungere controlli sul post e sul login]
	 * 
	 * Riceve il nome del calendario che si vuole aggiungere tramite metodo POST
	 * Controlla se c'è già nel DB un calendario con tale nome:
	 * se si stampa 1 ed esce;
	 * se non c'è lo inserisce, stampa 0 ed esce	 * 
	 */
	require_once('/opt/lampp/htdocs/calendar/php/DBfunctions.php');
	connettiDB("127.0.0.1","calendario_db","root","");
	$nome=$_POST['name'];
	if(existsCalendarByName($nome)){
		echo 1;
		
	}else{
		insertNewCalendar($nome);		
	echo 0;
	}
	mysql_close();
?>