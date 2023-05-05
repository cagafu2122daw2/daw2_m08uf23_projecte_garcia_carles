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
    	<title>INICI</title>
	</head>
	<body>
		<h1>PROJECTE DE GESTIÓ DE BASE DE DADES</h1>
		<h2>PROJECTE DAW2 M08UF2 M08UF3 </h2>
		<a href="http://zend-cagafu.fjeclot.net/projecte/login.php">Inicia sessió</a>
	</body>
</html>