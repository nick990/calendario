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
