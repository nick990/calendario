<?php
	global $settimana;
	$settimana=array("Dom","Lun","Mar","Mer","Gio","Ven","Sab");
	global $mesi;
	$mesi=array("Gen","Feb","Mar","Apr","Mag","Giu","Lug","Ago","Set","Ott","Nov","Dic");
	global $mesi_completi;
	$mesi_completi=array("Gennaio","Febbraio","Marzo","Aprile","Maggio","Giugno","Luglio","Agosto","Settembre","Ottobre","Novembre","Dicembre");
	global $anno_min,$anno_max;
	$anno_min=2014;
	$anno_max=2015;
	/*
	 * Funzione di autoload per il caricamento automatico delle classi php
	 */
	function __autoload($nome_classe){
		require_once('/opt/lampp/htdocs/calendar/classes/'.$nome_classe.'.class.php');
	}	
	/* 
	 * Giorni compresi tra due date stremi inclusi
	 * $data1 e data2 vanno inserite
	 * in formato gg-mm-aaaa, se nulle
	 * prende come data di riferimento
	 * quella di oggi.
	 */
	function diff_date_ingiorni($timestamp1,$timestamp2){         
         $seconds= $timestamp1 - $timestamp2;
         /* (86400 = 24h*60min*60sec) */
         $days = abs(intval($seconds / 86400));
         return (++$days);
	}
	/*
	 * Trasforma WDay dalla rappresentazione standard PHP (0=Domenica...6=Lunedi) nella nostra (0=Lunedi...6=Domenica)
	 */
	function normalWDay($wday){
	    if($wday==0)
			$wday=7;
		$wday--;
		return $wday;
	}
	/*
	 * Riceve per riferimento gg/mm/aaaa e li porta nella data successiva
	 */
	function next_date(&$gg,&$mm,&$aaaa){
		$date=date('d-m-Y', strtotime($gg.'-'.$mm.'-'.$aaaa.' + 1 day'));
		$aux = explode('-',$date);
		$gg=$aux[0];
		$mm=$aux[1];
		$aaaa=$aux[2];
	}
?>