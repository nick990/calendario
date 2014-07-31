<?php
	require_once('/opt/lampp/htdocs/calendario3/php/utils.php');
	if(isset($_POST['month'])&&isset($_POST['year']))
		$cal=new Calendar($_POST['month'],$_POST['year']);
	else {
		$cal=new Calendar();
	}
	$cal->stampa();
?>
