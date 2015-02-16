<?php
require_once "../../dataconn/config.php";
 session_start();
$tempid = $_POST['tempid'];
$adddata = $_POST['insertdata'];

if ($tempid == ''){
   $data=array('success'=>false,'message'=>'Without a valid Email, your profile cannot be updated');
   echo json_encode($data);
   exit;
    }
 
    $stmt_sql = 'Update consultants set '. $adddata . " Where  busn_email = '" . $tempid ."'";

    /*$data=array('success'=>true,'message'=>$stmt_sql ) ;
    echo json_encode($data);*/
 
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