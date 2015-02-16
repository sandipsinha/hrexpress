<?php
 session_start(); 
  $vndrid = $_POST['datastring'];
  $_SESSION['vendorid'] = $vndrid;
  if (isset($_SESSION['id'])){
   unset($_SESSION['id']);
   }

?>