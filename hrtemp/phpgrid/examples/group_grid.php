<?php
require_once("../conf.php");      
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Simple Grouping with data</title>
</head>
<body> 

<?php
$dg = new C_DataGrid("SELECT * FROM payments", "customerNumber", "orders");

$dg->set_col_width("customerNumber", 30);
$dg->set_col_width("checkNumber",50);
$dg->set_col_width("amount",50);
                              
$dg->set_group_properties('customerNumber');
$dg->set_group_summary('amount','sum'); 
$dg->set_group_summary('checkNumber','count');

$dg -> display();
?>

</body>
</html>