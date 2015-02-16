<?php

$dbtype="mssql";
$dbuser="hrexpress";
$dbpass="P0lyc0m1";
$dbhost="hrnotify.polycom.com";
$dbname="employees";

$dsn="$dbtype://$dbuser:$dbpass@$dbhost/$dbname";

require_once 'MDB2.php';

$options = array('persistent' => true);

 $mdb2 =& MDB2::factory($dsn, $options);
 
   

if (PEAR::isError($mdb2)) {
    echo ($mdb2->getMessage().' - '.$mdb2->getUserinfo());
}

function getUserData($mdb2) {
    $query ="SELECT * FROM adduser where id='7352'";

    $result = $mdb2->query($query);
    
    // check if the query was executed properly
    if (PEAR::isError($result)) {
        echo ($result->getMessage().' - '.$result->getUserinfo());
        exit();
    }
    
    // fetch all and free the result
    $arr = $result->fetchAll(MDB2_FETCHMODE_ASSOC);
    $result->free();

    $mdb2->disconnect();
    
    return $arr;
}

// Get all users
$users_arr = getUserData($mdb2);
$number_users = count($users_arr);

echo "<table border='1'>";
echo "<tr><td>Host</td><td>User</td><td>Password</td></tr>";
for($i=0;$i<$number_users;$i++){
    echo "<tr><td>".$users_arr[$i]['host']."</td><td>".$users_arr[$i]['user']."</td><td>".$users_arr[$i]['password']."</td></tr>";
}
echo '</table>';

?>
