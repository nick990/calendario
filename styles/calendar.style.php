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
	position:relative;
	background-color:#e2e2e2;
	width:100%;
	height:100%;600
	overflow:hidden;
}
.day{
	position:relative;
	width:100%;
	height:100%;	
	overflow:hidden;
}
.menu{
	//height:<?php echo $HEIGHT_MENU; ?>;
	height:30px;
	position:relative;

		
}
.controller,.switch{
	position:absolute;
	//left:25%;	
	
}
.controller_hs{	
	position:relative;
	bottom:0;
	left:25%;
	//width:50%;
	width:200px;
	height:30px;
	line-height:30px;
	//vertical-align:middle;
	padding-left:5px;	
}
.controller_hs a{
	margin-left:5px;
}
.controller_hs a img{
	vertical-align:middle;
}
.controller_content{
	background-color:green;	
	position:absolute;
	z-index:1;
	left:25%;
	padding:5px;
	padding-right:10px;
	visibility:hidden;
	background: #ffffff; /* Old browsers */
	background: #ffffff; /* Old browsers */
	/* IE9 SVG, needs conditional override of 'filter' to 'none' */
	background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iI2ZmZmZmZiIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiNlZGVkZWQiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
	background: -moz-linear-gradient(top,  #ffffff 0%, #ededed 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ffffff), color-stop(100%,#ededed)); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top,  #ffffff 0%,#ededed 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top,  #ffffff 0%,#ededed 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(top,  #ffffff 0%,#ededed 100%); /* IE10+ */
	background: linear-gradient(to bottom,  #ffffff 0%,#ededed 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#ededed',GradientType=0 ); /* IE6-8 */
	id:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#cccccc',GradientType=0 ); /* IE6-8 */
	border:solid 1px;
	border-top:none;
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

.show_hide_div{
	float:left;
}
