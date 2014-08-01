<?php
	/*
	 * Add the calendar ID passed by POST in the session array
	 */
	session_start();
	require_once('/opt/lampp/htdocs/calendar/php/utils.php');
	$_SESSION['cals_id'][]=$_POST['id'];
	if(isset($_POST['month'])&&isset($_POST['year']))
		$cal=new Calendar($_POST['month'],$_POST['year']);
	else {
		$cal=new Calendar();
	}
	$cal->stampa();
?>