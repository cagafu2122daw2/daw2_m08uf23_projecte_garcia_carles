<?php
session_start();
$sessionId = session_id();
if (isset($_SESSION['codi'])){
    header("location: menu.php");
}
?>
<html>
	<head>
		<title>INICI DE SESSIÓ</title>
	</head>
	<body>
		<h3>Introdueix les teves dades</h3>
		<form action="http://zend-cagafu.fjeclot.net/projecte/auth.php" method="POST">
			Usuari amb permisos d'administració LDAP: <input type="text" name="adm"><br>
			Contrasenya de l'usuari: <input type="password" name="cts"><br>
			<input type="submit" value="Envia" />
			<input type="reset" value="Neteja" />
		</form>
	</body>
</html>