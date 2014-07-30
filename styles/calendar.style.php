<?php
	header("Content-type: text/css");
	require("/opt/lampp/htdocs/calendario3/config.php");
?>

*{
	padding:0px;
}
.calendar_container{
	width: <?php echo $WIDTH_CALENDAR_CONTAINER; ?>;
	height: <?php echo $HEIGHT_CALENDAR_CONTAINER; ?>;
}
