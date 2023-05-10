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
         <?php 
            require 'vendor/autoload.php';
            use Laminas\Ldap\Attribute;
            use Laminas\Ldap\Ldap;
            
            ini_set('display_errors', 0);
            #
            # Atribut a modificar --> Número d'idenficador d'usuari
            #
            $atribut='uidNumber'; # El número identificador d'usuar té el nom d'atribut uidNumber
            $nou_contingut=2017;
            #
            # Entrada a modificar
            #
            #$uid = 'usr2';
            #$unorg = 'usuaris';
            #$dn = 'uid='.$uid.',ou='.$unorg.',dc=fjeclot,dc=net';
            #
            #Opcions de la connexió al servidor i base de dades LDAP
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
            #
            $ldap = new Ldap($opcions);
            $ldap->bind();
            
            $uid = 'sysadmin';
            $unorg = 'administradors';
            $dn = 'uid='.$uid.',ou='.$unorg.',dc=fjeclot,dc=net';
            
            $entrada = $ldap->getEntry($dn);
            if ($entrada){
                Attribute::setAttribute($entrada,$atribut,$nou_contingut);
                $ldap->update($dn, $entrada);
            } else echo "<b>Aquesta entrada no existeix</b><br><br>";
            
            #$ldap = new Ldap($opcions);
            #$ldap->bind();
            
            $uid = 'sysdev';
            $unorg = 'desenvolupadors';
            $dn = 'uid='.$uid.',ou='.$unorg.',dc=fjeclot,dc=net';
            
            $entrada = $ldap->getEntry($dn);
            if ($entrada){
                Attribute::setAttribute($entrada,$atribut,$nou_contingut);
                $ldap->update($dn, $entrada);
            } else echo "<b>Aquesta entrada no existeix</b><br><br>";
            
            #$ldap = new Ldap($opcions);
            #$ldap->bind();
            
            $uid = 'webdev';
            $unorg = 'desenvolupadors';
            $dn = 'uid='.$uid.',ou='.$unorg.',dc=fjeclot,dc=net';
            
            $entrada = $ldap->getEntry($dn);
            if ($entrada){
                Attribute::setAttribute($entrada,$atribut,$nou_contingut);
                $ldap->update($dn, $entrada);
                echo "sysadmin sysdev y webdev modificats";
            } else echo "<b>Aquesta entrada no existeix</b><br><br>";
        ?>

    </body>
</html>