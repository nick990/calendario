
<?php
class Calendar{	
	private $mese;
	private $anno;
	private $giorni=array();
	private $giorni_mese; //Numero di giorni appartenti al mese 
	
	/*
	 *Giorni non appartenenti al mese ma presenti nella visualizzazione 
	*/
	private $giorniMesePrecedente=0; // Numero di giorni appartenenti al mese precedente nella prima settimana (Considerando Lunedi il primo giorno della settimana)
	private $giorniMeseSuccessivo=0; // Numero di giorni appartenenti al mese successivo nell'ultima settimana (Considerando Lunedi il primo giorno della settimana)
	 
	
	/*
	 * Costruttore, instanzia un nuovo calendario mensile dato mese(numerico) e anno(4 cifre).
	 * Se omessi usa quelli correnti
	 */
	 function __construct($mese="",$anno=""){
	 	/*
		 * Opening DB connession
		 */
		 require_once('/opt/lampp/htdocs/calendario3/php/DBfunctions.php');
		 connettiDB("127.0.0.1","calendario_db","root","");
	 	if(empty($mese)||empty($anno)){
	 		$now=getdate();
			$mese=$now['mon'];
			$anno=$now['year'];
	 	}
	 	$this->mese=$mese;
		$this->anno=$anno;
				
		// giorni totali per il mese e anno
		$this->giorni_mese = cal_days_in_month(CAL_GREGORIAN,$this->mese,$this->anno);
		//Costruisco l'array dei giorni con i solo giorni del mese
		for($gg=1;$gg<=$this->giorni_mese;$gg++){
			$this->giorni[]=new Day($gg,$this->mese,$this->anno);
		}
		
	
		$this->giorniMesePrecedente=$this->calcolaGiorniMesePrecedente();
		$this->giorniMeseSuccessivo=$this->calcolaGiorniMeseSuccessivo();	
		
		//Aggiungo i giorni del mese precedente che compaiono nella visualizzazione
		for($i=0;$i<$this->giorniMesePrecedente;$i++){
			$giorno= $this->giorni[0]->getGiornoPrecedente();
			array_unshift($this->giorni,$giorno);	
		}
		
		//Aggiungo i giorni del mese successivo che compaiono nella visualizzazione
		
		for($i=0;$i<$this->giorniMeseSuccessivo;$i++){
			$giorno=$this->giorni[count($this->giorni)-1]->getGiornoSuccessivo();
			$this->giorni[]=$giorno;
		}
		
	 }
	 
	 /*
	  * Stampa il Calendario in vista mensile
	  * Utilizzando una tabella 6x7 più le intestazioni
	  */
	  function stampa(){	
	
		$this->stampaSwitchMese();
		
	 	echo '<table class="calendar_table"><tr class="heading_tr"><td>LUN</td><td>MAR</td><td>MER</td><td>GIO</td><td>VEN</td><td>SAB</td><td>DOM</td></tr>';
	  	
	  	for($i=0;$i<count($this->giorni);$i++){
	  		echo '<td>';
			if($i>=$this->giorniMesePrecedente&&$i<count($this->giorni)-$this->giorniMeseSuccessivo)
				echo '<div class="day">';
			else 
				echo '<div class="day_out">';
			$this->giorni[$i]->stampa();
			echo '</div>';
			echo '</td>';
			//Se è domenica -> chiudo la riga 
			if($this->normalWDay($this->giorni[$i]->getWDay())==6){
				echo '</tr>';
				//Se non è l'ultimo giorno del mese apro una nuova riga
				if($i<count($this->giorni)-1)
					echo '<tr>';
			}
	  	}
		
	  	
		echo '</table>';
		
	
	  }
	  
	 /*
	  * Funziona solo se nell'array $giorni sono stati inseriti solo i giorni del mese
	  */
	   private function calcolaGiorniMesePrecedente(){
	  	return $this->normalWDay($this->giorni[0]->getWDay());
	   }	   
	  /*
	   * Funziona solo se nell'array $giorni sono stati inseriti solo i giorni del mese
	   */
	   private function calcolaGiorniMeseSuccessivo(){
	   	return 6-($this->normalWDay($this->giorni[$this->giorni_mese-1]->getWDay()));
	   }
	   
	   /*
	    * Trasforma WDay dalla rappresentazione standard PHP (0=Domenica...6=Lunedi) nella nostra (0=Lunedi...6=Domenica)
	    */
	   private function normalWDay($wday){
	    if($wday==0)
			$wday=7;
		$wday--;
		return $wday;
	   }
	   
	   /*
	    * Stampa il div per lo switch del mese (visione mensile)
	    */
	   private function stampaSwitchMese(){
	   	global $mesi_completi;
	   	echo "<div class='switch'>";
	   		echo "<div class='prev' onclick=\"javascript:getPrevCalendar($this->mese,$this->anno)\"><img src='images/images_switch/prev.png'></div>";
	   		echo "<div class='next' onclick=\"javascript:getNextCalendar($this->mese,$this->anno)\"><img src='images/images_switch/next.png'></div>";
			echo "<div class='date'>".$mesi_completi[$this->mese-1]." ".$this->anno."</div>";
	   	echo "</div>";
	   }
	   
	  
}//fine classe Calendario
?>