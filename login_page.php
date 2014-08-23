<html>
	<head>
		<link rel="stylesheet" type="text/css" href="styles/login.style.php"/>
		<?php
		require("php/link_CSS.php");
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
		<div class="form_container">
			<form method="post" id="login_form" />
				<div>
				 	<label for="username">Username</label>
					<input name="username" type="text" id="username" maxlength="15" size="15"/>
			 	</div>
			 	<div>
				 	<label for="password">Password</label>
				 	<input name="password" type="password" id="password" maxlength="15" size="15"/>
			  	</div>
			  	<input type="submit" id="submit" value="LOGIN" />
			
			</form>
			<div id="error_message"></div>
		</div>
		<script type="text/javascript">
		
			$("#login_form").submit(function() {
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