<?php
	/*
	 * Da chiamare nell'index.php prima di qualsiasi istruzione
	 * Nella sessione salvo gli ID dei calendari da visualizzare
	 * $_SESSION['cals_id'] è larray delle stringhe che rappresentano gli ID
	 * Per default li metto tutti
	 */
	session_start();
	$_SESSION['cals_id']=array();
	require_once('php/DBfunctions.php');
	connettiDB("127.0.0.1","calendario_db","root","");
	$query="SELECT id FROM calendario_db.calendari";
		$result = mysql_query($query);
		while ($array = mysql_fetch_array($result))
		{
			$_SESSION['cals_id'][]=$array['id'];
		}
	
	
?>