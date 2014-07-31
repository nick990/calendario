<?php
	$WIDTH_CALENDAR_CONTAINER=900;
	$HEIGHT_CALENDAR_CONTAINER=600;
	
	$HEIGHT_SWITCH=30;
	
	$HEIGHT_HEADING_TR=30;
	$LINE_HEADING_TR="30px";
	/*
	 * Le misure della tabella sono date in automatico dalle misure del container
	 * Devo togliere le misure degli altri div : SWITCH,CONTROLLER
	 */
	$WIDTH_CALENDAR_TABLE=$WIDTH_CALENDAR_CONTAINER;
	$HEIGHT_CALENDAR_TABLE=$HEIGHT_CALENDAR_CONTAINER-$HEIGHT_SWITCH;
	/*
	 * Le misure dei giorni le trovo dividendo le misure della tabella per il massimo numero di righe e colonne (toglieno l'intestazione)
	 */
	$WIDTH_DAY=($WIDTH_CALENDAR_TABLE)/7;
	$HEIGHT_DAY=($HEIGHT_CALENDAR_TABLE-$HEIGHT_HEADING_TR)/6;
	
	/*
	 * L'evento vuole la dimensione sennò non funziona il nowrap con l'overflow:hidden
	 * Tolgo alla dimensione del giorno il padding dell'evento
	 */
	$WIDTH_EVENT=$WIDTH_DAY-25;
	
?>