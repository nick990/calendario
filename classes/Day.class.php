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
				$evento->stampa();
			}
		echo '</div>';
	 }
	
	/*
	 * stampa() + handler per popup di creazione di un un nuovo evento su ogni giorno
	 * Viene passato l'id numerico del giorno per tenere traccia del giorno in fase di posizionamento del popup
	 */
	 function stampaForAdmin($id){
	 	echo '<div class="new_event_btn" onclick="get_new_event_popup('.$id.','.$this->data['mday'].','.$this->data['mon'].','.$this->data['year'].')"></div>';
	 	$this->stampa();
		
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