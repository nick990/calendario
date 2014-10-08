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
	
	
	
	function stampa_for_print_calendar($calendar_id,$description){
		global $giorni_completi,$mesi_completi;
		echo '<td class="date">';
			echo '<div class="number">';
				echo $this->data['mday'];
			echo '</div>';
			echo '<div class="day">';
				echo $giorni_completi[$this->data['wday']];
			echo '</div>';
			echo '<div class="year">';
				echo $mesi_completi[--$this->data['mon']].' '.$this->data['year'];
			echo '</div>';
		echo '</td>';
		echo '<td class="events">';
			//svuoto l'array eventi nel caso fosse stato riempito nel costruttore
			$this->eventi=array();
			$this->eventi=extractEventsByCalendarId($this->data['mday'],++$this->data['mon'],$this->data['year'],$calendar_id);
			//Stampo solo gli eventi gioranlieri
			if(count($this->eventi)!=0){
				for($i=0;$i<count($this->eventi);$i++){
					$last=false;
					if($i==count($this->eventi)-1)
						$last=true;
					$evento=$this->eventi[$i];
					if($evento->get_tipo()=="giornaliero")
						$evento->stampa_for_print_calendar($description,$last);
				}
			//Stampo gli eventi semplici
				echo '<table class="normal_events">';
					for($i=0;$i<count($this->eventi);$i++){
						$last=false;
						if($i==count($this->eventi)-1)
							$last=true;
						$evento=$this->eventi[$i];
						if($evento->get_tipo()=="semplice")
							$evento->stampa_for_print_calendar($description,$last);
					}
				echo '</table>';
			}
		echo '</td>';
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