<?php
		require_once('/opt/lampp/htdocs/calendario3/php/utils.php');
		require_once('/opt/lampp/htdocs/calendario3/php/DBfunctions.php');
		 connettiDB("127.0.0.1","calendario_db","root","");
	/*
	 * Estraggo dal DB le informazioni relative all'evento con ID passato tramite POST e le stampo
	 */
	$id=$_POST['id'];
	$query="SELECT eventi.nome,eventi.descrizione,eventi.tipo AS tipo,DATE_FORMAT(eventi.data_inizio,'%d') AS giorno,DATE_FORMAT(eventi.data_inizio,'%m') AS mese,DATE_FORMAT(eventi.data_inizio,'%w') AS giorno_settimana,TIME_FORMAT(TIME(eventi.data_inizio),'%H:%i') AS ora_inizio,TIME_FORMAT(TIME(eventi.data_fine),'%H:%i') AS ora_fine FROM eventi WHERE id='$id'";
	$result = mysql_query($query);
	$array = mysql_fetch_array($result);
	
	
	
	echo '<div class="popup_evento_nome">'.$array['nome'].'</div>';
	echo '<div class="popup_evento_data">'.$settimana[$array['giorno_settimana']].', '.$array['giorno'].' '.$mesi[$array['mese']-1].'';
	if($array['tipo']=='semplice')
		echo ', '.$array['ora_inizio'].'-'.$array['ora_fine'].'</div>';
	else
		echo '</div>';
	echo '<div class="popup_evento_descrizione">'.$array['descrizione'].'</div>';
	
	mysql_close();
	
?>