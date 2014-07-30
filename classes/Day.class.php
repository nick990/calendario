<?php
class Day{
	
	private $data; //Array associativo ottenuto da getdate
	private $eventi=array(); //Array di Eventi
	
	/*
	 * Costruttore, instanzia un nuovo giorno dato gg/mm/aaaa (numerici).
	 */
	 function __construct($gg="",$mm="",$aaaa=""){
	 	$this->data=getdate(mktime(0,0,0,$mm,$gg,$aaaa));
		
		$this->estraiEventi($gg, $mm, $aaaa);
	 }
	 
	 /*
	  * stampo 'mday'
	  */
	 function stampa(){
	 	echo '<div class="number">';
	 	echo $this->data['mday'];
		echo '</div>';
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
	* Estraggo dal DB tutte gli eventi semplici (che hanno inizio e fine in questo giorno non durano tutto il giorno)
	*/
	function estraiEventi($gg,$mm,$aaaa){
		$query="SELECT * FROM calendario_db.eventi WHERE eventi.data_inizio BETWEEN '$aaaa-$mm-$gg 00:00' AND '$aaaa-$mm-$gg 23:59' AND eventi.data_fine BETWEEN '$aaaa-$mm-$gg 00:00' AND '$aaaa-$mm-$gg 23:59'   ORDER BY data_inizio,tipo";
		$result = mysql_query($query);
		while ($array = mysql_fetch_array($result))
		{
			$newEvento=new Evento($array['id'],$array['data_inizio'],$array['data_fine'],$array['nome'],$array['descrizione'],$array['tipo']);
			$this->eventi[]=$newEvento;
		}
	}
	
	 /*
	  * Crea un'istanza della classe Giorno con data precedente di 1 giorno
	  */
	 function getGiornoPrecedente(){
	 	$ts=mktime(0,0,0,$this->data['mon'],$this->data['mday'],$this->data['year']);
		$ts=strtotime('-1 day', $ts);
		$newData=getdate($ts);
		return new Giorno($newData['mday'],$newData['mon'],$newData['year']);
	 }
	 
	  /*
	   * Crea un'istanza della classe Giorno con data precedente di 1 giorno
	  */
	 function getGiornoSuccessivo(){
	 	$ts=mktime(0,0,0,$this->data['mon'],$this->data['mday'],$this->data['year']);
		$ts=strtotime('+1 day', $ts);
		$newData=getdate($ts);
		return new Giorno($newData['mday'],$newData['mon'],$newData['year']);
	 }
}
?>