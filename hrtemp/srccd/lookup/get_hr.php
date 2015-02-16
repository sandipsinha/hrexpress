<?php
require_once "../../dataconn/config.php";
 
$return_arr = array();
 
/* If connection to database, run sql statement. */
if ($conn)
{
  
    $fetch = mysql_query("select distinct x.pref_name name,x.emplid ,x.busn_email   from employees x where x.effdt=(SELECT max(c.effdt) from employees c where x.emplid=c.emplid) and x.empl_status in ('A','L','P','S') 
   and substring(x.dept,1,4) in ('7300','7301','7302') AND x.pref_name like '%".mysql_real_escape_string($_GET['term'])."%'"." order by 1 limit 20");
    
    
     
    /* Retrieve and store in array the results of the query.*/
    while ($row = mysql_fetch_array($fetch, MYSQL_ASSOC)) {
        $row_array['label'] = $row['name'];
        $row_array['value'] = $row['name'];
        $row_array['id'] = $row['emplid'].';'.$row['busn_email'];
        
        array_push($return_arr,$row_array);
    }
}
 
/* Free connection resources. */
mysql_close($conn);
 
/* Toss back results as json encoded array. */
echo json_encode($return_arr);
?>