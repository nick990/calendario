<?php
	require_once('/opt/lampp/htdocs/calendario3/php/utils.php');
	$cal=new Calendar($_POST['month'],$_POST['year']);
	$cal->stampa();
?>
