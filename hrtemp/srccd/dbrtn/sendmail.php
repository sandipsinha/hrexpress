<?php
require_once "../../dataconn/config.php";
require_once "rolechk.php";
if ($_POST['mail'] == 'Y'){
    $mailstr = implode(',',$_POST['mailarr'] );
    
 //   if (1 == 1){
 require_once "Mail.php";
$msg1 = "<p style='color:red' id='content'>Personal and Confidential<br><br>";
/*$msg2 = "<p style='color:red' id='content'>Personal and Confidential<br><br>The following individual has been terminated in the system. Here are the details you need in order to complete your responsibilities</p>";*/

//if ($act == 'hir'){
$sql = "select * from temp_360_vw where id = ". $temp_id ;
//}
/*echo $sql; The following individual has accepted our offer of employment. Here are the details you need in order to complete your responsibilities</p>*/

$rsq = mysql_query($sql);
if (!$rsq) {
    die("Query to show fields from table failed");
}
$row = mysql_fetch_assoc($rsq);
$ndanote = ' ';
  //echo 'Success ', substr($row['legal_entity'],0,5);
if ($row['Action_type'] == 'hir') { 
        switch(substr($row['Legal_Entity'],0,5))
                  {
            case 'USAOP':
                    $nda = 'http://planetpolycom/sites/hr/Documents/North%20America/Documents%20and%20Forms/FORM%20Mutual%20NDA%206.7.12.pdf';
                      break;
             case 'INDSG':
                    $nda = 'http://planetpolycom/sites/hr/Documents/APAC/APAC%20Unilateral%20NDA%20-%20210809.doc';
                      break;
              default:
                    $nda = 'n';
                      break;
                    }
             }       
  else
            {
                $nda = 'n';
            }
            
switch ($row['Action_type'])
      {
case 'hir': 
        $msg = $msg1. ' '.$row['Last_Name'] . ' '.$row['First_Name'] . ' will be joining Polycom as a '. $row['Type_Descr']. '<br>'.'Here are the details you will need to complete your responsibiities.'. '</p>'; 
        $subject = 'HR Temp Update :'. $row['Last_Name'] . ' '.$row['First_Name'] .' -Hire';  
        $footmsg = "<span style='color:red' id='content'>*Manager</span> - It is critical that you inform HR when the consultant-contractor no longer requires access to our systems.";
        break;
case 'ter':
        $msg = "<p style='color:red' id='content'>Personal and Confidential</p><br><br>Please be advised that ". $row['First_Name'] . ' '.$row['Last_Name'] ."'s employment with Polycom 
                      will end on ". $row['IT_End_Date'] .".";
        $subject = 'HR Temp Update :'. $row['Last_Name'] . ' '.$row['First_Name'] .' -Termination';  
        $footmsg= $footmsg. "Please take the necessary actions effective COB on the termination date (i.e., voicemail, access to the network, unescorted access to the building, etc.) 
                          to ensure terminated employees do not have access to the  network, building or company assets." ;
        break;
default:
        $msg = "<p style='color:red' id='content'>Personal and Confidential<br><br>HR Update For: - ". $row['First_Name'] . ' '.$row['Last_Name'] . '</p>';
        $subject = 'HR Temp Update :'. $row['Last_Name'] . ' '.$row['First_Name'] .' -Data Change';  
        break;
         }
if ($nda != 'n')
   {
    $footmsg = $footmsg . 'Please have the new consultant complete and sign the Non-Disclosure Agreement on the first day(see link below). 
                              Please retain a copy for your records and forward the original to the local HR department.';
    }
$mailstr=$mailstr.','.$row['mgr_email'];
//$msg = $msg ."<div style='border:1px solid green;color:blue;'>";

$msg = $msg ."<table border='5px' style='border:1px solid green;color:blue;'>";
$msg = $msg ."<tr><td>";
$msg = $msg . 'Name : '. '</td><td>' . $row['Last_Name'] .','.$row['First_Name']; 
$msg = $msg ."</td></tr><tr><td>";
if ($row['Action_type'] == 'hir'){
    $msg = $msg .'Requisition #:</td><td>'. $row['Requisition_Number'];
    $msg = $msg ."</td></tr><tr><td>";   
}
$msg = $msg .'Start Date:'.'</td><td>'. $row['start_date'];
$msg = $msg ."</td></tr><tr><td>" ;

//if ($row['Action_type'] != 'hir'){
 $msg = $msg ."</td></tr><tr><td>";   
$msg = $msg .'End Date:'.'</td><td>'. $row['IT_End_Date'] ;
$msg = $msg ."</td></tr><tr><td>";
//}
$msg = $msg ."Temp Type</td><td>" .  $row['Type_Descr'];
$msg = $msg ."</td></tr><tr><td>";

$msg = $msg ."HR Contact</td><td>" .  $row['HR_Contact'];
$msg = $msg ."</td></tr><tr><td>HR Email" .'</td><td>'.  $row['hr_email'];
$msg = $msg ."</td></tr><tr><td>";
$msg = $msg .'Action Description:'.'</td><td>'. "<span style='color:red'>". $row['Action_Descr']."</span>";
$msg = $msg ."</td></tr><tr><td>";
$msg = $msg .'Business Title:'.'</td><td>'. $row['Business_Title'];
$msg = $msg ."</td></tr><tr><td>";
$msg = $msg .'Department:'.'</td><td>'. $row['Department'];
$msg = $msg ."</td></tr><tr><td>";
$msg = $msg .'Location:'.'</td><td>'. $row['Location'];
$msg = $msg ."</td></tr><tr><td>";
$msg = $msg .'Financial Division:'.'</td><td>'. $row['Finance'];
$msg = $msg ."</td></tr><tr><td>";
$msg = $msg .'Legal Entity:'.'</td><td>'. $row['Legal_Entity'];
$msg = $msg ."</td></tr><tr><td>";
$msg = $msg .'Manager:'.'</td><td>'. $row['Supervisor'];
$msg = $msg ."</td></tr><tr><td>";
$msg = $msg .'Comments:'.'</td><td>'. $row['Comments'];
$msg = $msg ."</td></tr></table>";
//$msg = $msg.'</div>';
$msg = $msg.'<br><br>'.$footmsg;

    if ($nda != 'n'){
    $ndanote = '<a href='.$nda.'> NDA Agreement on Planet Polycom. </a>';
    $msg = $msg.'<br><br>'.$ndanote;
    }
    
     $msg = $msg.'<br><br>'."<div style='color:blue' id='content' ><strong>Thank you</strong><br><br>The HR Team</div>" ;   



$from = '"HR Express" <hrnotify@polycom.com>';
$to = 'hrnotify@polycom.com';

$host = "10.236.0.154";
$username = 'austin\hrnotify';
$password = 'P0lyc0m1';

//$subject = "test";
$reply = "hrnotify@polycom.com";
$content = "text/html;charset=ISO-8859-1\r\n";

$headers = array ('From' => $from, 'To' => $mailstr,'Subject' => $subject,'Reply-To'=>$reply,'Content-Type'=>$content);
$smtp = Mail::factory('smtp', array ('host' => $host, 'auth' => true, 'username' => $username,'password' => $password));

$mail = $smtp->send($mailstr, $headers, $msg);

if (PEAR::isError($mail)) {
  $mailmsg = $mail->getMessage();
  $mailmsg = $mailstr ;
} else {
  $mailmsg = 'success';
  //echo 'Success ', substr($row['legal_entity'],0,5);
}
}
?>