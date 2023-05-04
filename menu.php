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
		<h2>MENÚ PRINCIPAL</h2>
		<h3><b>En construcció!!!!!!!!!!!</b></h3>
		<a href="http://zend-cagafu.fjeclot.net/projecte/index.php">Torna a la pàgina inicial</a>
	</body>
</html>