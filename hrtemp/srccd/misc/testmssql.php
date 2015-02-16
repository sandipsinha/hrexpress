<?php

$dbtype="mssql";
$dbuser="hrexpress";
$dbpass="P0lyc0m1";
$dbhost="10.223.10.171";
$dbname="employees";
// Connect to the database ($dbhost, $dbuser, password)
/*
MSSQL PHP Example

This script will list all the tables in the specified data source.
Replace datasource_name with the name of your data source.
Replace database_username and database_password
with the SQL Server database username and password.
*/
$data_source='linuxtosql';
$user='hrexpress';
$password='P0lyc0m1';

// Connect to the data source and get a handle for that connection.
$conn=odbc_connect($data_source,$user,$password);
if (!$conn){
    if (phpversion() < '4.0'){
        exit("Connection Failed: . $php_errormsg" );
    }
    else{
        exit("Connection Failed:" . odbc_errormsg() );
    }
}

// Retrieves table list.
$result = odbc_tables($conn);

   $tables = array();
   while (odbc_fetch_row($result))
       array_push($tables, odbc_result($result, "TABLE_NAME") );
// Begin table of names.
       echo "Table Count  Table Name\n" .'<br>';
# Create table rows with data.
   foreach( $tables as $tablename ) {
     $tablecount = $tablecount+1;
     echo "$tablecount            $tablename\n";
   }

// Disconnect the database from the database handle.
odbc_close($conn);
?>


