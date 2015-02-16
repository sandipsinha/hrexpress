<?php
require_once "../../dataconn/config.php";
$email= strtolower($_POST['wemail']);
$phone= strtolower($_POST['wphone']);
$fname=strtolower($_POST['fname']);
$lname=strtolower($_POST['lname']);
$ttype= strtolower($_POST['ttype']);
$classi=strtolower($_POST['classi']);
$btitle=strtolower($_POST['btitle']);
$effdt= strtolower($_POST['effdt']);
$empid=strtolower($_POST['empid']);
$hrid=strtolower($_POST['hrid']);
$vpid= strtolower($_POST['vpid']);
$req=strtolower($_POST['reqnum']);
$bossid=strtolower($_POST['bossid']);
$loc= strtolower($_POST['loc']);
$depid=strtolower($_POST['depid']);
$legal=strtolower($_POST['legal']);
$fin= strtolower($_POST['fin']);
$act=strtolower($_POST['htype']);
$rsn=strtolower($_POST['rsntype']);
$plan_exit_dt = strtolower($_POST['it_end_dt']);
$comments=strtolower($_POST['comments']);

if ($act == 'REH' && $empid = '')
{
    $data=array('success'=>false,'message'=>'This employee is a rehire, but no id could be found');
   echo json_encode($data);
}
else
{
 $data=array('success'=>false,'message'=>'Very Sad');
 $sql = "insert into consultants(first_name,last_name,type,classification,req_num,business_title,location,dept,finance,vp,busn_email, supervisor,it_end_date,hr_contact,busn_phone,legal_entity,comments) values('$fname','$lname','$ttype','$classi','$req','$btitle','$loc','$depid','$fin','$vpid','$email','$bossid','$plan_exit_dt','$hrid','$phone','$legal','$comments')";
}

    $data=array('success'=>true,'message'=>$sql) ;
    echo json_encode($data);    
   /*$result = mysql_query($stmt_sql);

   if(!$result){
   $data=array('success'=>false,'message'=>mysql_error());
   echo json_encode($data);
   exit;
   }
   else
   {
    $data=array('success'=>true,'message'=>'Data has been successfully added!' ) ;
    echo json_encode($data);
    }*/
    exit();


?>