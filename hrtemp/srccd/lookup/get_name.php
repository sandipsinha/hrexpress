<?php
require_once "../../dataconn/config.php";
 
$return_arr = array();
 
/* If connection to database, run sql statement. */
if ($conn)
{
  
    //$fetch = mysql_query("select DISTINCT id, concat(last_name,' ',first_name) Name from consultants where concat(last_name,' ',first_name) 
      //            LIKE '%" . mysql_real_escape_string($_GET['term']) . "%'". " limit 20");
    $fetch= mysql_query("select DISTINCT id, concat(last_name,' ',first_name) Name,'N' Emp_ind,'temp' emp_type from consultants where concat(last_name,' ',first_name) 
                  LIKE '%" . mysql_real_escape_string($_GET['term']) . "%'". " union select emplid id,   name Name,'Y' Emp_ind,'reg' emp_type from emp_current_vw where name LIKE '%" . mysql_real_escape_string($_GET['term']) . "%'". "order by 2 limit 20");
    $hdrmsg = 'Click on the button to edit the Contractor details';
   /*  if (!mysql_num_rows($fetch) ) 
         {  
         $sqlst = "select emplid id,   name 'Name' from emp_current_vw where name LIKE '%" . mysql_real_escape_string($_GET['term']) . "%'". " limit 20";
        $fetch = mysql_query($sqlst);
        $hdrmsg = 'This person is a regular / full time Employee, so no edits will be allowed';
        if (!mysql_num_rows($fetch) )
            {
             die("Query to show fields from table failed");
            }
         }*/
         if (!mysql_num_rows($fetch) ) 
         {
            die("Query to show fields from table failed");
         }
         
     
    /* Retrieve and store in array the results of the query.*/
    while ($row = mysql_fetch_array($fetch, MYSQL_ASSOC)) {
        $row_array['label'] = $row['Name']. '  Employee Type-'. $row['emp_type'];
        $row_array['value'] = $row['Name'];
        $row_array['id'] = $row['id'];
             
        $row_array['id'] = $row['id']. ';'. $row['Emp_ind'];
        
        array_push($return_arr,$row_array);
    }
}
 
/* Free connection resources. */
mysql_close($conn);
 
/* Toss back results as json encoded array. */
echo json_encode($return_arr);
?>
