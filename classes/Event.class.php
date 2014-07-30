

<?php
class Event{
	/*
	 * data_inizio e data_fine sono DATESTAMP mysql aaaa-mm-gg hh:mm:ss:zzzz
	 * data_inizio_ts e data_fine_ts sono UNIX TIMESTAMP
	 */
	private $id,$data_inizio,$data_fine,$nome,$descrizione,$tipo;
	private $istantaneo=FALSE,$giornaliero=FALSE;
	private $data_inizio_ts,$data_fine_ts;
	function __construct($id,$data_inizio,$data_fine,$nome,$descrizione,$tipo){
		$this->id=$id;
		$this->data_inizio=$data_inizio;
		$this->data_fine=$data_fine;
		$this->nome=$nome;
		$this->descrizione=$descrizione;
		$this->tipo=$tipo;
		$this->data_inizio_ts=strtotime($this->data_inizio);
		$this->data_fine_ts=strtotime($this->data_fine);
	}
	
	function stampa(){
		switch($this->tipo){
			case 'semplice':
				$this->stampaSemplice();
				break;
			case 'giornaliero':
				$this->StampaGiornaliero();
				break;
			default:
				break;
		}
	}
	function stampaSemplice(){
		echo '<div class="event" id="evento'.$this->id.'">';
			$ora_inizio_format=date('H:i',$this->data_inizio_ts);
			$ora_fine_format=date('H:i',$this->data_fine_ts);
			echo '<b>'.$ora_inizio_format.' - './*$ora_fine_format.*/' </b><a href="javascript:creaPopup('.$this->id.')">'.$this->nome.'</a>';
		echo '</div>';
	}
	function StampaGiornaliero(){
		echo '<div class="daily_event" id="evento'.$this->id.'">';
		echo '<a href="javascript:creaPopup('.$this->id.')">'.$this->nome.'</a>';
		echo '</div>';
	}
}
?>