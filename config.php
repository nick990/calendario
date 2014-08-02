<?php
	//Numero massimo di eventi visualizzabili in events, oltre events diventa events_scroll con la barra di scorrimento dell'overflow verticale
	$MAX_EVENT=4;

	$WIDTH_CALENDAR_CONTAINER=900;
	$HEIGHT_CALENDAR_CONTAINER=800;
	
	$HEIGHT_MENU=60;
	$LINE_HEIGHT_SWITCH=$HEIGHT_MENU."px";
	$MARGIN_TOP_SWITCH_PREV=floor(($HEIGHT_MENU-30)/2);
	$HEIGHT_HEADING_TR=30;
	$LINE_HEADING_TR="30px";
	/*
	 * Le misure della tabella sono date in automatico dalle misure del container
	 * Devo togliere le misure degli altri div : SWITCH,CONTROLLER
	 */
	$WIDTH_CALENDAR_TABLE=$WIDTH_CALENDAR_CONTAINER;
	$HEIGHT_CALENDAR_TABLE=$HEIGHT_CALENDAR_CONTAINER-$HEIGHT_MENU;
	/*
	 * Le misure dei giorni le trovo dividendo le misure della tabella per il massimo numero di righe e colonne (toglieno l'intestazione)
	 */
	$WIDTH_DAY=floor(($WIDTH_CALENDAR_TABLE)/7);
	$HEIGHT_DAY=floor(($HEIGHT_CALENDAR_TABLE-$HEIGHT_HEADING_TR)/6);
	
	/*
	 * L'evento vuole la dimensione sennò non funziona il nowrap con l'overflow:hidden
	 * Tolgo alla dimensione del giorno il padding dell'evento
	 */
	$WIDTH_EVENT=$WIDTH_DAY-14;
	$HEIGHT_EVENT=floor(($HEIGHT_DAY-30)/$MAX_EVENT-7);
	$LINE_HEIGHT_EVENT=$HEIGHT_EVENT."px";
	
	$POPUP_BC="#c9d6c7";
	$NUMBER_BC="#eef4ed";
	
	$COLOR_ERROR="#d64242";
?>