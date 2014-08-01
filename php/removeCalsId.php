<?php
	/*
	 * Remove the calendar id passed by POST from the session array
	 */
	session_start();
	require_once('/opt/lampp/htdocs/calendar/php/utils.php');
	$arr2=array();
	for($i=0;$i<count($_SESSION['cals_id']);$i++){
		if($_SESSION['cals_id'][$i]!=$_POST['id'])
			$arr2[]=$_SESSION['cals_id'][$i];
	}
	$_SESSION['cals_id']=null;
	$_SESSION['cals_id']=array();
	
	for($i=0;$i<count($arr2);$i++){
		$_SESSION['cals_id'][]=$arr2[$i];
	}
	
	
	if(isset($_POST['month'])&&isset($_POST['year']))
		$cal=new Calendar($_POST['month'],$_POST['year']);
	else {
		$cal=new Calendar();
	}
	$cal->stampa();
?>
