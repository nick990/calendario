<?php
	header("Content-type: text/css");
	require("/opt/lampp/htdocs/calendar/config.php");
	
?>
.number{
	height:25px;
	line-height:25px;
	font-size:16px;
	padding-left:3px;
	
	
	text-align:left;
	background-color:<?php echo $NUMBER_BC; ?>;
	//background-color:#eef4ed;
	
}
.events,.events_scroll{
	
	width:100%;
	max-width:100%;
	height:<?php echo($HEIGHT_DAY-30);?>;
	max-height:	<?php echo($HEIGHT_DAY-30);?>;
	overflow:hidden;
	
}
.events_scroll{
	overflow-y:scroll;
}
