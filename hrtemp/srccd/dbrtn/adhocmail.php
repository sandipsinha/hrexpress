<?php
require_once "../../dataconn/config.php";
require_once "rolechk.php";
require_once "Mail.php";

    $mailstr = implode(',',$_POST['mailarr'] );
    
 //   if (1 == 1){
 require_once "Mail.php";

//$mailstr=$mailstr.','.$_POST['hrmgrmail'] ;
//$msg = $msg ."<div style='border:1px solid green;color:blue;'>";
 
 
$from = '"HR Express" <hrnotify@polycom.com>';
$to = 'hrnotify@polycom.com';

$host = "mailrelay.polycom.com";
$username = 'austin\hrnotify';
$password = 'P0lyc0m1';

//$subject = "test";
$reply = "hrnotify@polycom.com";
$content = "text/html;charset=ISO-8859-1\r\n";
$subject = $_POST['subject'];
$headers = array ('From' => $from, 'To' => $mailstr,'Subject' => $subject,'Reply-To'=>$reply,'Content-Type'=>$content);
$smtp = Mail::factory('smtp', array ('host' => $host, 'auth' => true, 'username' => $username,'password' => $password));

$mail = $smtp->send($mailstr, $headers, $_POST['mail_data']);
if ($mailstr > ''){
if (PEAR::isError($mail)) {
        $mailmsg = $mail->getMessage();
        $data=array('success'=>true,'message'=>$mailmsg) ;
        echo json_encode($data);
        exit();
} else {
        $data=array('success'=>true,'message'=>'The mail has been sent ') ;
            //$data=array('success'=>true,'message'=>$stmt_sql ) ;
        echo json_encode($data);
        exit();
}
}
else
{
        $mailmsg = 'No recipient has been selected';
        $data=array('success'=>false,'message'=>$mailmsg) ;
        echo json_encode($data);
        exit();
} 
?>