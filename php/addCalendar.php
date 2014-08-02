<?php
	
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