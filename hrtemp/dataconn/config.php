<?php
$host_name = 'hrexpress.polycom.com:3306';
$user_name = 'orclsql';
$pass_word = 'tan5321';
$database_name = 'hrexpress';
$conn = mysql_connect($host_name, $user_name, $pass_word) or die ('Error connecting to mysql');
mysql_select_db($database_name);
mysql_query("SET NAMES UTF8");
?>
