<?php
require_once "../../dataconn/config.php";
 session_start();
$tempid = $_SESSION['id'];
$adddata = $_POST['insertdata'];
$action = $_POST['action'];
$updatedata = $_POST['updatecond'];
if ($tempid == ''){
    header('Location: read_ee.php');
    }
 
if ($action == 'upd')
{
    $stmt_sql = 'Update vendor_contact set '. $updatedata;
   $updt_cons = 'N';
}
else
{
$stmt_sql  = "insert into vendor_contact(effdt,Bill_Rate,Hourly_Rate,id,tempid) values ". $adddata ;
$updt_cons = 'Y';
 }

   $result = mysql_query($stmt_sql);

   if(!$result){
   $data=array('success'=>false,'message'=>mysql_error());
   echo json_encode($data);
   exit;
   }
   else
   {
     $data=array('success'=>true,'message'=>'Data has been successfully saved!' ) ;  
     if ($updt_cons == 'Y')
            {
             $vndr_id = mysql_insert_id(); 
             $stmt_sql  = "update consultants set vendor_id=".$vndr_id ." where id = ". $tempid ;
             if (!mysql_query($stmt_sql)){
                 $data=array('success'=>false,'message'=>mysql_error()) ;
                 }

             }
             
      echo json_encode($data);
    }
    exit();



?>