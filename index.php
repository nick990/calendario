<?php
	/*
	 * Nella sessione salvo gli ID dei calendari da visualizzare
	 * $_SESSION['cals_id'] è larray delle stringhe che rappresentano gli ID
	 * Per default li ha tutti, dovrò fare una funzione che li aggiunge tutti
	 */
	session_start();
	$_SESSION['cals_id']=array();
	/*
	$_SESSION['cals_id'][0]=1;
	$_SESSION['cals_id'][1]=2;
	*/
?>
<html>
	<head>
		
		<?php 
		require("php/link_CSS.php"); ?>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
			<script type="text/javascript" src="js/event_popup.js"></script>
		<script type="text/javascript" src="js/jsfun.js"></script>
	
		
		<title>Calendario3</title>
	</head>
	<body>
		<div class="calendar_container"></div>
		<script type="text/javascript">
			getCalendar();
		</script>
	</body>
</html>