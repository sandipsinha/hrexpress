<?php

 //set_include_path(get_include_path().';'.dirname(__DIR__).'\php\dbconnect\');


function returncounts($table_sql,array $values = array())
{
 include ("read_sqlserv.php");
 $row_cnt = 0;

/*Execute the query with a scrollable cursor so
  we can determine the number of rows returned.*/
$cursorType = array('Scrollable' => SQLSRV_CURSOR_KEYSET);

//var_dump($values);
//echo '<br>'.count($values);

 $params = '\'0000\'';

if (count($values) > 1)
  {
   //echo '<br>'.' Before truncate is 1'. $params;
   foreach ($values as $item) {
      //echo '<br>'.' Before truncate is 3 '. $params;
      //foreach ($col as $item)
       {
       $params = $params . ',\''.$item .'\'';
       //echo '<br>'.' Before truncate is '. $params;
       }
       }
  
   $params = substr($params,7);
   }
else
  {
   $params = '\''.$values[0].'\'';
    //echo '<br>'.' Before truncate is 2'. $params .'*' . $values[0].'*'.$values[1];
  }


$params_a = array($params);
$params = '('. $params .')';
//echo '<br>'.' The value in retruncount is '. $params;
 
if ($table_sql == "Departments")
   {
    $sql_stmt= 'Select count(*) deptnum from employees.dbo.dept where department in ' . $params;
   }
  elseif ($table_sql == "Finance")
     {
      $sql_stmt = 'Select count(*) divcnt from employees.dbo.finance where description  in ' . $params ;
     }
  elseif ($table_sql == "Legal Entity")
     {
      $sql_stmt = 'Select count(*) divcnt from employees.dbo.Legal_Entity where legal_entity_name  in ' . $params ;
     }
  elseif ($table_sql == "Employees")
     {
      $sql_stmt = 'Select count(distinct employee_id) divcnt from employees.dbo.AddUser where employee_id  in ' . $params ;
     }
//echo 'The parameter passed in returncounts is ' . $sql_stmt;
$conn = connect_sqlsrv();
$getRows = sqlsrv_query($conn, $sql_stmt, $params_a, $cursorType);

if ( $getRows === false)
{ echo "The fecth did not work";
die( 'The fetch did not work properly '. sqlsrv_errors()  );
}

if( sqlsrv_fetch( $getRows ) === false) {
     echo "The fecth did not work";
     die( print_r( sqlsrv_errors(), true));
}

$row_cnt = sqlsrv_get_field( $getRows, 0);
echo 'The value is ' . $row_cnt;

if($row_cnt> 0)
  {
  sqlsrv_free_stmt( $getRows );
  sqlsrv_close( $conn );
  $rowCount = 0;
  return $row_cnt;
  }
else
  return 0;

}
?>
