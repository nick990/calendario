<?php
	header("Content-type: text/css");
	require("/opt/lampp/htdocs/calendar/config.php");
?>

.simple_event,.daily_event,.start_event{ 	
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
.simple_event {
	padding:0px;
	margin-left:10px;
	
}
.simple_event a{
	 text-decoration: none;
	 color:#ce7165;
}
.daily_event a,.start_event a,.end_event a{
 text-decoration: none;
 color:#666666;
}
.daily_event{	
	background-color:#FEF9DC;
	border: 1px solid #FBE983;
		
}



.popup{
	font-size:14px;	
	position:absolute;
	top:0px;	
	width:250px;	
	border:1px #9b9b9b solid;
  	webkit-box-shadow: 0px 0px 5px 0px rgba(50, 50, 50, 0.75);
	-moz-box-shadow:    0px 0px 5px 0px rgba(50, 50, 50, 0.75);
	box-shadow:         0px 0px 5px 0px rgba(50, 50, 50, 0.75);
 	background-color:<?php echo $POP_BKG; ?>; 
 	visibility:hidden; 	
}
.popup_content{
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
	/*edf7ef*/
	//border-bottom:3px solid #eef4ed;
	padding:5px;
}
.popup_calendario_nome{
	border-bottom:3px solid #eef4ed;
	padding:5px;
	padding-top:0px;
	font-size:12px;
}
.popup_evento_descrizione{
	border:3px solid #eef4ed;
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
.edit_event{
	position:absolute;
	margin-top:5px;
	height:15px;
	width:15px;
	background-image:url('../images/icon_edit.gif');
	cursor: pointer; cursor: hand;
	top:0;
}
.remove_event{
	position:absolute;
	margin-top:5px;
	height:15px;
	width:15px;
	background-image:url('../images/delete.png');
	cursor: pointer; cursor: hand;
	top:0;
}




