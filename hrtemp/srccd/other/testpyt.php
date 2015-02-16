 <?php
$fdtl = "It is loading";
$stmt = 'python ../pythcd/upld_stk.py '.$fdtl ;
echo exec($stmt);
?>