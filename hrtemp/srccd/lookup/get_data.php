<?php
require_once "../../dataconn/config.php";
 
$return_arr = array();
 
/* If connection to database, run sql statement. */
if ($conn)
{
    $fetch = mysql_query("select DISTINCT id,fin_desc from finance  where fin_desc like '%" . mysql_real_escape_string($_GET['term']) . "%'");
    $fetch = mysql_query("select DISTINCT emplid id,name from employees where name like ' 1320%" . mysql_real_escape_string($_GET['term']) . "%'". " limit 1"); 
     
     
    /* Retrieve and store in array the results of the query.*/
    while ($row = mysql_fetch_array($fetch, MYSQL_ASSOC)) {
        /*$row_array['label'] = $row['fin_desc'];
        $row_array['value'] = $row['fin_desc'];*/
        /*$row_array['value'] = $row['state'];
        $row_array['abbrev'] = $row['abbrev'];*/
        $row_array['label'] = $row['dept']
        $row_array['value'] = $row['emplid'];
         
        array_push($return_arr,$row_array);
    }
}
 
/* Free connection resources. */
mysql_close($conn);
 
/* Toss back results as json encoded array. */
echo json_encode($return_arr);
?>