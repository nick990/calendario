<?php
	header("Content-type: text/css");
	require("/opt/lampp/htdocs/calendar/config.php");
	
?>
#new_cal_error{
	float:left;
	color:<?php echo $COLOR_ERROR; ?>;
}
#new_cal_form{
	float:left;
	width:200px;
}
.new_cal_container{
	overflow:hidden;
}

.calendar_editor{
	position:relative;
	width:200px;
}
.calendar_editor_popup{
	position:absolute;
	width:300px;
	//height:200px;
	background-color:<?php echo $POPUP_BC; ?>;
	z-index:50;
	visibility:hidden;
	top:0px;	
	border:1px #9b9b9b solid;
  	webkit-box-shadow: 0px 0px 5px 0px rgba(50, 50, 50, 0.75);
	-moz-box-shadow:    0px 0px 5px 0px rgba(50, 50, 50, 0.75);
	box-shadow:         0px 0px 5px 0px rgba(50, 50, 50, 0.75);
 	
 
 	visibility:hidden; 	
}
.cep_content{
	padding:10px;
}
.close_editor{
	float:right;
	height:15px;
	width:15px;
	background-image:url('../images/icon_x.gif');
	cursor: pointer; cursor: hand;
	margin:5px;
}
#cal_edit_form_error{
	color:<?php echo $COLOR_ERROR; ?>;
	height:30px;
	min-height:20px;
	float:bottom;
}
#cal_edit_form #submit{
	padding:3px;
	float:right;
	margin-bottom:5px;
}


/*
 * New Event Popup
 */
.new_event_popup{
	font-size:14px;	
	position:absolute;
	top:0px;	
	width:450px;	
	border:1px #9b9b9b solid;
  	webkit-box-shadow: 0px 0px 5px 0px rgba(50, 50, 50, 0.75);
	-moz-box-shadow:    0px 0px 5px 0px rgba(50, 50, 50, 0.75);
	box-shadow:         0px 0px 5px 0px rgba(50, 50, 50, 0.75);	
	background-color:<?php echo $POP_BKG; ?>;	
  	visibility:hidden; 	
}
.nep_content{	
	padding:10px;
}
.close_nep{
	float:right;
	height:15px;
	width:15px;
	background-image:url('../images/icon_x.gif');
	cursor: pointer; cursor: hand;
	margin:5px;
}

.nep_row{
	height:25px;
	min-height:25px;
	position:absolute;
	visibility:hidden;
}
.my_date_picker{
	
}
.new_event_error{
	color:<?php echo $COLOR_ERROR; ?>;
	padding:5px;
	font-size:12px;
}
#date_time_pickers{
	text-align:right;
	padding-right:25px;
	margin-bottom:20px;
}
#new_event_form #submit{
	padding:3px;
}
textarea[name=description] {
    resize: none;
}
#label_fine{
	margin-left:9px;
}
#name{
	margin-bottom:15px;
}
