<?php
require_once "../../dataconn/config.php";
$q = strtolower($_POST['datastring']);
if (!$q) return;
$row = 0;
$sql = "select DISTINCT id,last_name, first_name,busn_email from consultants where  busn_email LIKE '%$q%'";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$cid = $rs['id'];
	$fname = $rs['first_name'];
   $lname = $rs['last_name'];
	$row += 1;
}
$stmt = 'success' ;

if ($row > 0 and $_POST['action'] <> 'REH' )
{
$stmt = 'A name is already stored for this email: ' . $fname . ' '. $lname .'<br>' ;
}

if ($_POST['action'] == 'HIR' && $row > 0 )
  {
      $stmt = $stmt . 'If you intend to rehire, then change the action to a Rehire'; 
    }

$return_arr["response"] = $stmt;

if ($row > 0)
   {  
    echo json_encode($return_arr) ; 
   }
else
  echo json_encode($return_arr) ; 
?>