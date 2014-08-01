<?php
	//	.calendar_container
	$CC_W=800;
	$CC_H=600;
	
	//	.controller
	$CON_H=floor($CC_H/8);
	
	// .calendar
	$CAL_W=$CC_W;
	$CAL_H=$CC_H-$CON_H;
	
	//	.calendar_td
	$TD_W=floor($CAL_W/7);
	$TD_H=floor($CAL_H/6);
	
	//	.day
	$DAY_W=$TD_W;
	$DAY_H=$TD_H;
?>