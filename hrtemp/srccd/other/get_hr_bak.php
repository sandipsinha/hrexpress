<?php
require_once "../../dataconn/config.php";
 
$return_arr = array();
 
/* If connection to database, run sql statement. */
if ($conn)
{
  
    //$fetch = mysql_query("select distinct X.name,X.emplid   from employees X  ");
    
    $fetch = mysql_query("select distinct X.HR_contact name,X.HR_id emplid  from temp_360_vw X  where X.hr_contact LIKE '%" . mysql_real_escape_string($_GET['term']) . "%'". " limit 20");
     
    /* Retrieve and store in array the results of the query.*/
    while ($row = mysql_fetch_array($fetch, MYSQL_ASSOC)) {
        $row_array['label'] = $row['name'];
        $row_array['value'] = $row['name'];
        $row_array['id'] = $row['emplid'];
        
        array_push($return_arr,$row_array);
    }
}
 
/* Free connection resources. */
mysql_close($conn);
 
/* Toss back results as json encoded array. */
echo json_encode($return_arr);
?>