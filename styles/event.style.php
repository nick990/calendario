<?php
	header("Content-type: text/css");
	require("/opt/lampp/htdocs/calendario3/config.php");
?>

.event,.daily_event{ 	
	padding-left:5px;
	
	font-size:11px;
	
	width:<?php echo $WIDTH_EVENT; ?>;
	height:<?php echo $HEIGHT_EVENT; ?>;
	line-height:<?php echo $LINE_HEIGHT_EVENT; ?>;
	margin:auto;
	margin-top:5px;
	text-overflow:ellipsis;
	white-space: nowrap;	
	
	overflow: hidden;
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

.popup{
	font-size:14px;
	
	position:absolute;
	top:0px;
	
	
	width:250px;
	
	border:1px #9b9b9b solid;*/
	
	
  	webkit-box-shadow: 0px 0px 5px 0px rgba(50, 50, 50, 0.75);
	-moz-box-shadow:    0px 0px 5px 0px rgba(50, 50, 50, 0.75);
	box-shadow:         0px 0px 5px 0px rgba(50, 50, 50, 0.75);
 		background-color:#D5EDD3;
 	visibility:hidden;
 	
 	
}
.popup_content{
	background-color:#D5EDD3;
	padding:5px;
}
.chiudi{
	float:right;
	height:15px;
	width:15px;
	background-image:url('../images/icon_x.gif');
	cursor: pointer; cursor: hand;
	margin:5px;
}
.popup_evento_nome{
	font-weight:bold;
	border-bottom:3px solid #edf7ef;
	padding:5px;
}
.popup_evento_descrizione{
	border:3px solid #edf7ef;
	padding:5px;
	height:65px;
	overflow-y:scroll;
}
.popup_evento_data{
	padding:5px;
	font-size:11px;
}
.row{
	height:25px;
	min-height:25px;
	position:absolute;
	visibility:hidden;
}





