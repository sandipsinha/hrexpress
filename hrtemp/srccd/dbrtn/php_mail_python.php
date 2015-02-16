<?php
$temp_id = 4375;
$stmt = 'python read_temp.py '.$temp_id;
$msgr =  exec($stmt);
echo $msgr;
?>