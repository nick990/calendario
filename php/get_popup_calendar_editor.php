<?php
	/*
	 * Dovrei controllare che l'utente sia admin e che sia passato l'id per POST
	 */
	require('/opt/lampp/htdocs/calendar/php/DBfunctions.php');
	connettiDB('127.0.0.1','calendario_db','root','');
	$id=$_POST['id'];
	$query='SELECT * FROM calendario_db.calendari WHERE calendari.id='.$id;
	$result=mysql_query($query);
	$array = mysql_fetch_array($result);
	$nome=$array['nome'];
	
	
	$mese=$_POST['mese'];
	$anno=$_POST['anno'];
	
	
	echo '<b>'.$nome.'</b>';
	echo '<form id="cal_edit_form" action="javascript:void(0);" onsubmit="editCalendar('.$mese.','.$anno.','.$id.',$(\'#rename_cal\').val(),$(\'#join_check\').is(\':checked\'),$(\'#join_list\').val())">';
		echo '<label for="rename_cal">Rinomina: </label>';
		echo '<input type="text" size="15" id="rename_cal" name="rename_cal" placeholder="'.$nome.'"/>';
		echo '</br>';
		echo '<input type="checkbox" name="join_check" id="join_check">';
		echo '<label for="join_list">Importa eventi dal calendario </label>';
		echo '<select id="join_list">';
			$query2='SELECT * FROM calendario_db.calendari WHERE calendari.id!='.$id;
			$result2=mysql_query($query2);
			while($array2=mysql_fetch_array($result2)){
				echo '<option value="'.$array2['id'].'">'.$array2['nome'].'</option>';
			}
		echo '</select>';
		
		echo '<div id="cal_edit_form_error"></div>';
		echo '<input type="submit" id="submit" value="Applica ed esci"/>';
		
	echo '</form>';
	
	mysql_close();
	
	
	
	
	/*
	 * FORM per la modifica di un calendario
	 * nome
	 * unisci con V
	 * elimina
	 */
	
?>