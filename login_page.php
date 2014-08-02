<html>
	<head>
		<?php
		/*
		 * Se l'utente che tenta di accedere alla pagina di login è già loggato
		 * viene sloggato e poi ritorna a questa pagina
		 */
		 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
		 if (isset($_SESSION['user_id'])) {
		  		require 'php/logout.php';
			}	
		?>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	</head>
	<body>
		<form method="post" id="login_post" />
		 	<label for="username">Username</label>
			<input name="username" type="text" id="username" maxlength="10" style="width: 250px"/>
		 	<label for="password">Password</label>
		 	<input name="password" type="password" id="password" maxlength="10" style="width: 250px"/>
		  	<input type="submit" id="submit" value="Login" />
		</form>
		<div id="error_message"></div>
		<script type="text/javascript">
			$("#login_post").submit(function() {
			  // passo i dati (via POST) al file PHP che effettua le verifiche 
			  $.post("php/login.php", { username: $('#username').val(), password: $('#password').val()}, function(risposta) {
			  
			  	
			    // se i dati sono corretti...
			    if (risposta == 1) {
			 	// se, invece, i dati non sono corretti...posso gestire diversi messaggi di errore con diversi valore per risposta
			    document.location='admin_tool.php';
			    }else{
			    	
			    	$('#error_message').text('Username/Password errati!');
			    	$('#username').val('');
			    	$('#password').val('');
			    }
			   $('#username').focus(function(){
			   		$('#error_message').text('');
			   });
			   $('#password').focus(function(){
			   		$('#error_message').text('');
			   });
			  });
			  
			  // evito il submit del form (che deve essere gestito solo dalla funzione Javascript)
			  return false;
			});
	</script>
	</body>
	
</html>