<?php
require_once "../../dataconn/config.php";
 
$return_arr = array();
 
/* If connection to database, run sql statement. */
if ($conn)
{
  
  
    $fetch = mysql_query("select DISTINCT r12_company company,companydescr Name from pol_r12_company  where companydescr LIKE '%" . mysql_real_escape_string($_GET['term']) . "%'". " limit 20");
     
    /* Retrieve and store in array the results of the query.*/
    while ($row = mysql_fetch_array($fetch, MYSQL_ASSOC)) {
        $row_array['label'] = $row['Name'];
        $row_array['value'] = $row['company'];
        
        array_push($return_arr,$row_array);
    }
}
 
/* Free connection resources. */
mysql_close($conn);
 
/* Toss back results as json encoded array. */
echo json_encode($return_arr);
?>
