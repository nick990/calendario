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
