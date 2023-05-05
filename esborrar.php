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
	    <title>ESBORRAMENT D'USUARI</title>	
    </head>
    <body>
    	<header style="height:25px;font-size: 14px;">
			<div style="float: right;">
        		<?php
        		  echo $_SESSION['codi'].": <a href='tancarSessio.php'>Tancar sessió</a>";
        		?>
			</div>
            <div style="float: left;">
        		<a href="menu.php">Tornar al menú</a>
			</div>
		</header>
      	<hr>
        <h2>ESBORRAMENT D'USUARI</h2>
        <form action="http://zend-cagafu.fjeclot.net/projecte/esborrar.php" method="POST">
            Unitat organitzativa: <input type="text" name="ou"><br>
            Id d'usuari: <input type="text" name="usr"><br>
            <input type="submit"/>
            <input type="reset"/>
        </form><br><br><br>
        <?php
            require 'vendor/autoload.php';
            use Laminas\Ldap\Ldap;
            ini_set('display_errors', 0);
            if(isset($_POST["usr"],$_POST["ou"])){
                $uid = $_POST["usr"];
                $unorg = $_POST["ou"];
                $dn = 'uid='.$uid.',ou='.$unorg.',dc=fjeclot,dc=net';
                $opcions = [
                    'host' => 'zend-cagafu.fjeclot.net',
                    'username' => 'cn=admin,dc=fjeclot,dc=net',
                    'password' => 'fjeclot',
                    'bindRequiresDn' => true,
                    'accountDomainName' => 'fjeclot.net',
                    'baseDn' => 'dc=fjeclot,dc=net',
                ];
                #
                # Esborrant l'entrada
                $ldap = new Ldap($opcions);
                $ldap->bind();
                try{
                    $ldap->delete($dn);
                    echo "<b>Entrada esborrada</b><br>";
                } catch (Exception $e){
                    echo "<b>Aquesta entrada no existeix. Revisa les dades introduïdes</b><br>";
                }
            }
        ?>
    </body>
</html>