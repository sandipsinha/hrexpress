<?php
 require_once('Logger.php');
require_once "../../dataconn/config.php";
require_once "Mail.php";
Logger::configure('../../includes/config.xml');

$updtstr= $_POST['updtstr'];
$updatekey = $_POST['update'];
$act = strtolower($_POST['action']);
$adddata = $_POST['insertdata'];
$temp_id = strtolower($_POST['id']);
session_start();
$tempid = $_SESSION['emplid'];
$log = Logger::getLogger($tempid);

 $mailmsg = 'fail';
if ($act == 'upd')
{
    $stmt_sql = 'Update consultants set '. $updtstr . ' Where id = ' . $temp_id ;
    $log->info($updtstr);
}
elseif ($act == 'hir')
{

 
 $stmt_sql = "select * from consultants where  busn_email = '". $_POST['emailid'] ."'" ;
 $result = mysql_query($stmt_sql);
   if(mysql_num_rows($result)){
   $data=array('success'=>False,'message'=>'A person with the same email already exists in the system');
   echo json_encode($data);
   exit;
   }

//$stmt_sql  = "insert into consultants(first_name,last_name,effdt,type,action_type,reason,classification,req_num,business_title,location,dept,finance,financial_org,vp,busn_email, supervisor,it_end_date,hr_contact,busn_phone,legal_entity,comments) values ". $adddata ;
$stmt_sql  = "insert into consultants(first_name,last_name,effdt,type,action_type,reason,classification,req_num,business_title,location,dept,finance,financial_org,busn_email, supervisor,it_end_date,hr_contact,busn_phone,legal_entity,remote,Bill_Rate,Hourly_Rate,vendor_id,comments,r12_company,r12_product,r12_pol_service,r12_pol_region,pol_inter_company) values ". $adddata ;



 }
 else
 {
    //$stmt_sql  = "insert into consultants(id,first_name,last_name,effdt,type,action_type,reason,classification,req_num,business_title,location,dept,finance,financial_org,vp,busn_email, supervisor,it_end_date,hr_contact,busn_phone,legal_entity,comments,emplid) values ". $adddata ; 
    $stmt_sql  = "insert into consultants(id,first_name,last_name,effdt,type,action_type,reason,classification,req_num,business_title,location,dept,finance,financial_org,busn_email, supervisor,it_end_date,hr_contact,busn_phone,legal_entity,comments,emplid,vendor_id,remote,Bill_Rate,Hourly_Rate,r12_company,r12_product,r12_pol_service,r12_pol_region,pol_inter_company) values ". $adddata ; 

 }


  $result = mysql_query($stmt_sql);
  if ($act == 'hir'){
     
     $temp_id = mysql_insert_id();   
     $_SESSION['id'] = $temp_id ;
     }
   if(!$result){
   //$data=array('success'=>true,'message'=>'Data could not be updated');
   $data=array('success'=>true,'message'=>$stmt_sql);
   echo json_encode($data);
   exit;
   }
   else
   {
      
     if ($_POST['mail'] != 'Y')	{
    	    $data=array('success'=>true,'message'=>'Data has been saved ') ;
            //$data=array('success'=>true,'message'=>$stmt_sql ) ;
            echo json_encode($data);
            exit();
    	}	
    require_once "sendmail.php"; //begin inline code        
    
  if ($mailmsg != 'success' and $_POST['mail'] == 'Y')	{
    	    //$data=array('success'=>true,'message'=>'Data has been successfully saved but mail was not sent' ) ;
            $data=array('success'=>true,'message'=>$mailmsg ) ;
            echo json_encode($data);
            exit();
    	}
    if ($mailmsg == 'success' and $_POST['mail'] == 'Y')	{
            $data=array('success'=>true,'message'=>'Data has been saved and mail was sent' ) ;
          echo json_encode($data);
          exit();
    	}
     
    } 



?>