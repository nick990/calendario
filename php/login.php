<?php
require('/opt/lampp/htdocs/calendar/php/DBfunctions.php');
// recupero i valori passati via POST
//$username = htmlspecialchars($_POST['username'],ENT_QUOTES);
//$password = md5($_POST['password']);
$username=$_POST['username'];
$password = $_POST['password'];

connettiDB("localhost","calendario_db","root","");

// effettuo la query per verificare la correttezza del login
$result = mysql_query("SELECT * FROM utenti WHERE Username = '" . $username . "'");

// verifico che ci siano dei risltati...
if (mysql_num_rows($result) > 0)
{
  $row = mysql_fetch_assoc($result);
  // effettuo la comparazione della password digitata con quella salvata nel DB
  if (strcmp($row['Password'], $password) == 0) {
    // in caso di successo creo la sesione
    $_SESSION['user_id'] = $row['id'];
	if($row['Ruolo']==1){
		$_SESSION['admin']=true;
		
	}
    // e stampo 1 (che identifica il successo)
    echo 1;
  }else{
    // in caso di comparazione non riuscita stampo zero
    echo 0;
  }
}else{
  // se non ci sono risultati stampo zero
  echo 0;
}
?>