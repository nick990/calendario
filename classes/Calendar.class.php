
<?php
class Calendar{
	
	private $mese;
	private $anno;
	private $giorni=array();
	private $giorni_mese; //Numero di giorni appartenti al mese 
	
	private $admin=false; //in fase di stampa mi dice se l'utente è l'admin o meno
	
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
		 require_once('/opt/lampp/htdocs/calendar/php/DBfunctions.php');
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
		echo '<div class="menu">';
			$this->stampaSwitchMese("false");
			$this->stampaController("false");
		//echo '</div>'; Il menu è chiuso in stampaController
		
		
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
	   private function stampaSwitchMese($admin=""){
	   	
	   	global $mesi_completi;
	   	echo "<div class='switch'>";
			if($admin=="true")
				$str='ForAdmin';
			else
				$str='';
	   		echo "<div class='prev' onclick=\"javascript:getPrevCalendar".$str."($this->mese,$this->anno)\"><img src='images/images_switch/prev.png'></div>";
	   		echo "<div class='next' onclick=\"javascript:getNextCalendar".$str."($this->mese,$this->anno)\"><img src='images/images_switch/next.png'></div>";
			echo "<div class='date'>".$mesi_completi[$this->mese-1]." ".$this->anno."</div>";
	   	echo "</div>";
	   }
	   /*
	    * Stampa il div per la selezione dei calendari
	    */
	   private function stampaController($admin=""){
	   		
	    	//echo "<div class='controller'>";
			echo "<div class='controller_hs'>Calendari";
				echo "<a href='javascript:hs_calendars();'>";
					echo "<img src=\"images/show.png\" width=\"16\" height=\"16\">";
				echo "</a>";
			echo "</div>"; //chiudo controller_hs
			echo "</div>"; //chiudo il menu
			echo "<div class='controller_content'>";
	    		$query="SELECT * FROM calendario_db.calendari";
				$result = mysql_query($query);
				while ($array = mysql_fetch_array($result))
				{
					$ck_str='<div class="check"><input type="checkbox"';
					//If the current calendar is in the array  or the array  is empty I set checked=true
					if(in_array($array['id'], $_SESSION['cals_id']))
						$ck_str.=' checked="true"';
					$ck_str.='name=checkbox_'.$array['id'].' onChange="checkbox_changed('.$admin.','.$array['id'].','.$this->mese.','.$this->anno.')">'.$array['nome'].'</div>';
					echo $ck_str;
					
				}
			//echo "</div>";
	    	echo "</div>"; //chiudo controller_content
	    	
	    }
	   
	 
	  public function stampaManager(){
	  	echo '<div class="new_cal_container">';
		  	echo '<form id="new_cal_form" action="javascript:void(0);" onsubmit="addCalendar($(\'#new_cal_name\').val(),'.$this->mese.','.$this->anno.')">';
		  		echo '<input type="text" size="15" id="new_cal_name" name="new_cal_name" placeholder="nuovo calendario"/>';
				echo '<input type="submit" id="new_cal_add" value="+" >';
				
			echo '</form>';//devo chiamare get calendar
			echo '<div id="new_cal_error"></div>';
		echo '</div>';
		echo '<div class="calendars_manager">';
			$calendars=extractCalendars();
			while ($array = mysql_fetch_array($calendars))
			{
				echo '<div class="calendar_editor" id="calendar_editor_'.$array['id'].'">';
					echo $array['nome'];
					echo ' <a href="javascript:deleteCalendar('.$array['id'].','.$this->mese.','.$this->anno.')">delete</a>';
					echo ' <a href="javascript:calendarEditorPopup('.$array['id'].','.$this->mese.','.$this->anno.')">edit</a>';
				echo '</div>';
				
			}
			//mysql_close();
		echo '</div>';
		
		echo '<script type="text/javascript" src="js/admin_tool/stampa_manager.js"></script>';
	
	  }
	   /*
	  * Stampa il Calendario in vista mensile
	  * Utilizzando una tabella 6x7 più le intestazioni
	  */
	  function stampaForAdmin(){		
		echo '<div class="menu">';
			$this->stampaSwitchMese("true");
			$this->stampaController("true");
	//echo '</div>';
		echo '<table class="calendar_table"><tr class="heading_tr"><td>LUN</td><td>MAR</td><td>MER</td><td>GIO</td><td>VEN</td><td>SAB</td><td>DOM</td></tr>';
	  	for($i=0;$i<count($this->giorni);$i++){
	  		echo '<td>';
			if($i>=$this->giorniMesePrecedente&&$i<count($this->giorni)-$this->giorniMeseSuccessivo)
				echo '<div class="day" id="day_'.$i.'">';
			else 
				echo '<div class="day_out" id="day_'.$i.'">';
			
			$this->giorni[$i]->stampaForAdmin($i);
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
}//fine classe Calendario
?>