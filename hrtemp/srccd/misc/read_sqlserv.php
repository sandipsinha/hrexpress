<?php
/* Specify the server and connection string attributes. */
function connect_sqlsrv(){
//$data_source='linuxtosql';
$servername = "hrnotify.polycom.com:1433";
$connectionInfo = array("Database"=>"Employees");
$user='hrexpress';
$password='P0lyc0m1';

// Connect to the data source and get a handle for that connection.
$conn=mssql_connect($servername,$user,$password);
if( $conn === false )
{
     echo "Unable to connect.</br>";
     die( 'Something went wrong in connect. Error is'. mssql_get_last_message());
}
$db = mssql_select_db("employees",$conn) or die ("Could not select the database");

return $conn;
}


?>
