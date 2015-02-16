<?php 
require_once("../../phpgrid/conf.php");
$updtstr= $_POST['updtstr'];
$selectstr= $_POST['select'];
$dg = new C_DataGrid("$selectstr","id","temp_360_vw");
if ($updtstr != 'none')
{
  $dg->set_query_filter("$updtstr");
 } 
$dg->enable_export('EXCEL');
$dg->enable_resize('true');
$dg->enable_search('true');
$dg->set_caption('Report Details For Temporary WorkForce');
$dg->set_col_hidden('id');
//$dg->enable_edit("FORM","CRUD");
$dg->set_pagesize(40);
$dg->set_col_dynalink("first_name","../dbrtn/ee_info.php","id","","_top");
$dg->set_theme('overcast');
$dg->enable_advanced_search('true');
$dg->display();
   
?>