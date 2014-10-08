
<html>
	<head>		
			<link rel="stylesheet" type="text/css" href="styles/admin.style.php"/>
			<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
			<script type="text/javascript" src="js/jsfun.js"></script>
			<script type="text/javascript" src="js/admin_tool/calendar_editor_popup.js"></script> 
			<script type="text/javascript" src="js/event_popup.js"></script>
			<script type="text/javascript" src="js/admin_tool/new_event_popup.js"></script>
			<script type="text/javascript" src="js/admin_tool/event_editor.js"></script>			
	</head>
	<body>
		<?php
			require "php/session_initial.php";
			require 'php/link_CSS.php';
			if (isset($_SESSION['user_id'])&&empty($_SESSION['admin'])) {
		  		echo "Solo gli utenti amministratori possono accedere a questa pagina";
				echo "<a id='logout_button' href='javascript:logout()'>LOGOUT</a>";
		  		exit;
			}
			if (empty($_SESSION['user_id'])) {
		  		echo "Devi effettuare il <a href='login_page.php'>login</a> per accedere a questa pagina";
		  		exit;
			}	
		?>
		ADMIN TOOL
		<br />
		<a id="logout_button" href="javascript:logout()">LOGOUT</a>
		<br />
		<div class='editor'></div>		
		<script type="text/javascript">		
				getCalendarForAdmin();
		</script>	
	</body>
</html>
