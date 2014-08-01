<?php
class Day{
	
	private $data; //Array associativo ottenuto da getdate
	private $eventi=array(); //Array di Eventi
	
	/*
	 * Costruttore, instanzia un nuovo giorno dato gg/mm/aaaa (numerici).
	 */
	 function __construct($gg="",$mm="",$aaaa=""){
	 	$this->data=getdate(mktime(0,0,0,$mm,$gg,$aaaa));
		
		$this->eventi=extractEventsInCheckedCalendars($gg, $mm, $aaaa);
	 }
	 
	 /*
	  * stampo 'mday'
	  */
	 function stampa(){
	 	require("/opt/lampp/htdocs/calendar/config.php");
	 	echo '<div class="number">';
	 	echo $this->data['mday'];
		echo '</div>';
		if(count($this->eventi)>$MAX_EVENT)
			echo '<div class="events_scroll">';
		else
			echo '<div class="events">';
		if(count($this->eventi)!=0)
			foreach ($this->eventi as $evento) {
			//	echo '<div class="evento">';
				$evento->stampa();
			//	echo '</div>';
			}
		echo '</div>';
	 }
	
	
	function getWDay(){
	 	return $this->data['wday'];
	 }
	
	
	
	 /*
	  * Crea un'istanza della classe Giorno con data precedente di 1 giorno
	  */
	 function getGiornoPrecedente(){
	 	$ts=mktime(0,0,0,$this->data['mon'],$this->data['mday'],$this->data['year']);
		$ts=strtotime('-1 day', $ts);
		$newData=getdate($ts);
		return new Day($newData['mday'],$newData['mon'],$newData['year']);
	 }
	 
	  /*
	   * Crea un'istanza della classe Giorno con data precedente di 1 giorno
	  */
	 function getGiornoSuccessivo(){
	 	$ts=mktime(0,0,0,$this->data['mon'],$this->data['mday'],$this->data['year']);
		$ts=strtotime('+1 day', $ts);
		$newData=getdate($ts);
		return new Day($newData['mday'],$newData['mon'],$newData['year']);
	 }
}
?>