<?php
	/*
	 * 0: modifiche applicate con successo
	 * 1: il nuovo nome desiderato è già utilizzato da un altro calendario, consigliare join
	 */
	$id=$_POST['id'];
	
	
	require_once('DBfunctions.php');
	connettiDB("127.0.0.1","calendario_db","root","");
	$query='DELETE FROM calendario_db.eventi WHERE id="'.$id.'"';
	mysql_query($query);
	mysql_close();
?>