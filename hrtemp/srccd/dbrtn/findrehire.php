<?php
require_once "../../dataconn/config.php";
$q = strtolower($_POST['emailid']);

if (!$q) return;
 
$sql = "select distinct X.last_name,X.first_name , X.id, X.dept,X.location,X.legal_entity,X.supervisor,X.classification,X.finance,X.vp,X.id from consultants X where   
X.effdt = (select max(c.effdt) from consultants c where X.id = c.id)  and X.busn_email like '%$q%'";
 

$rsd = mysql_query($sql);
$row = 0;
while($rs = mysql_fetch_array($rsd)) {
    $data=array('success'=>true,'fname'=>$rs['first_name'],'lname'=>$rs['first_name'],'dept'=> $rs['dept'],'location'=> $rs['location'],
    'legal'=> $rs['legal_entity'],'finance'=> $rs['finance'],'vp'=> $rs['vp'],'id'=> $rs['id'],'boss'=> $rs['supervisor'],'hrid'=> $rs['hr_contact'],'btitle'=> $rs['business_title'] );
    $row +=1;
}
if ($row == 0){
    $data=array('success'=>false,'message'=>'Consultant is still active or this email could not be used','row'=> $q);
   }
    
echo json_encode($data);

?>