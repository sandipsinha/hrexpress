<?php  
require_once("../conf.php");      
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PHP Datagrid - Set Column Alignment</title>
</head>
<body> 

<?php
$dg = new C_DataGrid("SELECT * FROM orders", "orderNumber", "orders");

//Format a cell based on the specified condition
$dg->set_conditional_format("orderNumber","CELL",array("condition"=>"eq",
													   "value"=>"10107",
													   "css"=> array("color"=>"#ffffff",
																	 "background-color"=>"green")
													  )
						);

$dg->set_conditional_format("customerNumber","CELL",array(
    "condition"=>"eq","value"=>"141","css"=> array("color"=>"red","background-color"=>"#DCDCDC")));

// Format a row based on the specified condition
$dg->set_conditional_format("comments","ROW",array(
    "condition"=>"cn","value"=>"request","css"=> array("color"=>"white","background-color"=>"#4297D7")));    
                      
$dg -> display();
?>
</body>
</html>
