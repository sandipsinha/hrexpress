<?php
require ("class.phpmailer.php");
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Host="mailrelay.polycom.com";
$mail->SMTPAuth=true;
$mail->Username ="ssinha";
$mail->Password="tan532!5";
$mail->From="sandip.sinha@polycom.com";
$mail->AddAddress("sandip.sinha@polycom.com","Sandip SInha");
$mail->WordWrap=50;
$mail->IsHTML(true);
$mail->Subject = "Test email";
$mail->Body= "Hello This is just a test";

if (!$mail->Send())
{
    echo "Message could not be sent. <p>";
    echo "Mailer Error: ". $mail->ErrorInfo;
    exit;
   }
   echo "Messaages have been sent";
?>