<?php
require_once(dirname(__FILE__).'/adLDAP/src/adLDAP.php');
$adldap = new adLDAP();
$username = 'milpitas\esinha';
$password = 'tan532!4';
$authUser = $adldap->user()->authenticate($username,$password);
if ($authUser ==true){
    echo "User Authenticated successfully";
    }
else
   {
       echo $adldap->getLastError();
       echo  "User authentication unsuccessfull";
    }
?>
    