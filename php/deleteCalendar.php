/*
 * Remove a calendar by id 
 */
<?php
	require_once('/opt/lampp/htdocs/calendar/php/DBfunctions.php');
	connettiDB("127.0.0.1","calendario_db","root","");
	$id=$_POST['id'];
	deleteCalendar($id);
	mysql_close();
?>