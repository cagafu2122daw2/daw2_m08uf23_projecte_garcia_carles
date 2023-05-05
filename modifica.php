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
	    <title>MODIFICACIÓ D'USUARI</title>	
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
        <h2>MODIFICACIÓ D'USUARI</h2>
        <form action="http://zend-cagafu.fjeclot.net/projecte/modifica.php" method="POST">
        	Selecciona l'usuari a modificar:<br>
            Unitat organitzativa: <input type="text" name="ou"><br>
            Id d'usuari: <input type="text" name="uid"><br>
            <br>
            Selecciona el camp a modificar:<br>
            <input type="radio" name="camp" value="uidNumber"> uidNumber<br>
            <input type="radio" name="camp" value="gidNumber"> gidNumber<br>
            <input type="radio" name="camp" value="homeDirectory"> Directori personal<br>
            <input type="radio" name="camp" value="loginShell"> Shell<br>
            <input type="radio" name="camp" value="cn"> Nom complert<br>
            <input type="radio" name="camp" value="sn"> Cognom<br>
            <input type="radio" name="camp" value="givenName"> Nom<br>
            <input type="radio" name="camp" value="postalAddress"> Adreça postal<br>
            <input type="radio" name="camp" value="mobile"> Mòbil<br>
            <input type="radio" name="camp" value="telephoneNumber"> Número de telèfon<br>
            <input type="radio" name="camp" value="title"> Títol<br>
            <input type="radio" name="camp" value="description"> Descripció<br>
            <br>
            Nou valor: <input type="text" name="nou_valor"><br>
            <input type="submit"/>
            <input type="reset"/>
        </form><br><br><br>        
        <?php
            require 'vendor/autoload.php';
            use Laminas\Ldap\Attribute;
            use Laminas\Ldap\Ldap;
            ini_set('display_errors', 0);
            if(isset($_POST["uid"],$_POST["ou"],$_POST["camp"],$_POST["nou_valor"])){
                $atribut=$_POST["camp"];
                $nou_contingut=$_POST["nou_valor"];
                if ($atribut=="uidNumber"||$atribut=="gidNumber") $nou_contingut=(int)$nou_contingut;
                #
                # Entrada a modificar
                #
                $uid = $_POST["uid"];
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
                # Modificant l'entrada
                $ldap = new Ldap($opcions);
                $ldap->bind();
                $entrada = $ldap->getEntry($dn);
                if ($entrada){
                    Attribute::setAttribute($entrada,$atribut,$nou_contingut);
                    $ldap->update($dn, $entrada);
                    echo "Atribut modificat";
                    header("location: http://zend-cagafu.fjeclot.net/projecte/visualitza.php?ou=".$unorg."&usr=".$uid);
                } else echo "<b>Aquesta entrada no existeix. Revisa les dades introduïdes</b>";
            }
        ?>
    </body>
</html>