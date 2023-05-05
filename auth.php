<?php
require 'vendor/autoload.php';
use Laminas\Ldap\Ldap;

session_start();
$sessionId = session_id();
if (isset($_SESSION['codi'])){
    header("location: menu.php");
}

ini_set('display_errors', 0);
if ($_POST['cts'] && $_POST['adm']){
    $opcions = [
        'host' => 'zend-cagafu.fjeclot.net',
        'username' => "cn=admin,dc=fjeclot,dc=net",
        'password' => 'fjeclot',
        'bindRequiresDn' => true,
        'accountDomainName' => 'fjeclot.net',
        'baseDn' => 'dc=fjeclot,dc=net',
    ];
    $ldap = new Ldap($opcions);
    $dn='cn='.$_POST['adm'].',dc=fjeclot,dc=net';
    $ctsnya=$_POST['cts'];
    try{
        $ldap->bind($dn,$ctsnya);
        
        // Crea una sessió per evitar accedir a una altra pàgina sense estar utenticat
        session_start();
        $_SESSION['codi'] = $_POST['adm'];
        
        header("location: menu.php");
    } catch (Exception $e){
        echo "<b>Contrasenya incorrecta</b><br><br>";
    }
}
?>
<!DOCTYPE html>
<html lang="ca">
    <head>
    	<meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>ERROR D'AUTENTICACIÓ</title>
	</head>
	<body>
		<a href="http://zend-cagafu.fjeclot.net/projecte/index.php">Torna a la pàgina inicial</a>
	</body>
</html>