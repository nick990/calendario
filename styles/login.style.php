<?php
	header("Content-type: text/css");
	require("/opt/lampp/htdocs/calendar/config.php");
?>
*{
	padding:0;
	margin:0;
	font-family:Arial, Helvetica, sans-serif;
}
body{
/*
-webkit-transform-style: preserve-3d;
	-moz-transform-style: preserve-3d;
	transform-style: preserve-3d;

	*/
	padding-top:200px;
}

.form_container{
	text-align:center;
	background-color:<?php echo $POPUP_BC; ?>;
	padding-top:30px;
/*
	 position: relative;
  	top: 50%;
 
  	transform: translateY(-50%);
	-webkit-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  */
}
#login_form{
	width:230px;
	margin:auto;
	background-color:<?php echo $POPUP_BC; ?>;
	text-align:right;
	//display: inline-block;
	padding:10px;
	
	border:2px solid <?php echo $NUMBER_BC; ?>;	
}
#login_form div{
	margin-bottom:5px;
}
#login_form #submit{
	padding:3px;
	padding-left:10px;
	padding-right:10px;
}
#error_message{
	height:20px;
	padding:5px;
	color:#d64242;
}
