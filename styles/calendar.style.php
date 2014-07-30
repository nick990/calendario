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
	position:relative;
	font-family:Arial, Helvetica, sans-serif;
	display: inline-block;
	
	
}
table.calendar_table{	
	border: 1px solid black;
    border-collapse: collapse;

}

table.calendar_table td{
	 border: 1px solid black;	 
	 vertical-align:top;	
	 height:auto;
	 width:<?php echo $WIDTH_DAY; ?>;
	 height:<?php echo $HEIGHT_DAY; ?>;
	 
	overflow:hidden;
}
table.calendar_table tr.heading_tr td{	
	background-color:#003729;
	height:<?php echo $HEIGHT_HEADING_TR; ?>;
	color:#d5edd3;
	text-align:center;
	line-height:<?php echo $LINE_HEADING_TR; ?>;
	overflow:hidden;
	width:<?php echo $WIDTH_DAY; ?>;
	
}
.day_out{	
	background-color:#e2e2e2;
	width:100%;
	height:100%;
	overflow:hidden;
}
.day{
	
	width:100%;
	height:100%;	
	overflow:hidden;
}
