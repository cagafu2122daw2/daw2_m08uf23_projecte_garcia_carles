<?php
	session_start();
	$sessionId = session_id();
	if (isset($_SESSION['codi'])){
		header("location: menu.php");
	}
?>
<html>
    <head>
    	<title>INICI</title>
	</head>
	<body>
		<h1>PROJECTE DE GESTIÓ DE BASE DE DADES</h1>
		<h2>PROJECTE DAW2 M08UF2 M08UF3 </h2>
		<a href="http://zend-cagafu.fjeclot.net/projecte/login.php">Inicia sessió</a>
	</body>
</html>