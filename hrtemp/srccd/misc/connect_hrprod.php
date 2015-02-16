<?php
function open_orcl (){
$connorcl = oci_connect('ssinha', 'plcm!23', 'corpprddb10.polycom.com:1521/hrprod');
if (!$connorcl){
     $e = oci_error();
     trigger_error(htmlentities($e['message'],ENT_QUOTES),E_USER_ERROR);
     }
     else
        return $connorcl;
    } 
   ?>