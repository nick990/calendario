<?php
	header("Content-type: text/css");
	require("/opt/lampp/htdocs/calendar/config.php");
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
	//background-color:red;
	
}
table.calendar_table{	
	//border: 1px solid black;
    border-collapse: collapse;
	//position:relative;
	
}

table.calendar_table td{
	  box-sizing:border-box;
  		-moz-box-sizing:border-box;
  	
  	-webkit-box-sizing:border-box;

 
	 border: 1px solid #b5b5b5;	 
	 vertical-align:top;	
	 /*height:auto;*/
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
	height:100%;600
	overflow:hidden;
}
.day{
	width:100%;
	height:100%;	
	overflow:hidden;
}
.menu{
	height:<?php echo $HEIGHT_MENU; ?>;
	position:relative;
	overflow:hidden;
}
.controller,.switch{
	position:absolute;
	
}
.controller{
	width:70%;
	
}
.switch{	
	//line-height:<?php echo $LINE_HEIGHT_SWITCH; ?>;
	height:30px;
	line-height:30px;
	width:25%;
	bottom:0;
	left:0;
}

.switch .prev,.switch .next{
	float:left;
	
	cursor: pointer; cursor: hand;
	}

.switch .date{
	float:left;	
	text-align:left;
}
.controller{
	bottom:0;
	left:25%;
}
.check{
	float:left;
	margin-right:15px;
	width:20%;
	height:30px;
	line-height:30px;
}
