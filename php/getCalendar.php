<?php
	require_once('/opt/lampp/htdocs/calendario3/php/utils.php');
	$cal=new Calendario();
	$cal->costruisciCalendarioMensile($_POST['month'],$_POST['year']);
	$cal->stampaVistaMensile();
?>
