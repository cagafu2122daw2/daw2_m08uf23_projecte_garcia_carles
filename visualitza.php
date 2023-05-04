<?php
session_start();
$sessionId = session_id();
if (!isset($_SESSION['codi'])){
    header("location: index.php");
}

require 'vendor/autoload.php';
use Laminas\Ldap\Ldap;
ini_set('display_errors',0);
if ($_GET['usr'] && $_GET['ou']){
    $domini = 'dc=fjeclot,dc=net';
    $opcions = [
        'host' => 'zend-cagafu.fjeclot.net',
        'username' => "cn=admin,$domini",
        'password' => 'fjeclot',
        'bindRequiresDn' => true,
        'accountDomainName' => 'fjeclot.net',
        'baseDn' => 'dc=fjeclot,dc=net',
    ];
    $ldap = new Ldap($opcions);
    $ldap->bind();
    $entrada='uid='.$_GET['usr'].',ou='.$_GET['ou'].',dc=fjeclot,dc=net';
    $usuari=$ldap->getEntry($entrada);
    echo "<b><u>".$usuari["dn"]."</b></u><br>";
    foreach ($usuari as $atribut => $dada) {
        if ($atribut != "dn") echo $atribut.": ".$dada[0].'<br>';
    }
}
?>
<html>
    <head>
	    <title>VISUALITZACIÓ D'USUARI</title>	
    </head>
    <body>
    	<div style="float: right;font-size: 14px;">
    		<?php
    			echo $_SESSION['codi'];
    		?>
    		<br><a href="tancarSessio.php">Tancar sessió</a>
    		<br><a href="menu.php">Tornar al menú</a>
		</div>
        <h2>VISUALITZACIÓ D'USUARI</h2>
        <form action="http://zend-cagafu.fjeclot.net/projecte/visualitza.php" method="GET">
            Unitat organitzativa: <input type="text" name="ou"><br>
            Usuari: <input type="text" name="usr"><br>
            <input type="submit"/>
            <input type="reset"/>
        </form>
    </body>
</html>