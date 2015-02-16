<?php
require_once "../../dataconn/config.php";
 session_start();
$adddata = $_POST['insertdata'];
$action = $_POST['action'];
$updatedata = $_POST['updatecond'];
 
if ($action == 'upd')
{
    $stmt_sql = 'Update vendor set '. $updatedata;
   $updt_cons = 'N';
}
else
{
$stmt_sql  = "insert into vendor(name,contact_name,effdt,contact_tel,contact_email,comments) values ". $adddata ;
 
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
      echo json_encode($data);
    }
    exit();



?>