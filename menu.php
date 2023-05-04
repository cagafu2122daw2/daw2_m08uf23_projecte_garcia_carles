<?php
	session_start();
	$sessionId = session_id();
	if (!isset($_SESSION['codi'])){
		header("location: index.php");
	}
?>
<html>
	<head>
		<title>MENÚ PRINCIPAL</title>
	</head>
	<body>
		<div style="float: right;font-size: 14px;">
    		<?php
    			echo $_SESSION['codi'];
    		?>
    		<br><a href="tancarSessio.php">Tancar sessió</a>
		</div>
		<h1>MENÚ PRINCIPAL</h1>
		<h3><b>Selecciona una operació</b></h3>
        <ul style="list-style-type:none">
            <li><a href="http://zend-cagafu.fjeclot.net/projecte/visualitza.php"><button>Visualització d'usuari</button></a></li>
        </ul>
	</body>
</html>