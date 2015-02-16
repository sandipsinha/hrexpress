<?php
require_once "../../dataconn/config.php";
$eeid = $_SESSION['emplid'];
if (!$q) return;

$sql = "select DISTINCT fin_desc from finance where fin_desc LIKE '%$q%'";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	//$cid = $rs['id'];
	$cname = $rs['fin_desc'];
	echo "$cname\n";
}
?> 