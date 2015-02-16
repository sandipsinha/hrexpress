<?php
require_once "../../dataconn/config.php";
 
$return_arr = array();
 
/* If connection to database, run sql statement. */
if ($conn)
{
  
    //$fetch = mysql_query("select DISTINCT id, concat(last_name,' ',first_name) Name from consultants where concat(last_name,' ',first_name) 
      //            LIKE '%" . mysql_real_escape_string($_GET['term']) . "%'". " limit 20");
    $fetch= mysql_query("select 
    case logger 
             When 'info' then 'Update'
             When 'trace' then 'Add'
             When 'warn'  then 'Add History'
             Else 'Delete'
    End Case 'Audit Action',
    message 'Audit Row',
    logger 'Audit Operatorid,
    timestamp 'Audit Date Stamp'
    from log where name LIKE '%" . mysql_real_escape_string($_GET['term']) . "%'". " limit 20");
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
        $row_array['label'] = $row['Name'];
        $row_array['value'] = $row['Name'];
        $row_array['id'] = $row['id'];
         if($row['Emp_ind'] == 'Y')
         {
             $hdrmsg = 'This person is a regular / full time Employee, so no edits will be allowed';
         }
        $row_array['id'] = $row['id']. ';'. $hdrmsg ;
        
        array_push($return_arr,$row_array);
    }
}
 
/* Free connection resources. */
mysql_close($conn);
 
/* Toss back results as json encoded array. */
echo $return_arr;
?>
