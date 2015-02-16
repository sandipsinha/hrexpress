<?php
session_start();
  
   if (isset($_SESSION['vendorid'])){
   unset($_SESSION['vendorid']);
   }
   
?>