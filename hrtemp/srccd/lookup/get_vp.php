<?php
require_once "../../dataconn/config.php";
$q = strtolower($_GET["q"]);
if (!$q) return;

//$sql = "select distinct a.vp vp,b.name name from employees a,employees b where a.vp=b.emplid and b.name LIKE '%$q%'";
$sql = "select distinct a.vp vp,b.name name from emp_current_vw a,emp_current_vw b where a.vp=b.emplid and b.name LIKE '%$q%' and b.empl_status in ('A','L','P','S')";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$cid = $rs['vp'];
	$cname = $rs['name'];
	echo "$cname|$cid\n";
}
?>


