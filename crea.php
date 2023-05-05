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
	    <title>CREACIÓ D'USUARI</title>	
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
        <h2>CREACIÓ D'USUARI</h2>
        <form action="http://zend-cagafu.fjeclot.net/projecte/crea.php" method="POST">
        	Unitat organitzativa: <input type="text" name="ou"><br>
        	Id d'usuari: <input type="text" name="uid"><br>
        	uidNumber: <input type="number" name="uidn"><br>
        	gidNumber: <input type="number" name="gidn"><br>
        	Directori personal: <input type="text" name="pd"><br>
        	Shell: <input type="text" name="sh"><br>
        	Nom complert: <input type="text" name="cn"><br>
        	Cognom: <input type="text" name="sn"><br>
        	Nom: <input type="text" name="gvnm"><br>
        	Adreça postal: <input type="text" name="adr"><br>
        	Mòbil: <input type="text" name="mbl"><br>
        	Número de telèfon: <input type="text" name="tlf"><br>
        	Títol: <input type="text" name="titl"><br>
        	Descripció: <input type="text" name="des"><br><br>
            <input type="submit"/>
            <input type="reset"/>
        </form><br><br><br>
        <?php
            require 'vendor/autoload.php';
            use Laminas\Ldap\Attribute;
            use Laminas\Ldap\Ldap;
            # uid,ou,uidn,gidn,pd,sh,cn,sn,gvnm,adr,mbl,tlf,titl,des
            if(isset($_POST["uid"], $_POST["ou"], $_POST["uidn"], $_POST["gidn"], $_POST["pd"], $_POST["sh"], $_POST["cn"], $_POST["sn"], $_POST["gvnm"], $_POST["adr"], $_POST["mbl"], $_POST["tlf"], $_POST["titl"], $_POST["des"])){
                $uid=$_POST["uid"];    # uid
                $unorg=$_POST["ou"];   # unitat organitzativa
                $num_id=$_POST["uidn"];   # uidNumber
                $grup=$_POST["gidn"];  # gidNumber
                $dir_pers=$_POST["pd"]; # directori personal
                $sh=$_POST["sh"];    # Shell
                $cn=$_POST["cn"]; # cn
                $sn=$_POST["sn"];    # sn
                $nom=$_POST["gvnm"];  # givenName
                $adressa=$_POST["adr"]; # postalAdress
                $mobil=$_POST["mbl"]; # mobile
                $telefon=$_POST["tlf"];   # telephoneNumber
                $titol=$_POST["titl"];  # title
                $descripcio=$_POST["des"]; # description
                $objcl=array('inetOrgPerson','organizationalPerson','person','posixAccount','shadowAccount','top');
                #
                #Afegint la nova entrada
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
                $nova_entrada = [];
                Attribute::setAttribute($nova_entrada, 'objectClass', $objcl);
                Attribute::setAttribute($nova_entrada, 'uid', $uid);
                Attribute::setAttribute($nova_entrada, 'uidNumber', $num_id);
                Attribute::setAttribute($nova_entrada, 'gidNumber', $grup);
                Attribute::setAttribute($nova_entrada, 'homeDirectory', $dir_pers);
                Attribute::setAttribute($nova_entrada, 'loginShell', $sh);
                Attribute::setAttribute($nova_entrada, 'cn', $cn);
                Attribute::setAttribute($nova_entrada, 'sn', $sn);
                Attribute::setAttribute($nova_entrada, 'givenName', $nom);
                Attribute::setAttribute($nova_entrada, 'mobile', $mobil);
                Attribute::setAttribute($nova_entrada, 'postalAddress', $adressa);
                Attribute::setAttribute($nova_entrada, 'telephoneNumber', $telefon);
                Attribute::setAttribute($nova_entrada, 'title', $titol);
                Attribute::setAttribute($nova_entrada, 'description', $descripcio);
                $dn = 'uid='.$uid.',ou='.$unorg.',dc=fjeclot,dc=net';
                try {
                    $ldap->add($dn, $nova_entrada);
                    header("location: http://zend-cagafu.fjeclot.net/projecte/visualitza.php?ou=".$unorg."&usr=".$uid);
                } catch (Exception $e) {
                    echo "<b>Error al crear l'usuari. Revisa les dades introduïdes.</b>";
                }
            }
        ?>
    </body>
</html>