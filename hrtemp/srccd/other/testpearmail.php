<?php
require_once "Mail.php";
 
$from = '"HR Express" <sandip.sinha@polycom.com>';
$to = 'sandip.sinha@polycom.com';

$host = "mailrelay.polycom.com";
$username = 'milpitas\ssinha';
$password = 'tan532!5';

$subject = "test";
$body = "test";

$headers = array ('From' => $from, 'To' => $to,'Subject' => $subject);
$smtp = Mail::factory('smtp', array ('host' => $host, 'auth' => true, 'username' => $username,'password' => $password));

$mail = $smtp->send($to, $headers, $body);

if (PEAR::isError($mail)) {
  echo($mail->getMessage());
} else {
  echo("Message successfully sent!\n");
}

?>
