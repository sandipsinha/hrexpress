<?php
require_once "../../dataconn/config.php";
$return_arr = array();
if ($conn)
{
 
 
/*$fetch = mysql_query( "select distinct X.pref_name name,X.emplid , X.vp, X.dept,X.location,X.legal_entity,Y.name super,X.division finance,x.r12_company,x.r12_product,x.r12_pol_service,x.r12_pol_region,x.pol_inter_company from employees X,employees Y where   
X.effdt = (select max(c.effdt) from employees c where X.emplid = c.emplid) and X.empl_status in ('A','L','P','S') and X.vp= Y.emplid
AND Y.effdt = (select max(c.effdt) from employees c where Y.emplid = c.emplid) and X.pref_name like '%" . mysql_real_escape_string($_GET['term']) . "%'". " limit 20");*/

$fetch = mysql_query( "select distinct X.pref_name name,X.emplid , X.vp, X.dept,X.location,X.legal_entity,X.finance , X.busn_email,X.r12_company,X.r12_product,X.r12_pol_service,X.r12_pol_region,X.pol_inter_company,X.financial_org
 from employees X where   
X.effdt = (select max(c.effdt) from employees c where X.emplid = c.emplid) and X.empl_status in ('A','L','P','S') 
and X.pref_name like '%" . mysql_real_escape_string($_GET['term']) . "%'". " limit 20");
     
    /* Retrieve and store in array the results of the query.*/
    while ($row = mysql_fetch_array($fetch, MYSQL_ASSOC)) {
        $row_array['label'] = $row['name'];
        $row_array['value'] = $row['name'];
        $row_array['id'] = $row['emplid']. ';'. $row['dept'] . ';' . $row['location'].';'. $row['legal_entity'].';'. $row['name'].';'. $row['busn_email'].';'. $row['r12_company'].';'. $row['r12_product'].';'. $row['r12_pol_service'].';'. $row['r12_pol_region'].';'. $row['pol_inter_company'].';'. $row['finance'].';'. $row['financial_org'];
        
        array_push($return_arr,$row_array);
    }
}
 
/* Free connection resources. */
mysql_close($conn);
 
/* Toss back results as json encoded array. */
echo json_encode($return_arr);
?>
    