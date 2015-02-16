<?php
require_once "../../dataconn/config.php";
$return_arr = array();
 
if ($conn)
{

//$sql = "select distinct a.vp vp,b.name name from employees a,employees b where a.vp=b.emplid and b.name LIKE '%$q%'";
$fetch = mysql_query("select distinct vp from temp_360_vw where vp LIKE '%" . mysql_real_escape_string($_GET['term']) . "%'". " limit 20");

    while ($row = mysql_fetch_array($fetch, MYSQL_ASSOC)) {
	        $row_array['label'] = $row['vp'];
        $row_array['value'] = $row['vp'];
        $row_array['id'] = $row['vp'];
	  array_push($return_arr,$row_array);
}
}
 
/* Free connection resources. */
mysql_close($conn);
 
/* Toss back results as json encoded array. */
echo json_encode($return_arr);
?>


