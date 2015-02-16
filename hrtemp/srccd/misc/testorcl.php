<?php

 //set_include_path(get_include_path().';'.dirname(__DIR__).'\php\dbconnect\');

 include ("read_sqlserv.php");
 $row_cnt = 0;

/*Execute the query with a scrollable cursor so
  we can determine the number of rows returned.*/
$cursorType = array('Scrollable' => SQLSRV_CURSOR_KEYSET);

//var_dump($values);
//echo '<br>'.count($values);

 $params = '1202%';

$conn= connect_sqlsrv();
/*echo '<br>'.' The value in retruncount is '. $params;*/
 

$sql_stmt= "Select * from employees.db.vp" ;
$result = mssql_query($sql_stmt);
echo 'The statement is ' . $sql_stmt;
// Connect to the data source and get a handle for that connection.

While($row=mssql_fetch_assoc($result))
{
 print_r($row);
 }
mssql_close($conn);

?>