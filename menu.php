<?php
	session_start();
	$sessionId = session_id();
	if (!isset($_SESSION['codi'])){
		header("location: index.php");
	}
?>
<!DOCTYPE html>
<html lang="ca">
    <head>
    	<meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>MENÚ PRINCIPAL</title>
	</head>
	<body>
    	<header style="height:25px;font-size: 14px;">
			<div style="float: right;">
        		<?php
        			echo $_SESSION['codi'].": <a href='tancarSessio.php'>Tancar sessió</a>";
        		?>
			</div>
		</header>
      	<hr>
		<h1>MENÚ PRINCIPAL</h1>
		<h3><b>Selecciona una operació</b></h3>
        <ul style="list-style-type:none">
            <li><a href="http://zend-cagafu.fjeclot.net/projecte/visualitza.php"><button>Visualització d'usuari</button></a></li>
            <li><a href="http://zend-cagafu.fjeclot.net/projecte/crea.php"><button>Creació d'usuari</button></a></li>
        </ul>
	</body>
</html>