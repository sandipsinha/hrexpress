<?php
//function authenticate($domain,$user, $password) {
   $user = "ssinha";
   $password = "tan532!4";
   $ldapport    = 3268;
    // Active Directory server
    $ldap_host = "10.236.0.62";

    // Active Directory DN
    $ldap_dn = "";

    // Active Directory user group
    $ldap_user_group = "WebUsers";

    // Active Directory manager group
    $ldap_manager_group = "WebManagers";

    // Domain, for purposes of constructing $user
    //$ldap_usr_dom = $domain."\\";
    $ldap_usr_dom = "milpitas\\";

    // connect to active directory
    $ldap = ldap_connect($ldap_host,$ldapport) or die("Could not connect to LDAP server.");

    // verify user and password
    if($bind = @ldap_bind($ldap,  $ldap_usr_dom.$user , $password)) {
        // valid
        // check presence in groups
        $filter = "(sAMAccountName=" . $user . ")";
        //$attr = array("memberof");
        $attr = array("displayName","description","cn","givenName","sn","mail","fdmoperid","mobile","sAMAccountName","displayName","employeenumber");
        $result = ldap_search($ldap, $ldap_dn, $filter, $attr) or exit("Unable to search LDAP server");
        $entries = ldap_get_entries($ldap, $result);
        ldap_unbind($ldap);

        // check groups
      
        for ($i=0; $i<$entries["count"]; $i++) {
            //echo "dn is: ". $entries[$i]["dn"] ."<br />";
            echo "User: ". $entries[$i]["cn"][0] ."<br />";
            if(isset($entries[$i]["mail"][0])) {
                $access=2;
                echo "Email: ". $entries[$i]["mail"][0] ."<br /><br />";
                break;
            } else {
                echo "Email: None<br /><br />";
            }
           }
        if ($access != 0) {
            // establish session variables
            $_SESSION['user'] = $user;
            $_SESSION['access'] = $access;
            //return true;
            echo "User Authenticated successfully";
        } else {
            // user has no rights
            //return false;
          echo  "<br>"."User authentication unsuccessfull";
        }

    } else {
        // invalid name or password
        echo  "<br>"."Invalid credentials";
    }

?>