<?php
	header("Content-type: text/css");
	require("/opt/lampp/htdocs/calendario3/config.php");
?>

.event,.daily_event{   
	padding:3px;
	padding-left:5px;
	
	font-size:11px;
	
	width:<?php echo $WIDTH_EVENT; ?>;
	margin:auto;
	margin-top:5px;
	text-overflow:ellipsis;
	white-space: nowrap;	
	
	overflow-x: hidden;
}
.event {
	padding:0px;
	margin-left:10px;
}
.event a{
	 text-decoration: none;
	 color:#ce7165;
}
.daily_event a{
 text-decoration: none;
	 color:#666666;
}
.daily_event{
	background-color:#FEF9DC;
	border: 1px solid #FBE983;
	
	overflow-x:hidden;
	
	
}




