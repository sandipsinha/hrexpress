<?php
set_time_limit(30);
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
ini_set('display_errors',1);

// config
$ldapserver = '10.236.0.62';
$ldapport    = 3268;
$ldapuser      = 'milpitas\\ssinha'; 
$ldappass     = 'tan532!4';
$ldaptree    = "";

$domain        = '@myDomain.com';

// connect
$ldapconn = ldap_connect($ldapserver,$ldapport) or die("Could not connect to LDAP server.");

if($ldapconn) {
    // binding to ldap server
    $ldapbind = ldap_bind($ldapconn, $ldapuser, $ldappass) or die ("Error trying to bind: ".ldap_error($ldapconn));
    // verify binding
    if ($ldapbind) {
        echo "LDAP bind successful...<br /><br />";
   $attributes_ad = array("displayName","description","cn","givenName","sn","mail","fdmoperid","mobile","sAMAccountName","displayName","employeenumber");
 // define base
   $base ="";
  $result = ldap_search($ldapconn, $base, "mail=vish*", $attributes_ad) or die ("Error in search query");

 

       
        //$result = ldap_search($ldapconn,$ldaptree, "(sAMAccountName=Wayne)") or die ("Error in search query: ".ldap_error($ldapconn));
        $data = ldap_get_entries($ldapconn, $result);
       
        // SHOW ALL DATA
        echo '<h1>Dump all data</h1><pre>';
        echo '<pre>';
        print_r($data);   
        echo '</pre>';
       
        // iterate over array and print data for each entry
        echo '<h1>Show me the users</h1>';
        for ($i=0; $i<$data["count"]; $i++) {
            //echo "dn is: ". $data[$i]["dn"] ."<br />";
            echo "User: ". $data[$i]["cn"][0] ."<br />";
            if(isset($data[$i]["mail"][0])) {
                echo "Email: ". $data[$i]["mail"][0] ."<br /><br />";
            } else {
                echo "Email: None<br /><br />";
            }
        }
        // print number of entries found
        echo "Number of entries found: " . ldap_count_entries($ldapconn, $result);
    } else {
        echo "LDAP bind failed...";
    }

}

// all done? clean up
ldap_close($ldapconn);
?>