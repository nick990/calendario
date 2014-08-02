<?php
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
	
	unset($_SESSION['user_id']);
	unset($_SESSION['admin']);
	unset($_SESSION['cals_id']);
?>
