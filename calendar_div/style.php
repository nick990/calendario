<?php
	header("Content-type: text/css");
	require("config.php");
?>
.calendar_container{
	width:<?php echo $CC_W; ?>;
	height:<?php echo $CC_H; ?>;
	
}
.controller{
	height:<?php echo $CON_H; ?>;
	
}
.switch{
	width:30%;
	height:100%;
	float:left;
	background-color:red;
}
.calendar{
	width:<?php echo $CC_W; ?>;
	height:<?php echo $CC_H; ?>;
	background-color:grey;
}
.calendars_list{
	width:70%;
	height:100%;
	float:left;
	background-color:green;
}
.calendar_tr{
	overflow:hidden;
}
.calendar_td{
	float:left;
	width:<?php echo $TD_W; ?>;
	height:<?php echo $TD_H; ?>;
	
	
	
}
.day{
	//width:<?php echo $DAY_W; ?>;
	//height:<?php echo $DAY_H; ?>;
	//border:1px solid;
	width:100%;
	height:100%;
	  box-sizing:border-box;
  -moz-box-sizing:border-box;
  -webkit-box-sizing:border-box;

  border:1px solid red;
}
