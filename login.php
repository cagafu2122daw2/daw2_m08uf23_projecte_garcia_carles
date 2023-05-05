<?php
    session_start();
    $sessionId = session_id();
    if (isset($_SESSION['codi'])){
        header("location: menu.php");
    }
?>
<!DOCTYPE html>
<html lang="ca">
    <head>
    	<meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>INICI DE SESSIÓ</title>
	</head>
	<body>
		<h3>Introdueix les teves dades</h3>
		<form action="http://zend-cagafu.fjeclot.net/projecte/auth.php" method="POST">
			Usuari amb permisos d'administració LDAP: <input type="text" name="adm"><br>
			Contrasenya de l'usuari: <input type="password" name="cts"><br><br>
			<input type="submit" value="Envia" />
			<input type="reset" value="Neteja" />
		</form>
	</body>
</html>