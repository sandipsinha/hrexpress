<?php
$data_source='linuxtosql';
$servername = "hrnotify.polycom.com";
$connectionInfo = array("Database"=>"Employees");
$user='hrexpress';
$password='P0lyc0m1';
// connect to DSN MSSQL with a user and password
$connect = odbc_connect($data_source, $user, $password) or die
  ("couldn't connect");
$result = odbc_exec($connect, "SELECT * from information_schema.tables") or die("Error is " . odbc_error_msg());
while(odbc_fetch_row($result)){
  print(odbc_result($result, "name")  . "<br>\n");
}
odbc_free_result($result);
odbc_close($connect);
?>